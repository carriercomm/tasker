<?php
namespace projects;

class tasks extends \Controller {

    var $limit = 15;
    
    function default_method()
    {
        switch($_POST['act'])
        {
            case "save_task":
                $this->save_task();
                break;
            case "close_task":
                $this->close_task();
                break;
            case "add_file_to_task":
                $this->add_file_to_task();
                break;
            case "add_files":
                $this->add_files();
                break;
            case "delete_task":
                $this->delete_task();
                break;
            default:
                $this->default_for_this();
        }
    }

    function default_for_this()
    {
        switch($this->id)
        {
            case "add":
                $this->add_task();
                break;
            case "show":
            case "edit":
                $this->show_edit_task();
                break;
            default:
                $this->show_tasks();
        }
    }

    function add_task()
    {
        $access = $this->get_controller("projects","users")->get_access($this->_0);

        if ($access['access']['add_task'] || $access['access']['add_error'])
        {
            if (!$project = $access['project']) $this->error_page();

            if ($project['owner']) crumbs("Личные проекты","/projects/",true);
            crumbs($project['name'],"/projects/~{$project['id']}");
            crumbs("Задачи","/projects/tasks/{$project['id']}/");
            crumbs("Добавление");
            $users = $this->get_controller("projects","users")->get_users_project($this->_0);
            $this->layout_show('tasks/add_task.html',array(
                'projects' => $this->get_controller("projects")->get_projects($project['id']),
                'add_tasks_button' => true,
                'project' => $project,
                'users' => $users,
                'manager' => true,
                'access' => $access['access'],
                'types_tasks' => $access['types_tasks']
            ));
        }
        else $this->error_page("denied");
    }

