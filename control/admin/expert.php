<?php

!defined('IN_TIPASK') && exit('Access Denied');

class admin_expertcontrol extends base {

    function admin_expertcontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load('expert');
        $this->load('user');
        $this->load('category');
    }

    function ondefault($msg='') {
        $expertlist = $_ENV['expert']->get_list(0,0, 100);
        $category_js = $_ENV['category']->get_js();
        $msg && $message = $msg;
        include template('expertlist', 'admin');
    }

    function onadd() {
        $type = 'correctmsg';
        $message = '';
        $cids = explode(" ", trim($this->post['goodatcategory']));
        $username = $this->post['username'];
        if (count($cids) > 3 || count($cids) < 1) {
            $type = 'errormsg';
            $message .= "<br />�ó����಻�ܳ���3������С��1��";
        }
        $user = $_ENV['user']->get_by_username($username);
        if (!$user) {
            $type = 'errormsg';
            $message = "�û��� [$username] ������";
        }
        if($user['expert']){
            $type = 'errormsg';
            $message = "�û�".$user['username'].'�Ѿ���ר���ˣ������ظ����ã�';
        }
        //���ר��
        if ('correctmsg' == $type) {
            $_ENV['expert']->add($user['uid'], $cids);
        }
        $this->ondefault($message,$type);
    }

    function onremove() {
        if (count($this->post['delete'])) {
            $_ENV['expert']->remove(implode(',', $this->post['delete']));
            $type = 'correctmsg';
            $message = "ɾ���ɹ���";
            $this->ondefault($message);
        }
    }

    function onajaxgetname() {
        if (isset($this->post['cid']) && intval($this->post['cid'])) {
            $categorylist = $_ENV['category']->get_navigation($this->post['cid'], true);
            $categorystr = '';
            foreach ($categorylist as $category) {
                $categorystr .=$category['name'] . ' > ';
            }
            echo substr($categorystr, 0, -2);
        }
    }

}

?>