<?php
namespace users;

class users extends \Controller {

    private $limit = 10;

    function default_method()
    {
        switch($_POST['act'])
        {
            case "change_pwd":
                $this->change_pwd();
                break;
            case "get_authorization_form":
                $res['success'] = $this->layout_get("elements/authorization_form.html");
                echo json_encode($res);
                break;
            case "change_mail":
                $this->change_mail();
                break;
            case "cancel_chmail":
                $this->cancel_chmail();
                break;
            case "change_nick":
                $this->change_nick();
                break;
            case "get_user_tags":
                $this->get_user_tags();
                break;
            default: $this->default_show();
        }
    }

    function default_show($id = false)
    {
//        $this->testTz();
        if ($id) $this->id = $id;
        $this->limit = get_setting('users_count_on_page',$this->limit);

        if (!$this->id)
        {
            $where[] = "u.mailconfirm = '1'";
            if (isset($_POST['search']) && $_POST['search'] != '')
            {
                $search = str_replace(" ","%",$_POST['search']);
                $s = $this->db->quote("%{$search}%");
                $where[] = "(u.fio LIKE {$s} OR u.nickname LIKE {$s} OR gr.name LIKE {$s})";
            }

            if (count($where) > 0) $where = "WHERE ".implode(" AND ",$where);
            else $where = "";

            $total= $this->db->query("select distinct u.id_user
                    from users as u
                    LEFT JOIN groups as gr ON u.id_group=gr.id
                    {$where}
                    ")->fetchAll();
            $total = count($total);

            require_once(ROOT.'libraries/paginator/paginator.php');
            $paginator = new \Paginator($total, $_POST['page'], $this->limit);
            $p = $this->db->prepare("select distinct u.fio,u.nickname,u.avatar,u.gender,u.id_user,gr.id as id_group,gr.name as group_name,gr.color as color,u.last_user_action
                    from users as u
                    LEFT JOIN groups as gr ON u.id_group=gr.id
                    {$where}
                    ORDER BY u.fio ASC
                    LIMIT {$this->limit}
                    OFFSET {$paginator->get_range('from')}
            ");
            $p->execute();
            while ($row = $p->fetch()) {
                $ids[] = $row['id_user'];
                $users[$row['id_user']] = $row;
            }

            if ($ids)
            {
                $ids = implode(",",$ids);
                $p2 = $this->db->query("select up.iduser,up.value, pr.name, pr.alias FROM userprofiles as up LEFT JOIN profile as pr ON up.idprof=pr.id WHERE up.iduser IN ({$ids}) AND pr.name IN ('skypename', 'mphone')");
                while ($row = $p2->fetch()) {
                    $users[$row['iduser']][$row['name']]=$row['value'];
                }
            }

            $data = array(
                'users' => $users,
                'total' => $total,
                'paginator' => $paginator,
                'search' => $_POST['search']
            );

            if ($_POST)
            {
                $res['success'] = $this->layout_get("users_table.html",$data);
                echo json_encode($res);
            }
            else $this->layout_show('users.html',$data);
        }
        else
        {
            $id = intval($this->id);
            if($_SESSION['user']['id_user'] == $id) $this->set_global("user_menu", "profile");

            $result = $this->db->prepare("select u.fio,u.nickname,u.gender,u.avatar,u.id_user,u.last_user_action,gr.id as id_group,gr.name as group_name,gr.color
                from users as u
                LEFT JOIN groups as gr ON u.id_group=gr.id
                WHERE id_user = ? and u.mailconfirm = '1' LIMIT 1
            ");
            $result->execute(array($id));
            if ($user = $result->fetch())
            {
                $res2 = $this->db->prepare("select up.*, pr.* FROM userprofiles as up LEFT JOIN profile as pr ON up.idprof=pr.id WHERE up.iduser = ? and pr.share = '1'");
                $res2->execute(array($id));
                while ($row = $res2->fetch())
                {
                    $user['profile'][$row['name']]=$row;
                }

                $this->layout_show('user.html', array(
                    'user'=>$user
                ));
            }
            else return $this->error_page();
        }
    }
    function change_mail() {
        $id = $_SESSION['user']['id_user'];
        if ($_POST['newmail']==$_POST['oldmail']) $res['error'] = "Новый e-mail не может совпадать со старым!";
        else if ($_POST['newmail']=="") $res['error'] = "Введите новый e-mail!";
        else if (!preg_match(iconv("utf-8","windows-1251",'/^[а-яa-z0-9]{1}[а-яa-z0-9_\-\.]{1,30}@([а-яa-z0-9\-]{1,30}\.{0,1}[а-яa-z0-9\-]{1,5}){1,3}\.[а-яa-z]{2,5}$/i'),mb_strtolower(iconv("utf-8","windows-1251",$_POST['newmail'])))) $res['error'] = "Адрес почты неверен";
        else {
            $query = $this->db->prepare("select * from users where email = ?");
            if ($query->execute(array($_POST['newmail']))){
                if ($another = $query->fetch()) $res['error'] = $_POST['newmail']." уже зарегистрирован в системе.";
            } else $res['error'] = "Ошибка базы данных";
        }
        //$res['error'] = $_POST['oldmail'];
        if (!$res['error']) {
            $salt = $this->db->query("select u.salt from users as u WHERE u.id_user = ".$this->db->quote($id)." LIMIT 1")->fetch();
            $subject = "Смена адреса электронной почты";
            $this->db->beginTransaction();
            $code = md5(md5(time()).md5($salt));
            $message_old = "Вы запросили смену адреса электронной почты для сайта \"В стране\" (<a href='http://".$_SERVER["SERVER_NAME"]."'>http://".$_SERVER["SERVER_NAME"]."</a>). Для этого необходимо подтвердить свои действия, перейдя по <a href='http://".$_SERVER["SERVER_NAME"]."/users/mailconfirm/{$code}/'>этой ссылке</a>";
            $query = $this->db->prepare("insert into recovery(uid,email,hash,date,type, newmail) values(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE hash=?, newmail=?");
            if ($query->execute(array($id,$_POST['oldmail'],$code,strtotime("now"),'change_mail',$_POST['newmail'], $code, $_POST['newmail'])))
            {
                $code = md5(md5(time()).md5($salt."j"));
                $message_new = "Вы запросили смену адреса электронной почты для сайта \"В стране\" (<a href='http://".$_SERVER["SERVER_NAME"]."'>http://".$_SERVER["SERVER_NAME"]."</a>). Для этого необходимо подтвердить свои действия, перейдя по <a href='http://".$_SERVER["SERVER_NAME"]."/users/mailconfirm/{$code}/'>этой ссылке</a>";
                $query2 = $this->db->prepare("insert into recovery(uid,email,hash,date,type, newmail) values(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE email=?, hash=?, newmail=?");
                if ($query2->execute(array($id,$_POST['newmail'],$code,strtotime("now"),'change_mail',$_POST['newmail'], $_POST['newmail'], $code, $_POST['newmail']))) {
                    if (!send_mail(EMAIL, $_POST['oldmail'], $subject, $message_old,"drewwo.ru"))
                    {
                        $res['error'] = "Ошибка при отправке письма на старый ящик";
                        $this->db->rollBack();
                    } else {
                        if (!send_mail(EMAIL, $_POST['newmail'], $subject, $message_new,"drewwo.ru"))
                        {
                            $res['error'] = "Ошибка при отправке письма на новый ящик";
                            $this->db->rollBack();
                        } else {
                            $res['success']['oldmail'] = $_POST['oldmail'];
                            $res['success']['newmail'] = $_POST['newmail'];
                            $this->db->commit();
                        }
                    }
                } else {
                    $res['error']['global'] = "Ошибка базы данных";
                    $this->db->rollBack();
                }
            }
            else $res['error']['global'] = "Ошибка базы данных";
        }
        echo json_encode($res);
    }

    function cancel_chmail()
    {
        $id = $_SESSION['user']['id_user'];
        if ($this->db->query("delete from recovery where uid = ".$this->db->quote($id)." and type='change_mail'")){
            $res['success'] = true;
        } else $res['error'] = "Ошибка базы данных";
        echo json_encode($res);
    }

    function inCL($id_owner, $id_contact)
    {
        $id_owner = intval($id_owner);
        $id_contact = intval($id_contact);
        if ($id_owner != $id_contact)
            $found_relation = $this->db->query("SELECT id_owner FROM contact_list where id_owner = ".$this->db->quote($id_owner)." AND id_contact = ".$this->db->quote($id_contact))->fetch();
            else $found_relation = false;
        return $found_relation;
    }

    function change_nick()
    {
        $id = $_SESSION['user']['id_user'];

        if ($_POST['newnick']=="") $res['error'] = "Введите новый псевдоним!";
        else if (!preg_match(iconv("utf-8","windows-1251",'/^[a-zA-Z0-9]{3,16}$/i'),iconv("utf-8","windows-1251",$_POST['newnick']))) $res['error'] = "Псевдоним должен состоять из латинских букв и цифр и содержать от 3 до 16 символов";
         else {
            $query = $this->db->prepare("select u.* from users as u WHERE u.nickname = ? LIMIT 1");
            $query->execute(array($_POST['newnick']));
            if ($anotheru = $query->fetch()) {
            $res['error'] = "Данный псевдоним занят";
         }
        }
        if (!$res['error']) {
            $query = $this->db->prepare("update users set nickname = ?  WHERE id_user = ?");
            if ($query->execute(array($_POST['newnick'], $id))) {
                $res['success']['nickname']=$_POST['newnick'];
                $_SESSION['user']['nickname'] = $_POST['newnick'];
            }
        }
        echo json_encode($res);
    }

    function change_pwd()
    {
        $id_user = intval($_POST['id']);
        $oldpwd = $_POST['oldpwd'];
        $newpwd = $_POST['newpwd'];
        $rptpwd = $_POST['rptpwd'];
        if ($_SESSION['user']['id_user'] == $id_user) {
            if ($oldpwd!='' && $newpwd!='' && $rptpwd!='') {
                $query = $this->db->prepare("select u.pass, u.salt, u.email FROM users as u WHERE id_user = ?");
                $query->execute(array($id_user));
                if ($u = $query->fetch())
                {
                    $hash = md5(md5($oldpwd).md5($u['salt']));
                    if ($hash !== $u['pass'])
                        $res['error']['oldpwd'] = "Старый пароль неверен";

                    if ($newpwd !== $rptpwd)
                        $res['error']['rptpwd'] = "Новый пароль не совпадает с повторным";
                    if (!$res['error']) {
                        $get_pass = get_pass($newpwd);
                        $query = $this->db->prepare("update users set pass = ?, salt = ?, uniq_key = ? WHERE id_user = ?");
                        if ($query->execute(array($get_pass['password'], $get_pass['salt'], $get_pass['uniq_key'], $id_user))) {
                            setcookie('login', $u['email'], time()+60*60*24*30,"/");
                            setcookie('password', $get_pass['password'], time()+60*60*24*30,"/");
                            $res['success'] = true;
                        } else $res['error']['mysql'] = "Ошибка базы данных";
                    }

                } else $res['error']['denied'] = "данные неверны";
            } else $res['error'] = "Ни одно из полей формы смены пароля не должно быть пустым!";
        } else {
            $res['error'] = "У вас нет на это прав!";
        }
        //$res['error'] = "Чот не то о_О";
        echo json_encode($res);
    }

    function get_user_notes($id=false,$limit=false)
    {
        if (!$id) $id = $_SESSION['user']['id_user'];
        if ($limit) $end_query = "LIMIT {$limit}";

        $query = $this->db->prepare("select id,name,created from users_notes where id_user=? order by created DESC {$end_query}");
        $query->execute(array($id));
        $notes = $query->fetchAll();

        return $notes;
    }

    function get_user_tags($id=false,$limit=false,$no_ajax=false, $withCount=false)
    {
        if (!$id) $id = $_SESSION['user']['id_user'];
        if ($limit) $end_query = "tu.count DESC LIMIT {$limit}";
        else $end_query = "t.name";

        $query = $this->db->prepare("select t.*, tu.count
            from tags_to_users as tu
            LEFT JOIN tags as t ON t.id=tu.id_tag
            where tu.id_user = ?
            order by {$end_query}
        ");
        $query->execute(array($id));
        if ($withCount)
        {
            while($row = $query->fetch()) $tags[$row['id']] = $row;
        }
        else
        {
            while($row = $query->fetch()) $tags[$row['id']] = $row['name'];
        }
        if ($_GET['ajax'] && !$no_ajax)
        {
            $res['success'] = $this->layout_get("elements/tags.html",array('tags' => $tags,'popup' => true));
            echo json_encode($res);
        }
        else return $tags;
    }

    function get_user_tags_count($id=false)
    {
        if (!$id) $id = $_SESSION['user']['id_user'];
        $id = (int) $id;

        $count = $this->db->num_rows("tags_to_users where id_user = '{$id}'");
        return $count;
    }

    function get_users_from_group($group,$limit)
    {
        if ($group)
        {
            $group = (int) $group;
            $query = $this->db->query("select id_user,fio,nickname,avatar from users where id_group='{$group}' ORDER BY id_user DESC LIMIT {$limit}");
            while ($row = $query->fetch())
            {
                $users[$row['id_user']] = $row;
                $ids[] = $row['id_user'];
            }
            if ($ids)
            {
                $ids = implode(",",$ids);
                $query = $this->db->query("select up.iduser,p.name,up.value from userprofiles as up
                    LEFT JOIN profile as p ON p.id=up.idprof
                    WHERE up.iduser IN ({$ids})
                ");
                while ($row = $query->fetch()) $users[$row['iduser']]['profile'][$row['name']] = $row['value'];
            }
        }
        return $users;
    }

    function get_user($id)
    {
        $query = $this->db->prepare("select * from users where id_user=?");
        $query->execute(array($id));
        $user = $query->fetch();

        return $user;
    }

    function get_user_timezone($offset="14400")
    {
        $o = $offset;
        $n = \DateTimeZone::listAbbreviations();
        //pr($n);
        date_default_timezone_set('UTC');
        $now = time() + $o;
        $date = date("d.m.y H:i",$now);

        foreach($n as $k)
        {
            foreach ($k as $a)
            {
                if (strlen($a['timezone_id']) > 0) {
                    if (@date_default_timezone_set($a['timezone_id']))
                    {
                        $new_date = date("d.m.y H:i");
                        if ($date === $new_date)
                        {
                            $time_zone = $a['timezone_id'];
                            //echo "<div>{$o} - {$time_zone} | <span style='color:red;'>{$date}</span> = {$new_date}</div>";
                            return $time_zone;
                        }
                    }
                }

            }
        }

    }

    function testTz()
    {
        $offset = array(
        '-43200',
        '-39600',
        '-36000',
        '-34200',
        '-32400',
        '-28800',
        '-25200',
        '-21600',
        '-18000',
        '-16200',
        '-14400',
        '-12600',
        '-10800',
        '-7200',
        '-3600',
        '0',
        '3600',
        '7200',
        '10800',
        '12600',
        '14400',
        '16200',
        '18000',
        '19800',
        '21600',
        '23400',
        '25200',
        '28800',
        '31500',
        '32400',
        '34200',
        '36000',
        '37800',
        '39600',
        '41400',
        '43200',
        '45900',
        '46800',
        '50400'
    );

    $offset_value = "14400";
    $time_zone = false;

        $n = \DateTimeZone::listAbbreviations();
        foreach ($offset as $o)
        {
          date_default_timezone_set('UTC');
          $now = time() + $o;
          $date = date("d.m.y H:i",$now);

            foreach($n as $k)
            {
                foreach ($k as $a)
                {
                    if (@date_default_timezone_set($a['timezone_id']))
                    {
                        $new_date = date("d.m.y H:i");
                        if ($date === $new_date)
                        {
                            $time_zone = $a['timezone_id'];
                            echo "<div>{$o} - {$time_zone} | <span style='color:red;'>{$date}</span> = {$new_date}</div>";
                            break(2);
                        }
                    }
                }
            }
        }
    }

    function check_access_to_profile($id)
    {
        $res2 = $this->db->prepare("select up.*, pr.* FROM userprofiles as up LEFT JOIN profile as pr ON up.idprof=pr.id WHERE up.iduser = ? and pr.name='type_visible'");
        $res2->execute(array($id));
        $result = $res2->fetch();

        $type_visible = $result['value'];

        if (!$type_visible || !in_array($type_visible,array('visible','visible_for_friend','invisible'))) $type_visible = "visible";
        if ($_SESSION['user']['id_user'] != $id)
        {
            if ($type_visible == "invisible") $this->error_page("denied");
            elseif ($type_visible == "visible_for_friend")
            {
                $query = $this->db->prepare("select * from contact_list where id_owner=? and id_contact=?");
                $query->execute(array($id,$_SESSION['user']['id_user']));
                if (!$query->fetch()) $this->error_page("denied");
            }
        }
    }

}

