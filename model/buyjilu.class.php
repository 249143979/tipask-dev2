<?php

!defined('IN_TIPASK') && exit('Access Denied');

class buyjilumodel {

	var $db;
	var $base;

	function buyjilumodel(&$base) {
		$this->base = $base;
		$this->db = $base->db;
		$sid=$this->base->user['sid'];
	}

	/*����aid��ȡһ���𰸵����ݣ���ʱ����*/
	function get($id) {
		return $this->db->fetch_first("SELECT * FROM ".DB_TABLEPRE."buyjilu WHERE buyjilu_id='$id'");
	}

	function getquestionmsg($qid){
		//echo "SELECT price FROM ".DB_TABLEPRE."question WHERE id='$qid'";
		//$arr = $this->db->fetch_first("SELECT price FROM ".DB_TABLEPRE."question WHERE id='$qid'");
		$arr = $this->db->fetch_first("SELECT description,authorid FROM ".DB_TABLEPRE."question WHERE id='$qid'");
		//print_r($arr);
		//preg_replace("/\[sell=(.+?)\](.+?)\[\/sell\]/eis","$this->getprice('\\1','\\2')",$arr['description']);
		preg_match("/\[sell=(.+?)\](.+?)\[\/sell\]/eis",$arr['description'],$arr_p);
		list($creditvalue,$credittype) = explode(',',$arr_p[1]);
		return array('price'=>(int)$creditvalue,'authorid'=>$arr['authorid']);
	}
	/*��Ӵ�*/
	function add($qid,$user_id,$price,$authorid) {
		//
		$arr = $this->db->fetch_first("SELECT buyjilu_id FROM ".DB_TABLEPRE."buyjilu WHERE question_id=$qid and uid=$user_id");
		if (!empty($arr)) {
			return $arr[0]['buyjilu_id'];
		}
		//
		$this->db->query("INSERT INTO ".DB_TABLEPRE."buyjilu SET question_id=$qid,uid=$user_id" );
		$buyjilu_id = $this->db->insert_id();
		//���ٲƸ�ֵ
		$sql = "UPDATE ".DB_TABLEPRE."user SET `credit2`=credit2-".$price." WHERE (`uid`='".$user_id."')";
		//echo $sql;exit();
		$this->db->query($sql);
		//���ӳ��۷��Ƹ�ֵ
		$sql = "UPDATE ".DB_TABLEPRE."user SET `credit2`=credit2+".$price." WHERE (`uid`='".$authorid."')";
		//echo $sql;exit();
		$this->db->query($sql);
		//
		return $buyjilu_id;
	}
}
?>