    function show_edit_task()
    {
        if ($this->id == "show")
        {
            $show_task = true;
            $logs = $this->get_controller("projects","logs")->get_logs_task($this->_0);
        }
        else if ($this->id == "edit") $to_task = true;

        if ($task = $this->get_task($this->_0))
        {
            $access = $this->get_controller("projects","users")->get_access($task['id_project'],false,$task['id']);
            if (!$project = $access['project']) $this->error_page();

            if ($project['owner']) crumbs("Личные проекты","/projects/",true);
            crumbs($project['name'],"/projects/~{$project['id']}");
            crumbs("Задачи","/projects/tasks/{$project['id']}/");
            crumbs($task['name'],"/projects/tasks/show/{$task['id']}/");

            $query = $this->db->prepare("select ft.*,f.*,u.fio,u.nickname,u.id_user,u.id_group,g.color,g.name as group_name
                    from files_to_tasks as ft
                    LEFT JOIN projects_files as f ON f.id = ft.id_file
                    LEFT JOIN users as u ON f.owner=u.id_user
                    LEFT JOIN groups as g ON u.id_group=g.id
                    where id_task=?");
            $query->execute(array($task['id']));
            $f_ctr = $this->get_controller("projects","files");
            while ($row = $query->fetch())
            {
                $row['size'] = $f_ctr->format_file_size($row['size']);
                $files[] = $row;
            }

            if ($this->id == "edit")
            {
                $users = $this->get_controller("projects","users")->get_users_project($task['id_project']);
                crumbs("Редактирование");
                $layout = "tasks/add_task.html";
                if (!$access['access']['edit_tasks'] && !$access['access']['edit_task'] && !$access['access']['save_task']) $this->error_page("denied");
            }
            else $layout = "tasks/show_task.html";

            $this->layout_show($layout,array(
                'projects' => $this->get_controller("projects")->get_projects($project['id']),
                'tasks_button' => true,
                'project' => $project,
                'task' => $task,
                'users' => $users,
                'files' => $files,
                'show_task' => $show_task,
                'to_task' => $to_task,
                'access' => $access['access'],
                'logs' => $logs,
                'types_tasks' => $access['types_tasks']
            ));
        }
        else $this->error_page();
    }

    function show_tasks()
    {
        $access = $this->get_controller("projects","users")->get_access($this->id);
        if (!$project = $access['project']) $this->error_page();

        if ($project['owner']) crumbs("Личные проекты","/projects/",true);
        crumbs($project['name'],"/projects/~{$project['id']}");
        crumbs("Задачи");

        if (isset($_POST['search']) && $_POST['search'] != '')
        {
            $search = explode(" ",$_POST['search']);
            foreach ($search as $s)
            {
                $s = $this->db->quote("%{$s}%");
                $search_ar[] = "t.name LIKE ".$s." OR t.description LIKE ".$s." OR a.fio LIKE ".$s." OR a.nickname LIKE ".$s;
            }
            $where[] = "(".implode("OR ",$search_ar).")";
        }

        if (isset($_POST['status']) && $_POST['status'] != '')
        {
            foreach ($_POST['status'] as &$s) $s = $this->db->quote($s);
            $where[] = "t.status IN (".implode(",",$_POST['status']).")";
        }

        if (isset($_POST['percent']) && $_POST['percent'] != '')
        {
            $d = "'".date("Y-m-d")."'";
            $where[] = "(t.end IS NOT NULL and t.end < {$d} and t.status IN('new','in_progress'))";
        }

        if (isset($_POST['priority']) && $_POST['priority'] != '')
        {
            foreach ($_POST['priority'] as &$s) $s = $this->db->quote($s);
            $where[] = "t.priority IN (".implode(",",$_POST['priority']).")";
        }

        if (isset($_POST['type']) && $_POST['type'] != '')
        {
            foreach ($_POST['type'] as &$s) $s = $this->db->quote($s);
            $where[] = "t.type IN (".implode(",",$_POST['type']).")";
        }

        $where[] = "t.id_project={$this->db->quote($this->id)}";

        if (count($where) > 0) $where = "WHERE ".implode(" AND ",$where);

        $total = $this->db->num_rows("projects_tasks as t LEFT JOIN users as a ON t.assigned = a.id_user {$where}");

        require_once(ROOT.'libraries/paginator/paginator.php');
        $paginator = new \Paginator($total, $_POST['page'], $this->limit);
        if ($paginator->pages < $_POST['page']) $paginator = new \Paginator($total, $paginator->pages, $this->limit);

        $query = $this->db->prepare("select t.id,t.type,t.name,t.assigned,t.status,t.priority,t.start,t.end,t.estimated_time,t.spent_time,t.id_project,t.percent,t.message,t.id_user,t.created,t.updated,
                a.fio as assigned_name,a.nickname as assigned_nickname,
                u.fio as user_name,u.nickname as user_nickname,g.color,g.name as group_name,
                gt.color as assigned_color,gt.name as assigned_group_name
                from projects_tasks as t
                LEFT JOIN users as a ON t.assigned = a.id_user
                LEFT JOIN users as u ON t.id_user = u.id_user
                LEFT JOIN groups as g ON u.id_group = g.id
                LEFT JOIN groups as gt ON a.id_group = gt.id
                {$where}
                order by t.updated DESC,t.name ASC
                LIMIT {$this->limit}
                OFFSET {$paginator->get_range('from')}
            ");
        $query->execute();
        $tasks = $query->fetchAll();

        $form = array(
            'status' => array('label' => 'Статус',
                'type' => 'multy_select',
                'options' => array('new' => 'новая','in_progress' => 'в процессе','closed' => 'закрытая','rejected' => 'отклоненная'),
                'selected' => array('new','in_progress','closed','rejected')
            ),
            'priority' => array('label' => 'Приоритет',
                'type' => 'multy_select',
                'options' => array('1' => 'низкий','2' => 'обычный','3' => 'высокий','4' => 'критический'),
                'selected' => array('1','2','3','4')
            ),
            'type' => array('label' => 'Тип задачи',
                'type' => 'multy_select',
                'options' => array('task' => 'улучшение','error' => 'ошибка'),
                'selected' => array('task','error')
            ),
            'percent' => array('label' => 'Только просроченные',
                'type' => 'checkbox'
            ),
        );

        $data = array(
            'tasks' => $tasks,
            'projects' => $this->get_controller("projects")->get_projects($project['id']),
            'project' => $project,
            'tasks_button' => true,
            'paginator' => $paginator,
            'form' => $form,
            'access' => $access['access'],
            'all' => true
        );

        if ($_POST)
        {
            if ($text = $this->layout_get('tasks/tasks_table.html',$data)) $result['success'] = $text;
            else $result['error'] = "Ничего не найдено";

            echo json_encode($result);
        }
        else $this->layout_show('tasks/tasks.html',$data);
    }

    function get_task($id)
    {
        $query = $this->db->prepare("select t.*,a.fio as assigned_name,a.nickname as assigned_nickname,u.fio as user_name,u.nickname as user_nickname,
                g.color,g.name as group_name, gt.color as assigned_color,gt.name as assigned_group_name
                from projects_tasks as t
                LEFT JOIN users as a ON t.assigned = a.id_user
                LEFT JOIN users as u ON t.id_user = u.id_user
                LEFT JOIN groups as g ON u.id_group=g.id
                LEFT JOIN groups as gt ON a.id_group=gt.id
                where t.id=?
            ");
        $query->execute(array($id));
        return $query->fetch();
    }

    function save_task()
    {
        $access = $this->get_controller("projects","users")->get_access($_POST['project'],false,$_POST['id']);
        $project = $access['project'];
        $task = $access['task'];

        if (isset($_POST['name']) && $_POST['name'] == "") $res['error'][] = "Введите название";

        if (isset($_POST['start']))
        {
            if ($_POST['start'] == "") $res['error'][] = "Укажите дату начала";
            elseif (!check_date($_POST['start'])) $res['error'][] = "Укажите правильную дату начала";
            else $_POST['start'] = convert_date($_POST['start'],true);
        }

        if (!in_array($_POST['status'],array('new','in_progress','rejected'))) $res['error'][] = "Укажите статус задания";

        if (isset($_POST['end']) && $_POST['end'] != "")
        {
            if (!check_date($_POST['end'])) $res['error'][] = "Укажите правильную дату окончания";
            else
            {
                $_POST['end'] = convert_date($_POST['end'],true);
                if (strtotime($_POST['end']) < strtotime($_POST['start'])) $res['error'][] = "Дата окончания не может быть меньше даты начала";
                else if (strtotime(date('d.m.Y',time())) > strtotime($_POST['end'])) $res['error'][] = "Дата окончания не может меньше текущей";
            }
        }
        else $_POST['end'] = null;

        if ($_POST['assigned'] == "") $_POST['assigned'] = null;
        if ($_POST['estimated_time'] == "") $_POST['estimated_time'] = null;
        if ($_POST['status'] != "rejected") $_POST['message'] = null;

        $pri = array(
            '1' => 'низкий',
            '2' => 'обычный',
            '3' => 'важный',
            '4' => 'критический'
        );

        $sta = array(
            'new' => 'новая',
            'in_progress' => 'в процессе',
            'closed' => 'закрытая',
            'rejected' => 'отклоненная'
        );

        if ($project['owner'] != "") $_POST['type'] = "task";
        else if ($_POST['type'] == "") $_POST['type'] = $task['type'];
        if ($project['owner']) $_POST['assigned'] = $_SESSION['user']['id_user'];

        if (!$res['error'])
        {
            $log = $this->get_controller("projects","logs");
            $this->db->beginTransaction();
            if ($_POST['id'])
            {
                if (($access['access']['edit_task'] && in_array($_POST['type'],$access['types_tasks'])) || $access['access']['edit_tasks'] || $access['access']['save_task'])
                {
                    $text_log = "";
                    if ($task['status'] != $_POST['status']) $text_log .= ". Статус изменен с '{$sta[$task['status']]}' на '{$sta[$_POST['status']]}'";
                    if ($task['percent'] != $_POST['percent']) $text_log .= ". Статус выполнения изменен с {$task['percent']}% на {$_POST['percent']}%";

                    if (!$access['access']['edit_tasks'] && !$access['access']['edit_task'])
                    {
                        $query = $this->db->prepare("
                            update projects_tasks
                            set status=?,percent=?,message=?,assigned=?,updated=?
                            where id=?
                        ");
                        if ($query->execute(array($_POST['status'],$_POST['percent'],$_POST['message'],
                            $_SESSION['user']['id_user'],time(),$_POST['id'])))
                        {
                            $res['success'] = $_POST['id'];
                            $log->set_logs("task",$task['id'],"Изменил{$text_log}");
                        }
                        else $res['error'] = "Ошибка сохранения задачи";
                    }
                    else
                    {
                        if ($task['priority'] != $_POST['priority']) $text_log .= ". Приоритет изменен с {$pri[$task['priority']]} на {$pri[$_POST['priority']]}";

                        $query = $this->db->prepare("
                            update projects_tasks
                            set name=?,status=?,percent=?,message=?,description=?,priority=?,start=?,end=?,assigned=?,estimated_time=?,type=?,updated=?
                            where id=?
                        ");

                        require_once(ROOT.'libraries/simple_html_dom.php');
                        $html = str_get_html($_POST['description']);
                        if ($html)
                        {
                            foreach($html->find('script') as $element)
                            {
                                $element->outertext = (string)$element->innertext;
                            }
                            $_POST['description'] = $html->save();
                        }

                        if ($query->execute(array($_POST['name'],$_POST['status'],$_POST['percent'],$_POST['message'],
                            $_POST['description'],$_POST['priority'],$_POST['start'],$_POST['end'],
                            $_POST['assigned'],$_POST['estimated_time'],$_POST['type'],time(),$_POST['id']
                        )))
                        {
                            $res['success'] = $_POST['id'];
                            $log->set_logs("task",$task['id'],"Изменил{$text_log}");
                        }
                        else $res['error'] = "Ошибка сохранения задачи";
                    }
                    $notif = "Задача \"{$_POST['name']}\" в проекте \"{$project['name']}\" была отредактирована";
                    $edit = true;
                }
                else $res['error'] = "У Вас недостаточно прав";
            }
            else
            {
                if (($access['access']['add_task'] && $_POST['type'] == "task") || ($access['access']['add_error'] && $_POST['type'] == "error"))
                {
                    $query = $this->db->prepare("
                      insert into projects_tasks(name,status,percent,description,priority,start,end,assigned,estimated_time,id_project,id_user,type,created,updated)
                      values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                    ");
                    $time = time();
                    if ($query->execute(array($_POST['name'],$_POST['status'],
                        $_POST['percent'],$_POST['description'],
                        $_POST['priority'],$_POST['start'],$_POST['end'],$_POST['assigned'],
                        $_POST['estimated_time'],$_POST['project'],$_SESSION['user']['id_user'],$_POST['type'],$time,$time
                    )))
                    {
                        $last_id = $this->db->lastInsertId();
                        $res['success'] = $last_id;
                        $log->set_logs("task",$last_id,"Создал");
                    }
                    else $res['error'] = "Ошибка создания задачи";

                    $notif = "У Вас новая задача \"{$_POST['name']}\" в проекте \"{$project['name']}\"";
                }
                else $res['error'] = "У Вас недостаточно прав";
            }

            if (($access['access']['add_task'] && $_POST['type'] == "task") ||
                ($access['access']['add_error'] && $_POST['type'] == "error") ||
                 $access['access']['edit_task'] || $access['access']['edit_tasks']
            )
            {
                $query = $this->db->prepare("delete from files_to_tasks where id_task=?");
                if (!$query->execute(array($_POST['id']))) $res['error'] = "Ошибка базы данных";

                if (count($_POST['files']) > 0)
                {
                    $query = $this->db->prepare("insert into files_to_tasks(id_file,id_task) values(?,?)");

                    foreach($_POST['files'] as $k => $v)
                    {
                        if (!$query->execute(array($v,$res['success']))) $res['error'] = "Ошибка базы данных";
                    }
                }
            }

            if ($res['error']) $this->db->rollBack();
            else
            {
                $this->db->commit();

                $notif_cr = $this->get_controller("projects","tasks");
                $message = $this->layout_get("tasks//task_mail.html",array(
                    'server_name' => $_SERVER["SERVER_NAME"],
                    'name' => $project['name'],
                    'edit' => $edit,
                    'task' => $res['success']
                ));

                if ($_POST['assigned'] != "" && $_POST['assigned'] != $_SESSION['user']['id_user'])
                    $notif_cr->send_notification($_POST['assigned'],$notif,$message,$email=$_POST['email'],$phone=$_POST['sms']);

                if ($task['assigned'] != "" && $_POST['assigned'] != $task['assigned'])
                    $notif_cr->send_notification($task['assigned'],$notif,$message,$email=$_POST['email'],$phone=$_POST['sms']);

            }
        }

        echo json_encode($res);
    }

    function close_task()
    {
        $access = $this->get_controller("projects","users")->get_access(false,false,$_POST['id']);
        $task = $access['task'];
        $spent_time = (int) $_POST['spent_time'];
        if ($spent_time < 1) $res['error'] = "Укажите время отличное от нуля";
        if ($task['status'] == "closed") $res['error'] = "Задача уже закрыта";

        if (!$res['error'])
        {
            if ($access['edit_task'] || $access['access']['edit_tasks'] || $access['access']['save_task'])
            {
                $now = date("Y-m-d");
                if ($now < $task['start']) $task['start'] = $now;
                if ($task['assigned'] == "") $task['assigned'] = $_SESSION['user']['id_user'];

                $query = $this->db->prepare("update projects_tasks set status=?,start=?,end=?,assigned=?,spent_time=spent_time+{$spent_time},percent=?,updated=? where id=? LIMIT 1");
                if ($query->execute(array('closed',$task['start'],$now,$task['assigned'],100,time(),$_POST['id'])))
                {
                    $res['success']['project'] = $task['id_project'];
                    $log = $this->get_controller("projects","logs");
                    $log->set_logs("task",$task['id'],"Закрыл");
                }
                else $res['error'] = "Ошибка базы данных";
            }
            else $res['error'] = "У Вас недостаточно прав";
        }
        echo json_encode($res);
    }

    function add_file_to_task()
    {
        if ($_POST['files'])
        {
            foreach ($_POST['files'] as &$v) $v = (int) $v;
            $ids = implode(",",$_POST['files']);
            $excluded = " and p.id NOT IN (".$ids.")";
        }

        $limit = 10;

        if (isset($_POST['search']) && $_POST['search'] != '')
        {
            $search = explode(" ",$_POST['search']);
            foreach ($search as $s)
            {
                $s = $this->db->quote("%{$s}%");
                $search_ar[] = "p.name LIKE ".$s;
            }
            $search_name = "and (".implode("OR ",$search_ar).")";
        }

        $total = $this->db->num_rows("projects_files as p where id_project=".$this->db->quote($_POST['project'])." {$excluded} {$search_name}");

        require_once(ROOT.'libraries/paginator/paginator.php');
        $paginator = new \Paginator($total, $_POST['page'], $limit);
        if ($paginator->pages < $_POST['page']) $paginator = new \Paginator($total, $paginator->pages, $limit);

        $query = $this->db->prepare("select p.*,u.fio,u.nickname,g.color,g.name as group_name
                from projects_files as p
                LEFT JOIN users as u ON p.owner=u.id_user
                LEFT JOIN groups as g ON u.id_group=g.id
                where p.id_project=? {$excluded} {$search_name}
                order by p.created DESC
                LIMIT {$limit}
                OFFSET {$paginator->get_range('from')}
        ");
        $query->execute(array($_POST['project']));
        $f_ctr = $this->get_controller("projects","files");
        while ($row = $query->fetch())
        {
            $row['size'] = $f_ctr->format_file_size($row['size']);
            $files[] = $row;
        }

        $data = array(
            'files' => $files,
            'paginator' => $paginator,
            'get_popup_files' => true,
        );

        $res['success'] = $this->layout_get('files/popup_files.html',$data);
        echo json_encode($res);
    }

    function add_files()
    {
        if ($_POST['files'])
        {
            foreach ($_POST['files'] as &$v) $v = (int) $v;
            $ids = implode(",",$_POST['files']);
            $query = $this->db->query("select p.*,u.fio,u.nickname,g.color,g.name as group_name
                from projects_files as p
                LEFT JOIN users as u ON p.owner=u.id_user
                LEFT JOIN groups as g ON u.id_group=g.id
                where p.id IN(".$ids.")
            ");
            $files = $query->fetchAll();
            $f_ctr = $this->get_controller("projects","files");
            if ($files)
            {
                $res['success'] = "";
                foreach ($files as $file)
                {
                    $file['size'] = $f_ctr->format_file_size($file['size']);
                    $res['success'] .= $this->layout_get("files/file.html",array('file' => $file,'to_task' => true));
                }
            }
        }
        else $res['error'] = "Ничего не выбрано";

        echo json_encode($res);
    }

    function delete_task()
    {
        $access = $this->get_controller("projects","users")->get_access(false,false,$_POST['id']);
        $task = $access['task'];
        $log = $this->get_controller("projects","logs");

        if ($access['access']['delete_tasks'])
        {
            $query = $this->db->prepare("delete from projects_tasks where id=?");
            if ($query->execute(array($_POST['id'])))
            {
                $res['success']['project'] = $task['id_project'];
                $log->set_logs("project",$access['project']['id'],"Удалена задача \"{$task['name']}\"");
            }
            else $res['error'] = "Ошибка базы данных";
        }
        else $res['error'] = "У Вас недостаточно прав";

        echo json_encode($res);
    }

    function send_notification($id,$text,$full_text,$email=false,$phone=false)
    {
        if ($id && $id != $_SESSION['user']['id_user'] && get_setting("send_sms"))
        {
            if ($phone)
            {
                $query = $this->db->prepare("select * from profile as pr
                            LEFT JOIN userprofiles as up ON pr.id = up.idprof
                            WHERE pr.name='mphone' and up.iduser=?
                        ");
                $query->execute(array($id));
                $phone = $query->fetch();
                $phone_value = str_replace(array(" ","+","-"),"",$phone['value']);
                $login = get_setting('fastsms_login');
                $password = get_setting('fastsms_password');
                $sender = get_setting('fastsms_sender');
                if ($phone_value !="") file_get_contents("http://api.fastsms.pro/send.php?username={$login}&password={$password}&sender={$sender}&numbers={$phone_value}&message=".urlencode($text));
            }

            if ($email)
            {
                $query = $this->db->prepare("select email from users where id_user=?");
                $query->execute(array($id));
                $email_value = $query->fetch();
                send_mail(get_setting('email'), $email_value['email'], $text, $full_text, "Task me!");
            }
        }
    }

    function get_delayed_tasks()
    {
        $now = date("Y-m-d");
        $query = $this->db->prepare("select pt.name,pt.end,pt.id_project,pt.id,p.name as project_name
            from projects_tasks as pt
            LEFT JOIN projects as p ON pt.id_project = p.id
            where assigned=? and end < ? and status IN ('new','in_progress')
        ");
        $query->execute(array($_SESSION['user']['id_user'],$now));
        return $query->fetchAll();
    }

    function get_delayed_manager_tasks()
    {
        $now = date("Y-m-d");
        $query = $this->db->prepare("select pt.name,pt.end,pt.id_project,pt.id,p.name as project_name,u.fio,u.nickname,pt.assigned
            from projects_tasks as pt
            LEFT JOIN projects as p ON pt.id_project = p.id
            LEFT JOIN users as u ON pt.assigned = u.id_user
            where p.id IN( SELECT id_project from projects_users where id_user=? and role='manager') and end < ? and status IN ('new','in_progress')
        ");
        $query->execute(array($_SESSION['user']['id_user'],$now));
        return $query->fetchAll();
    }

    function get_count_project()
    {
        return $this->db->num_rows("projects_users where id_user='{$_SESSION['user']['id_user']}'");
    }

    function get_count_personal_tasks()
    {
        return $this->db->num_rows("projects_tasks as pt
            LEFT JOIN projects as p ON pt.id_project = p.id
            where pt.assigned='{$_SESSION['user']['id_user']}' and pt.status IN ('new','in_progress','rejected')","pt.id
        ");
    }

    function get_manager_stats()
    {
        $query = $this->db->prepare("select pt.status
            from projects_users as pu
            LEFT JOIN projects_tasks as pt ON pt.id_project = pu.id_project
            where pu.id_user=? and (pu.role='manager' or (pu.role='user' and (pt.assigned IS NULL OR pt.id_user=?))) and pt.id IS NOT NULL
        ");
        $query->execute(array($_SESSION['user']['id_user'],$_SESSION['user']['id_user']));

        $stats = array();
        while ($row = $query->fetch())
        {
            $stats[$row['status']]++;
        }

        return $stats;
    }

    function get_stats($id_project)
    {
        $query = $this->db->prepare("select status from projects_tasks
            where id_project=?
        ");
        $query->execute(array($id_project));

        $stats = array();
        while ($row = $query->fetch())
        {
            $stats[$row['status']]++;
            $stats['all']++;
        }

        return $stats;
    }

    function get_users_stats($id_project)
    {
        $query = $this->db->prepare("select status,assigned from projects_tasks
            where id_project=? and assigned IS NOT NULL
        ");
        $query->execute(array($id_project));

        $stats = array();
        while ($row = $query->fetch())
        {
            $stats[$row['assigned']][$row['status']]++;
            $stats[$row['assigned']]['all']++;
        }

        return $stats;
    }
}