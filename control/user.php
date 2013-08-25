<?php

!defined('IN_TIPASK') && exit('Access Denied');

class usercontrol extends base {

    var $imagetypes = array('', 'gif', 'jpg', 'png');

    function usercontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load('user');
        $this->load('question');
        $this->load('answer');
        $this->load("favorite");
    }

    function ondefault() {
        $this->onscore();
    }

    function oncode() {
        ob_clean();
        $code = random(4, 2);
        $_ENV['user']->save_code(strtolower($code));
        makecode($code);
    }

    function onregister() {
        if (isset($this->get[2])) {
            $access_token = $this->get[2];
            $user = $_ENV['user']->get_by_access_token($access_token);
            if ($user) {
                //ucenter��¼�ɹ����򲻻����ִ�к���Ĵ��롣
                if ($this->setting["ucenter_open"]) {
                    $this->load('ucenter');
                    $_ENV['ucenter']->login($user['username'], $user['password']);
                }
                $_ENV['user']->refresh($user['uid']);
            }
            $openid = $_ENV['user']->get_openid($access_token);
            (!$openid) && $this->message('qq��������,����ϵ����Ա!', 'STOP');
            $userinfo = $_ENV['user']->get_oauth_info($access_token, $openid);
        }

        $navtitle = 'ע�����û�';
        $avatardir = "/data/avatar/";
        // if (!$this->setting['allow_register']) {
        //     $this->message("ϵͳע�Ṧ����ʱ���ڹر�״̬!", 'STOP');
        // }
        if (isset($this->base->setting['max_register_num']) && $this->base->setting['max_register_num'] && !$_ENV['user']->is_allowed_register()) {
            $this->message("���ĵ�ǰ��IP�Ѿ������������ע����Ŀ��������������ϵ����Ա!", 'STOP');
            exit;
        }
        $forward = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;
        $this->setting['passport_open'] && !$this->setting['passport_type'] && $_ENV['user']->passport_client(); //ͨ��֤����
        if (isset($this->post['submit'])) {
             // $this->message("վ����ʱ��ֹ�û�ע��!", 'user/register');
            $username = trim($this->post['username']);
            $password = trim($this->post['password']);
            $email = $this->post['email'];
            if ('' == $username || '' == $password) {
                $this->message("�û��������벻��Ϊ��!", 'user/register');
            } else if (!preg_match("/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/", $email)) {
                $this->message("�ʼ���ַ���Ϸ�!", 'user/register');
            } else if ($this->db->fetch_total('user', " email='$email' ")) {
                $this->message("���ʼ���ַ�Ѿ�ע��!", 'user/register');
            } else if (!$_ENV['user']->check_usernamecensor($username)) {
                $this->message("�ʼ���ַ����ֹע��!", 'user/register');
            }
            $this->setting['code_register'] && $this->checkcode(); //�����֤��
            $user = $_ENV['user']->get_by_username($username);
            $user && $this->message("�û��� $username �Ѿ�����!", 'user/register');
            //ucenterע��ɹ����򲻻����ִ�к���Ĵ��롣
            if ($this->setting["ucenter_open"]) {
                $this->load('ucenter');
                $_ENV['ucenter']->register();
            }
            if (isset($this->post['access_token'])) {
                $uid = $_ENV['user']->add($username, $password, $email, 0, $this->post['access_token']);
                if (isset($this->post['qqavatar']) && $this->post['qqavatar']) {
                    $uid = sprintf("%09d", $uid);
                    $dir1 = $avatardir . substr($uid, 0, 3);
                    $dir2 = $dir1 . '/' . substr($uid, 3, 2);
                    $dir3 = $dir2 . '/' . substr($uid, 5, 2);
                    (!is_dir(TIPASK_ROOT . $dir1)) && forcemkdir(TIPASK_ROOT . $dir1);
                    (!is_dir(TIPASK_ROOT . $dir2)) && forcemkdir(TIPASK_ROOT . $dir2);
                    (!is_dir(TIPASK_ROOT . $dir3)) && forcemkdir(TIPASK_ROOT . $dir3);
                    $smallimg = $dir3 . "/small_" . $uid . '.jpg';
                    $avatar_dir = glob(TIPASK_ROOT . $dir3 . "/small_{$uid}.*");
                    foreach ($avatar_dir as $imgfile) {
                        unlink($imgfile);
                    }
                    get_remote_image($this->post['qqavatar'], TIPASK_ROOT . $smallimg);
                }
            } else {
                $uid = $_ENV['user']->add($username, $password, $email);
            }

            $_ENV['user']->refresh($uid);
            $this->credit($this->user['uid'], $this->setting['credit1_register'], $this->setting['credit2_register']); //ע�����ӻ���
            //ͨ��֤����
            $forward = isset($this->post['forward']) ? $this->post['forward'] : SITE_URL;
            $this->setting['passport_open'] && $this->setting['passport_type'] && $_ENV['user']->passport_server($forward);
            //�����ʼ�֪ͨ
            $subject = "��ϲ����" . $this->setting['site_name'] . "ע��ɹ���";
            $message = '<p>���������Ե�¼<a swaped="true" target="_blank" href="' . SITE_URL . '">' . $this->setting['site_name'] . '</a>���ɵ����ʺͻش����⡣ף��ʹ����졣</p>';
            sendmail($this->user, $subject, $message);
            $this->message('��ϲ��ע��ɹ���');
        } else {
            include template('register');
        }
    }

    function onlogin() {
        $navtitle = '��¼';
        $forward = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;
        $this->setting['passport_open'] && !$this->setting['passport_type'] && $_ENV['user']->passport_client(); //ͨ��֤����
        if (isset($this->post['submit'])) {
            $username = trim($this->post['username']);
            // if($username!='testuser'){
            //     $this->message('վ����ͣ�û���¼���Ժ�����', 'user/login');
            // }

            $password = md5($this->post['password']);
            $cookietime = intval($this->post['cookietime']);
            //ucenter��¼�ɹ����򲻻����ִ�к���Ĵ��롣
            if ($this->setting["ucenter_open"]) {
                $this->load('ucenter');
                $_ENV['ucenter']->login($username, $password);
            }
            $this->setting['code_login'] && $this->checkcode(); //�����֤��
            $user = $_ENV['user']->get_by_username($username);
            if (is_array($user) && ($password == $user['password'])) {
                $_ENV['user']->refresh($user['uid'], 1, $cookietime);
                $forward = isset($this->post['forward']) ? $this->post['forward'] : SITE_URL; //ͨ��֤����
                $this->setting['passport_open'] && $this->setting['passport_type'] && $_ENV['user']->passport_server($forward);
                $this->credit($this->user['uid'], $this->setting['credit1_login'], $this->setting['credit2_login']); //��¼���ӻ���
                $this->message("��¼�ɹ�!");
            } else {
                $this->message('�û������������', 'user/login');
            }
        } else {
            include template('login');
        }
    }

    /* ����ajax��¼ */

    function onajaxlogin() {
        $username = $this->post['username'];
        if (TIPASK_CHARSET == 'GBK') {
            require_once(TIPASK_ROOT . '/lib/iconv.func.php');
            $username = utf8_to_gbk($username);
        }
        $password = md5($this->post['password']);
        $user = $_ENV['user']->get_by_username($username);
        if (is_array($user) && ($password == $user['password'])) {
            $_ENV['user']->refresh($user['uid']);
            exit('1');
        }
        exit('-1');
    }

