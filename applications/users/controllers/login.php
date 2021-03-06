<?php
namespace users;

class login extends \Controller {
    
    function default_method()
    {
        switch ($_POST['act'])
        {
            case "login":
                $this->get_login($_POST['login'],$_POST['password'],true);
                break;
            default: $this->layout_show("login.html");
        }
    }

    function get_login($login,$pass,$post=false)
    {
        if ($post)
        {
            if ($login == "") $res['error']['login'] = "Логин не может быть пустым";
            if ($pass == "") $res['error']['password'] = "Пароль не может быть пустым";
        }

        if (!$res['error'])
        {
            $query = $this->db->prepare("select u.*,g.access_site,g.name as group_name from users as u LEFT JOIN groups as g ON g.id=u.id_group where email=?");
            $query->execute(array($login));

            if ($u = $query->fetch())
            {
                if ($post) $hash = md5(md5($pass).md5($u['salt']));
                else $hash = $pass;

                if ($hash == $u['pass'])
                {
                    $u['access'] = (array) json_decode($u['access_site']);
                    if ($u['access']['authorization'] || $u['id_group'] == 1)
                    {
                        if ($u['mailconfirm'] == 1)
                        {
                            if ($post && $_POST['cookie'])
                            {
                                setcookie('login', $login, time()+60*60*24*30,"/");
                                setcookie('password', $u['pass'], time()+60*60*24*30,"/");
                            }

                            unset($u['salt']);unset($u['access_site']); unset($u['pass']);
                            $u['timezone'] = $this->get_controller("users")->get_user_timezone($u['tzOffset']);
                            $_SESSION['user'] = $u;
                            $res['success'] = true;
                            if (!$post) return true;
                        }
                        else $res['error']['mailconfirm'] = $login;
                    }
                    else $res['error']['denied'] = "Вам вход запрещен";
                }
                else $res['error']['denied'] = "Данные неверны";
            }
            else $res['error']['denied'] = "Данные неверны";
        }

        if ($post) echo json_encode($res);
    }

    function update_access()
    {
        if ($_SESSION['user'])
        {
            $data = $this->db->query("select g.id,g.access_site,u.uniq_key from users as u
                    LEFT JOIN groups as g ON g.id=u.id_group
                    where u.id_user='{$_SESSION['user']['id_user']}'
            ")->fetch();

            $query = $this->db->prepare("select up.*, pr.* FROM userprofiles as up
                LEFT JOIN profile as pr ON up.idprof=pr.id
                WHERE up.iduser = ? and (pr.name='email_login' or pr.name='email_password' or pr.name='background' or pr.name='background2')");
            $query->execute(array($_SESSION['user']['id_user']));
            while ($row = $query->fetch())
            {
                $_SESSION['user'][$row['name']] = $row['value'];
            }
            $_SESSION['user']['access'] = (array) json_decode($data['access_site']);
            $_SESSION['user']['id_group'] = $data['id'];
            $_SESSION['user']['uniq_key'] = $data['uniq_key'];
        }
    }
}

