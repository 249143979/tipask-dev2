<?php

!defined('IN_TIPASK') && exit('Access Denied');

class admin_wordcontrol extends base {

    function admin_wordcontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load("badword");
    }

    function ondefault($message='') {
        $this->cache->remove('word');
        if (empty($message))
            unset($message);
        $wordlist = $_ENV['badword']->get_list();
        include template('wordlist', 'admin');
    }

    function onadd() {
        if (isset($this->post['submit']) && $this->post['id']) {
            $ids = implode(",", $this->post['id']);
            $_ENV['badword']->remove_by_id($ids);
            $message = "ɾ���ɹ�!";
        } else {
            $_ENV['badword']->add($this->post['wid'], $this->post['find'], $this->post['replacement'], $this->user['username']);
            $message = "�޸ĳɹ�!";
        }
        $this->ondefault($message);
    }

    function onmuladd() {
        if (isset($this->post['submit'])) {
            $lines = explode("\n", $this->post['badwords']);
            $_ENV['badword']->multiadd($lines, $this->user['username']);
            $this->ondefault("��ӳɹ�!");
        } else {
            include template('addword', "admin");
        }
    }

}

?>