<?php

!defined('IN_TIPASK') && exit('Access Denied');

class notecontrol extends base {

    function notecontrol(& $get,& $post) {
        $this->base( & $get,& $post);
        $this->load("note");
    }

    /*ǰ̨�鿴�����б�*/
    function onlist() {
        $navtitle='�����б�';
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $rownum=$this->db->fetch_total('note',' 1=1');
        $notelist = $_ENV['note']->get_list($startindex,$pagesize);
        $departstr=page($rownum, $pagesize, $page,"note/list");//�õ���ҳ�ַ���
        include template('notelist');
    }

    /*�������*/
    function onview() {
        $navtitle='�������';
        $note=$_ENV['note']->get($this->get[2]);
        $note['time']=tdate($note['time'],3,0);
        include template('note');
    }


}

?>