//qqlogin
    function onqqlogin() {
        $state = md5(uniqid(rand(), TRUE));
        tcookie('state', $state);
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
                . $this->setting['qqlogin_appid'] . "&redirect_uri=" . urlencode(SITE_URL . "plugin/qqlogin/qq_callback.php")
                . "&state=" . $state
                . "&scope=get_user_info";
        header("Location:$login_url");
    }

    /* ����ajax����û����Ƿ���� */

    function onajaxusername() {
        $username = $this->post['username'];
        if (TIPASK_CHARSET == 'GBK') {
            require_once(TIPASK_ROOT . '/lib/iconv.func.php');
            $username = utf8_to_gbk($username);
        }
        $user = $_ENV['user']->get_by_username($username);
        if (is_array($user)
        )
            exit('-1');
        $usernamecensor = $_ENV['user']->check_usernamecensor($username);
        if (FALSE == $usernamecensor)
            exit('-2');
        exit('1');
    }

    /* ����ajax����û����Ƿ���� */

    function onajaxemail() {
        $email = $this->post['email'];
        $user = $_ENV['user']->get_by_email($email);
        if (is_array($user)
        )
            exit('-1');
        $emailaccess = $_ENV['user']->check_emailaccess($email);
        if (FALSE == $emailaccess
        )
            exit('-2');
        exit('1');
    }

    /* ����ajax�����֤���Ƿ�ƥ�� */

    function onajaxcode() {
        $code = strtolower(trim($this->post['code']));
        echo( intval($code == $_ENV['user']->get_code()) );
    }

    /* �˳�ϵͳ */

    function onlogout() {
        $navtitle = '�ǳ�ϵͳ';
        //ucenter�˳��ɹ����򲻻����ִ�к���Ĵ��롣
        if ($this->setting["ucenter_open"]) {
            $this->load('ucenter');
            $_ENV['ucenter']->logout();
        }
        $forward = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;
        $this->setting['passport_open'] && !$this->setting['passport_type'] && $_ENV['user']->passport_client(); //ͨ��֤����
        $_ENV['user']->logout();
        $this->setting['passport_open'] && $this->setting['passport_type'] && $_ENV['user']->passport_server($forward); //ͨ��֤����
        $this->message('�ɹ��˳���');
    }

    /* �һ����� */

    function ongetpass() {
        $navtitle = '�һ�����';
        if (isset($this->post['submit'])) {
            $email = $this->post['email'];
            $name = $this->post['username'];
            $this->checkcode(); //�����֤��
            $touser = $_ENV['user']->get_by_name_email($name, $email);
            if ($touser) {
                $authstr = strcode($touser['username'], $this->setting['auth_key']);
                $_ENV['user']->update_authstr($touser['uid'], $authstr);
                $getpassurl = SITE_URL . '?user/resetpass/' . urlencode($authstr);
                $subject = "�һ�����" . $this->setting['site_name'] . "������";
                $message = '<p>���������<a swaped="true" target="_blank" href="' . SITE_URL . '">' . $this->setting['site_name'] . '</a>�����붪ʧ����������������һأ�</p><p><a swaped="true" target="_blank" href="' . $getpassurl . '">' . $getpassurl . '</a></p><p>���ֱ�ӵ���޷��򿪣��븴�����ӵ�ַ�����µ������������򿪡�</p>';
                sendmail($touser, $subject, $message);
                $this->message("�һ�������ʼ��Ѿ����͵�������䣬�����!", 'BACK');
            }
            $this->message("�û�����������д�������ʵ!", 'BACK');
        }
        include template('getpass');
    }

    /* �������� */

    function onresetpass() {
        $navtitle = '��������';
        @$authstr = $this->get[2] ? $this->get[2] : $this->post['authstr'];
        if (empty($authstr)
        )
            $this->message("�Ƿ��ύ��ȱ�ٲ���!", 'BACK');
        $authstr = urldecode($authstr);
        $username = strcode($authstr, $this->setting['auth_key'], 'DECODE');
        $theuser = $_ENV['user']->get_by_username($username);
        if (!$theuser || ($authstr != $theuser['authstr']))
            $this->message("����ַ�ѹ��ڣ�������ʹ���һ�����Ĺ���!", 'BACK');
        if (isset($this->post['submit'])) {
            $password = $this->post['password'];
            $repassword = $this->post['repassword'];
            if (strlen($password) < 6) {
                $this->message("���볤�Ȳ�������6λ!", 'BACK');
            }
            if ($password != $repassword) {
                $this->message("�����������벻һ��!", 'BACK');
            }
            $_ENV['user']->uppass($theuser['uid'], $password);
            $_ENV['user']->update_authstr($theuser['uid'], '');
            $this->message("��������ɹ�����ʹ���������¼!");
        }
        include template('resetpass');
    }

    function onask() {
        $navtitle = '�ҵ�����';
        $status = intval($this->get[2]);
        @$page = max(1, intval($this->get[3]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $questionlist = $_ENV['question']->list_by_uid($this->user['uid'], $status, $startindex, $pagesize);
        $questiontotal = intval($this->db->fetch_total('question', 'authorid=' . $this->user['uid'] . $_ENV['question']->statustable[$status]));
        $departstr = page($questiontotal, $pagesize, $page, "user/ask/$status"); //�õ���ҳ�ַ���
        include template('myask');
    }

    function onspace_ask() {
        $navtitle = 'TA������';
        $uid = intval($this->get[2]);
        $member = $_ENV['user']->get_by_uid($uid);
        //��������
        $membergroup = $this->usergroup[$member['groupid']];
        @$page = max(1, intval($this->get[3]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $questionlist = $_ENV['question']->list_by_uid($uid, 'all', $startindex, $pagesize);
        $questiontotal = intval($this->db->fetch_total('question', 'authorid=' . $uid . $_ENV['question']->statustable['all']));
        $departstr = page($questiontotal, $pagesize, $page, "user/space_ask/$uid"); //�õ���ҳ�ַ���
        include template('space_ask');
    }

    function onanswer() {
        $navtitle = '�ҵĻش�';
        $status = intval($this->get[2]);
        @$page = max(1, intval($this->get[3]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $answerlist = $_ENV['answer']->list_by_uid($this->user['uid'], $status, $startindex, $pagesize);
        $answersize = intval($this->db->fetch_total('answer', 'authorid=' . $this->user['uid'] . $_ENV['answer']->statustable[$status]));
        $departstr = page($answersize, $pagesize, $page, "user/answer/$status"); //�õ���ҳ�ַ���
        include template('myanswer');
    }

    function onspace_answer() {
        $navtitle = 'TA�Ļش�';
        $uid = intval($this->get[2]);
        $member = $_ENV['user']->get_by_uid($uid);
        //��������
        $membergroup = $this->usergroup[$member['groupid']];
        @$page = max(1, intval($this->get[3]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $answerlist = $_ENV['answer']->list_by_uid($uid, 'all', $startindex, $pagesize);
        $answersize = intval($this->db->fetch_total('answer', 'authorid=' . $uid . $_ENV['answer']->statustable['all']));
        $departstr = page($answersize, $pagesize, $page, "user/space_answer/$uid"); //�õ���ҳ�ַ���
        include template('space_answer');
    }

    function onfavorite() {
        $navtitle = '�ҵ��ղ�';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $favoritelist = $_ENV['favorite']->get_list($startindex, $pagesize);
        $questiontotal = $_ENV['favorite']->rownum_by_uid();
        $departstr = page($questiontotal, $pagesize, $page, "user/favorite"); //�õ���ҳ�ַ���
        include template('myfavorite');
    }

    function ondelfavorite() {
        $qid = intval($this->get[2]);
        $_ENV['favorite']->remove($qid);
        $this->message("ɾ���ɹ���", 'user/favorite');
    }

    function onscore() {
        $navtitle = '�ҵĻ���';
        if ($this->setting['outextcredits']) {
            $outextcredits = unserialize($this->setting['outextcredits']);
        }
        $higherneeds = intval($this->user['creditshigher'] - $this->user['credit1']);
        $adoptpercent = $_ENV['user']->adoptpercent($this->user);
        $highergroupid = $this->user['groupid'] + 1;
        isset($this->usergroup[$highergroupid]) && $nextgroup = $this->usergroup[$highergroupid];
        $credit_detail = $_ENV['user']->credit_detail($this->user['uid']);
        $detail1 = $credit_detail[0];
        $detail2 = $credit_detail[1];
        include template('myscore');
    }

    function onexchange() {
        $navtitle = '���ֶһ�';
        if ($this->setting['outextcredits']) {
            $outextcredits = unserialize($this->setting['outextcredits']);
        } else {
            $this->message("ϵͳû�п������ֶһ�!", 'BACK');
        }
        $exchangeamount = $this->post['exchangeamount']; //��Ҫ�һ��Ļ�����
        $outextindex = $this->post['outextindex']; //��ȡ��Ӧ��������
        $outextcredit = $outextcredits[$outextindex];
        $creditsrc = $outextcredit['creditsrc']; //���ֶһ���Դ���ֱ��
        $appiddesc = $outextcredit['appiddesc']; //���ֶһ���Ŀ��Ӧ�ó��� ID
        $creditdesc = $outextcredit['creditdesc']; //���ֶһ���Ŀ����ֱ��
        $ratio = $outextcredit['ratio']; //���ֶһ�����
        $needamount = $exchangeamount / $ratio; //��Ҫ�۳��Ļ�����

        if ($needamount <= 0) {
            $this->message("�һ��Ļ��ֱ������0 !", 'BACK');
        }
        if (1 == $creditsrc) {
            $titlecredit = '����ֵ';
            if ($this->user['credit1'] < $needamount) {
                $this->message("{$titlecredit}����!", 'BACK');
            }
            $this->credit($this->user['uid'], -$needamount, 0, 0, 'exchange'); //�۳���ϵͳ����
        } else {
            $titlecredit = '�Ƹ�ֵ';
            if ($this->user['credit2'] < $needamount) {
                $this->message("{$titlecredit}����!", 'BACK');
            }
            $this->credit($this->user['uid'], 0, -$needamount, 0, 'exchange'); //�۳���ϵͳ����
        }
        $this->load('ucenter');
        $_ENV['ucenter']->exchange($this->user['uid'], $creditsrc, $creditdesc, $appiddesc, $exchangeamount);
        $this->message("���ֶһ��ɹ�!  ���ڡ�{$this->setting[site_name]}����{$titlecredit}������{$needamount}��");
    }

    /* ���������޸����� */

    function onprofile() {
        $navtitle = '��������';
        if (isset($this->post['submit'])) {
            $gender = $this->post['gender'];
            $bday = $this->post['birthyear'] . '-' . $this->post['birthmonth'] . '-' . $this->post['birthday'];
            $phone = $this->post['phone'];
            $qq = $this->post['qq'];
            $msn = $this->post['msn'];
            $messagenotify = isset($this->post['messagenotify']) ? 1 : 0;
            $mailnotify = isset($this->post['mailnotify']) ? 2 : 0;
            $isnotify = $messagenotify + $mailnotify;
            $signature = $this->post['signature'];
            if (($this->post['email'] != $this->user['email']) && (!preg_match("/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/", $this->post['email']) || $this->db->fetch_total('user', " email='" . $this->post['email'] . "' "))) {
                $this->message("�ʼ���ʽ����ȷ���ѱ�ռ��!", 'user/profile');
            }
            $_ENV['user']->update($this->user['uid'], $gender, $bday, $phone, $qq, $msn, $signature, $isnotify);
            isset($this->post['email']) && $_ENV['user']->update_email($this->post['email'], $this->user['uid']);
            $this->message("�������ϸ��³ɹ�", 'user/profile');
        }
        include template('profile');
    }

    function onuppass() {
        $this->load("ucenter");
        $navtitle = "�޸�����";
        if (isset($this->post['submit'])) {
            if (trim($this->post['newpwd']) == '') {
                $this->message("�����벻��Ϊ�գ�", 'user/uppass');
            } else if (trim($this->post['newpwd']) != trim($this->post['confirmpwd'])) {
                $this->message("�������벻һ��", 'user/uppass');
            } else if (trim($this->post['oldpwd']) == trim($this->post['newpwd'])) {
                $this->message('�����벻�ܸ���ǰ�����ظ�!', 'user/uppass');
            } else if (md5(trim($this->post['oldpwd'])) == $this->user['password']) {
                $_ENV['user']->uppass($this->user['uid'], trim($this->post['newpwd']));
                $this->message("�����޸ĳɹ�", 'user/uppass');
            } else {
                $this->message("���������", 'user/uppass');
            }
        }
        include template('uppass');
    }

    // 1����  2�ش�
    function onspace() {
        $navtitle = "���˿ռ�";
        $userid = intval($this->get[2]);
        if ($userid) {
            $member = $_ENV['user']->get_by_uid($userid);
            $membergroup = $this->usergroup[$member['groupid']];
            $adoptpercent = $_ENV['user']->adoptpercent($member);
            $answerlist = $_ENV['answer']->list_by_uid($member['uid'], 'all');
            $navtitle = $member['username'] . $navtitle;
            include template('space');
        } else {
            $this->message("��Ǹ�����û����˿ռ䲻���ڣ�", 'BACK');
        }
    }

    // 0�����С�1�������� ��2��������
    //user/scorelist/1/
    function onscorelist() {
        $navtitle = "�������а�";
        $type = isset($this->get[2]) ? $this->get[2] : 0;
        $userlist = $_ENV['user']->list_by_credit($type, 100);
        $usercount = count($userlist);
        include template('scorelist');
    }

    function onfamouslist() {
        $this->load("famous");
        @$page = max(1, intval($this->get[2]));
        $pagesize = 10;
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $rownum = $this->db->fetch_total('user', " elect>0");
        $departstr = page($rownum, $pagesize, $page, "user/famouslist"); //�õ���ҳ�ַ���
        $famouslist = $_ENV['famous']->get_list(10, $startindex, $pagesize);
        $questionlist = $_ENV['famous']->get_solves();
        include template("recommenduser");
    }

    function oneditimg() {
        if (isset($_FILES["userimage"])) {
            $uid = intval($this->get[2]);
            $avatardir = "/data/avatar/";
            $extname = extname($_FILES["userimage"]["name"]);
            if (!isimage($extname))
                exit('type_error');
            $upload_tmp_file = TIPASK_ROOT . '/data/tmp/user_avatar_' . $uid . '.' . $extname;
            $uid = abs($uid);
            $uid = sprintf("%09d", $uid);
            $dir1 = $avatardir . substr($uid, 0, 3);
            $dir2 = $dir1 . '/' . substr($uid, 3, 2);
            $dir3 = $dir2 . '/' . substr($uid, 5, 2);
            (!is_dir(TIPASK_ROOT . $dir1)) && forcemkdir(TIPASK_ROOT . $dir1);
            (!is_dir(TIPASK_ROOT . $dir2)) && forcemkdir(TIPASK_ROOT . $dir2);
            (!is_dir(TIPASK_ROOT . $dir3)) && forcemkdir(TIPASK_ROOT . $dir3);
            $smallimg = $dir3 . "/small_" . $uid . '.' . $extname;
            if (move_uploaded_file($_FILES["userimage"]["tmp_name"], $upload_tmp_file)) {
                $avatar_dir = glob(TIPASK_ROOT . $dir3 . "/small_{$uid}.*");
                foreach ($avatar_dir as $imgfile) {
                    if (strtolower($extname) != extname($imgfile))
                        unlink($imgfile);
                }
                if (image_resize($upload_tmp_file, TIPASK_ROOT . $smallimg, 100, 100))
                    echo 'ok';
            }
        } else {
            if ($this->setting["ucenter_open"]) {
                $this->load('ucenter');
                $imgstr = $_ENV['ucenter']->set_avatar($this->user['uid']);
            }
            include template("editimg");
        }
    }

    function onsaveimg() {
        $x1 = $this->post['x1'];
        $y1 = $this->post['y1'];
        $x2 = $this->post['x2'];
        $y2 = $this->post['y2'];
        $w = $this->post['w'];
        $h = $this->post['h'];
        $ext = $this->post['ext'];
        $upload_tmp_file = TIPASK_ROOT . "/data/tmp/" . 'bigavatar' . $this->user['uid'] . $ext;
        $avatardir = "/data/avatar/"; //ͼƬ���Ŀ¼
        $scale = 100 / $w;
        resizeThumbnailImage($smallimg, $upload_tmp_file, $w, $h, $x1, $y1, $scale);
        copy($upload_tmp_file, TIPASK_ROOT . $dir3 . '/big_' . $uid . $ext);
        is_file($upload_tmp_file) && unlink($upload_tmp_file);
        $_ENV['user']->update_avatar($smallimg);
        $this->message('ͷ�����óɹ���', 'user/editimg');
    }

    /* �û�����鿴����ϸ��Ϣ */

    function onajaxuserinfo() {
        $uid = intval($this->get[2]);
        if ($uid) {
            $userinfo = $_ENV['user']->get_by_uid($uid);
            $userinfo_group = $this->usergroup[$userinfo['groupid']];
            include template("ajaxuserinfo");
        }
    }

    //���ֳ�ֵ
    function onrecharge() {
        include template("recharge");
    }

}

?>