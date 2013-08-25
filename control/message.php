<?php

!defined('IN_TIPASK') && exit('Access Denied');

class messagecontrol extends base {

    function messagecontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load('user');
        $this->load("message");
    }

    /* δ����Ϣ�б� */

    function onnew() {
        global $newnum, $personalnum, $systemnum;
        $navtitle = '�ռ���';
        /* ���ղ��� */
        $type = 'new';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        /* ��ȡ���� */
        $messagelist = $_ENV['message']->list_by_uid($this->user['uid'], 'in', 0, $startindex, $pagesize);
        $messagenum = $this->user['newmsg'];
        $departstr = page($newnum, $pagesize, $page, "message/new"); //�õ���ҳ�ַ���
        include template('mymsg');
    }

    /* ˽����Ϣ�б� */

    function onpersonal() {
        global $newnum, $personalnum, $systemnum;
        $navtitle = '˽����Ϣ';
        /* ���ղ��� */
        $type = 'personal';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        /* ��ȡ���� */
        $messagelist = $_ENV['message']->list_by_uid($this->user['uid'], 'in', 1, $startindex, $pagesize);
        $messagenum = $this->db->fetch_total('message', 'fromuid!=0 AND touid=' . $this->user['uid'] . ' AND status NOT IN (2,3)');
        $departstr = page($messagenum, $pagesize, $page, "message/personal"); //�õ���ҳ�ַ���
        include template('mymsg');
    }

    /* ϵͳ��Ϣ�б� */

    function onsystem() {
        global $newnum, $personalnum, $systemnum;
        $navtitle = 'ϵͳ��Ϣ';
        /* ���ղ��� */
        $type = 'system';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        /* ��ȡ���� */
        $messagelist = $_ENV['message']->list_by_uid($this->user['uid'], 'in', 2, $startindex, $pagesize);
        $messagenum = $this->db->fetch_total('message', 'fromuid=0 AND touid=' . $this->user['uid'] . ' AND status NOT IN (2,3)');
        $departstr = page($messagenum, $pagesize, $page, "message/system"); //�õ���ҳ�ַ���
        include template('mymsg');
    }

    /* �ѷ���Ϣ�б� */

    function onoutbox() {
        global $newnum, $personalnum, $systemnum;
        $navtitle = '�ѷ���Ϣ';
        /* ���ղ��� */
        $type = 'outbox';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize; //ÿҳ����ʾ$pagesize��
        $uid = $this->user['uid'];
        /* ��ȡ���� */
        $rownum = $this->db->fetch_total('message', ' fromuid=' . $uid . ' AND `status` NOT IN (1,3)'); //��ȡ�ܵļ�¼��
        $messagelist = $_ENV['message']->list_by_uid($uid, 'out', 3, $startindex, $pagesize);
        $departstr = page($rownum, $pagesize, $page, "message/outbox"); //�õ���ҳ�ַ���
        include template('mymsg');
    }

    /* ����Ϣ */

    function onsend() {
        $navtitle = '��վ����Ϣ';
        if (isset($this->post['username'])) {
            (!$this->post['title']) && $this->message('���ⲻ��Ϊ��!', "message/send");
            $touser = $_ENV['user']->get_by_username(trim($this->post['username']));
            (!$touser) && $this->message('���û������ڣ�', "message/send");
            $this->setting['code_message'] && $this->checkcode(); //�����֤��
            $_ENV['message']->add($this->user['username'], $this->user['uid'], $touser['uid'], $this->post['title'], $this->post['content']);
            $this->credit($this->user['uid'], $this->setting['credit1_message'], $this->setting['credit2_message']); //���ӻ���
            $this->message('��Ϣ���ͳɹ���', "message/new");
        }
        include template('sendmsg');
    }

    /* �鿴��Ϣ */

    function onajaxview() {
        global $newnum, $personalnum, $systemnum;
        $navtitle = "�鿴��Ϣ";
        $message = $_ENV['message']->get($this->get[2]);
        $type = ($message['touid'] == $this->user['uid']) ? 'in' : 'out';
        $touser = $_ENV['user']->get_by_uid($message['touid']);
        if ($message['new'] && !isset($this->get[3])) {
            $_ENV['message']->update_new($message['id']);
        }
        include template('viewmsg');
    }

    /* ɾ����Ϣ */

    /**
     * ������Ϣ״̬ status = 0  ��Ϣ�����߶�û��ɾ����1��������Ϣ��ɾ����2�����ռ���ɾ����3����ɾ��
     */
    function onremove() {
        if (isset($this->post['mid']) || isset($this->get[2])) {
            $mids = (isset($this->post['mid'])) ? implode(",", $this->post['mid']) : $this->get[2];
            $type = (isset($this->post['type'])) ? $this->post['type'] : $this->get[3];
            $_ENV['message']->update_status($mids, $type);
            if ('out' == $type)
                $this->message('��Ϣɾ���ɹ���', 'message/outbox');
            else 
                $this->message('��Ϣɾ���ɹ���', 'message/new');
            
        }
        $this->onpersonal();
    }

}

?>