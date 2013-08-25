<?php

!defined('IN_TIPASK') && exit('Access Denied');

//0��δ��� 1���������2���ѽ�� 4�����͵� 9�� �ѹر�����


class questioncontrol extends base {

    function questioncontrol(& $get, & $post) {
        $this->base(& $get, & $post);
        $this->load("question");
        $this->load("category");
        $this->load("answer");
        $this->load("expert");
        $this->load("tag");
        $this->load("userlog");
    }

    /* �ύ���� */

    function onadd() {
        $navtitle = "�������";
        if (isset($this->post['submit'])) {
            $title = $this->post['title'];
		$ask_area = $this->post['ask_area'];
		if (empty($ask_area)) {
				$ask_area = '';
			}
            $description = $this->post['description'];
            $cid1 = $this->post['classlevel1'];
            $cid2 = $this->post['classlevel2'];
            $cid3 = $this->post['classlevel3'];
            $cid = $this->post['cid'];
            $tags = array_filter($this->post['qtags']);
            $hidanswer = intval($this->post['hidanswer']) ? 1 : 0;
            $price = intval($this->post['givescore']);
            $askfromuid = $this->post['askfromuid'];
            //�������ֵ
            //if($this->user['credit3']<$this->user)
            $this->setting['code_ask'] && $this->checkcode(); //�����֤��
            //���Ƹ�ֵ
            (intval($this->user['credit3']) < $this->setting['allow_credit3']) && $this->message("�������̫�ͣ���ֹ���ʣ�������������ϵ����Ա!", 'BACK');
            $offerscore = $price;
            ($hidanswer) && $offerscore+=10;
            (intval($this->user['credit2']) < $offerscore) && $this->message("�Ƹ�ֵ����!", 'BACK');
            //�����˺������ⲿURL����
            $status = intval(1 != (1 & $this->setting['verify_question']));
            $allow = $this->setting['allow_outer'];
            if (3 != $allow && has_outer($description)) {
                0 == $allow && $this->message("���ݰ����ⲿ���ӣ�����ʧ��!", 'BACK');
                1 == $allow && $status = 0;
                2 == $allow && $description = filter_outer($description);
            }
            //������Υ����
            $contentarray = checkwords($title);
            1 == $contentarray[0] && $status = 0;
            2 == $contentarray[0] && $this->message("��������Ƿ��ؼ��ʣ�����ʧ��!", 'BACK');
            $title = $contentarray[1];

            //�����������Υ����
            $descarray = checkwords($description);
            1 == $descarray[0] && $status = 0;
            2 == $descarray[0] && $this->message("�������������Ƿ��ؼ��ʣ�����ʧ��!", 'BACK');
            $description = $descarray[1];

            /* ����������Ƿ񳬹������� */
            ($this->user['questionlimits'] && ($_ENV['userlog']->rownum_by_time('ask') >= $this->user['questionlimits'])) &&
                    $this->message("���ѳ���ÿСʱ���������" . $this->user['questionlimits'] . ',���Ժ����ԣ�', 'BACK');

            $qid = $_ENV['question']->add($title, $description, $hidanswer, $price, $cid, $cid1, $cid2, $cid3, $status,$ask_area);
            $tags && $_ENV['tag']->multi_add($tags, $qid);

            //�����û����֣��۳��û����͵ĲƸ�
            if ($this->user['uid']) {
                $this->credit($this->user['uid'], 0, -$offerscore, 0, 'offer');
                $this->credit($this->user['uid'], $this->setting['credit1_ask'], $this->setting['credit2_ask']);
            }
            $viewurl = urlmap('question/view/' . $qid, 2);
            /* �������������ʣ�����Ҫ������Ϣ������ */
            if ($askfromuid) {
                $this->load("message");
                $this->load("user");
                $touser = $_ENV['user']->get_by_uid($askfromuid);
                $_ENV['message']->add($this->user['username'], $this->user['uid'], $touser['uid'], '��������:' . $title, $description . '<br /> <a href="' . SITE_URL . $this->setting['seo_prefix'] . $viewurl . $this->setting['seo_suffix'] . '">����鿴����</a>');
                sendmail($touser, '��������:' . $title, $description . '<br /> <a href="' . SITE_URL . $this->setting['seo_prefix'] . $viewurl . $this->setting['seo_suffix'] . '">����鿴����</a>');
            }
            //���ucenter��������postfeed
            if ($this->setting["ucenter_open"] && $this->setting["ucenter_ask"]) {
                $this->load('ucenter');
                $_ENV['ucenter']->ask_feed($qid, $title, $description);
            }
            $_ENV['userlog']->add('ask');
            if (0 == $status) {
                $this->message('���ⷢ���ɹ���Ϊ��ȷ���ʴ�����������ǻ�������������ݽ�����ˡ������ĵȴ�......', 'BACK');
            } else {
                $this->message("���ⷢ���ɹ�!", $viewurl);
            }
        } else {
            if (0 == $this->user['uid']) {
                $this->setting["ucenter_open"] && $this->message("UCenter����������������!", 'BACK');
            }
            $category_js = $_ENV['category']->get_js();
            @$word = $this->post['word'];
            $askfromuid = intval($this->get['2']);
            if ($askfromuid)
                $touser = $_ENV['user']->get_by_uid($askfromuid);
            include template('ask');
        }
    }

    /* ������� */

    function onview() {
        $this->setting['stopcopy_on'] && $_ENV['question']->stopcopy(); //�Ƿ����˷��ɼ�����
        $qid = $this->get[2]; //����qid����
        $_ENV['question']->add_views($qid); //���������������
        $question = $_ENV['question']->get($qid);
        empty($question) && $this->message('�����Ѿ���ɾ����');
        (0 == $question['status']) && $this->message('������������У������ĵȴ���');
        /* ������ڴ��� */
        if ($question['endtime'] < $this->time && ($question['status'] == 1 || $question['status'] == 4)) {
            $question['status'] = 9;
            $_ENV['question']->update_status($qid, 9);
            $this->send($question['authorid'], $question['id'], 2);
        }
        $asktime = tdate($question['time']);
        $endtime = timeLength($question['endtime'] - $this->time);
        $solvetime = tdate($question['endtime']);
        $supplylist = $_ENV['question']->supply_list($question['supply']); //���ⲹ��
        if (isset($this->get[3]) && $this->get[3] == 1) {
            $ordertype = 2;
            $ordertitle = '����鿴�ش�';
        } else {
            $ordertype = 1;
            $ordertitle = '����鿴�ش�';
        }
        //�ش��ҳ        
        @$page = max(1, intval($this->get[4]));
        $pagesize = 10;
        $startindex = ($page - 1) * $pagesize;
        $rownum = $this->db->fetch_total("answer", " qid=$qid AND status>0 AND adopttime =0"); //��ȡ�ܵļ�¼��
        $answerlistarray = $_ENV['answer']->list_by_qid($qid, $this->get[3], $rownum, $startindex, $pagesize);
        $departstr = page($rownum, $pagesize, $page, "question/view/$qid/" . $this->get[3]); //�õ���ҳ�ַ���        
        $answerlist = $answerlistarray[0];
        $already = $answerlistarray[1]; //�Ƿ��Ѿ��ش��������
        $solvelist = $_ENV['question']->list_by_cfield_cvalue_status('cid', $question['cid'], 2);    //��ȡ����Ѿ��������
        $nosolvelist = $_ENV['question']->list_by_cfield_cvalue_status('cid', $question['cid'], 1); //ͬ����������
        $navlist = $_ENV['category']->get_navigation($question['cid'], true); //��ȡ����
        $typearray = array('1' => 'nosolve', '2' => 'solve', '4' => 'nosolve', '6' => 'solve', '9' => 'close');
        $typedescarray = array('1' => '�����', '2' => '�ѽ��', '4' => '������', '6' => '���Ƽ�', '9' => '�ѹر�');
        $navtitle = $question['title'];
        $dirction = $typearray[$question['status']];
        ('solve' == $dirction) && $bestanswer = $_ENV['answer']->get_best($qid);
        $catetree = $_ENV['category']->get_categrory_tree();
        $taglist = $_ENV['tag']->get_by_qid($qid);
        $support = $_ENV['answer']->get_comment_options($this->user['credit3limits'], 1);
        $against = $_ENV['answer']->get_comment_options($this->user['credit3limits'], 0);
        /* SEO */
        $curnavname = $navlist[count($navlist) - 1]['name'];
        if ($this->setting['seo_question_title']) {
            $seo_title = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_question_title']);
            $seo_title = str_replace("{wtbt}", $question['title'], $seo_title);
            $seo_title = str_replace("{wtzt}", $typedescarray[$question['status']], $seo_title);
            $seo_title = str_replace("{flmc}", $curnavname, $seo_title);
        }
        if ($this->setting['seo_question_description']) {
            $seo_description = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_question_description']);
            $seo_description = str_replace("{wtbt}", $question['title'], $seo_description);
            $seo_description = str_replace("{wtzt}", $typedescarray[$question['status']], $seo_description);
            $seo_description = str_replace("{flmc}", $curnavname, $seo_description);
        }
        if ($this->setting['seo_question_keywords']) {
            $seo_keywords = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_question_keywords']);
            $seo_keywords = str_replace("{wtbt}", $question['title'], $seo_keywords);
            $seo_keywords = str_replace("{wtzt}", $typedescarray[$question['status']], $seo_keywords);
            $seo_keywords = str_replace("{flmc}", $curnavname, $seo_keywords);
        }
        //++++++
		//
		//�Ƿ�����������
		$is_sell = false;
		$question['islookquestion'] = 0;
		$question['issell'] = 0;
		if (strpos($question['description'],"[sell")!==false && strpos($question['description'],"[/sell]")!==false) {
			$question['issell'] = 1;
			$question['sellednum'] = $_ENV['question']->countSellRenShuo($qid);
			if ($this->user['groupid']==1 || $this->user['username']==$question['author'] || $_ENV['question']->isoklookquestion($qid,$this->user['uid'])) {
				$code_num = 0;
				$question['islookquestion'] = 1;
				$question['description'] = preg_replace("/\[sell=(.+?)\](.+?)\[\/sell\]/eis","sell('\\1','\\2',1,$qid)",$question['description']);
			}else{
				$code_num = 0;
				$question['description'] = preg_replace("/\[sell=(.+?)\](.+?)\[\/sell\]/eis","sell('\\1','\\2',0,$qid)",$question['description']);
			}
		}
		//�Ƿ�����������
		
		
		if (strpos($question['description'],"[post]")!==false && strpos($question['description'],"[/post]")!==false) {
			if ($this->user['groupid']==1 || $this->user['username']==$question['author'] || $_ENV['question']->isReQuestion($qid,$this->user['username'])) {
				$question['description']=preg_replace("/\[post\](.+?)\[\/post\]/eis","post('\\1',1)",$question['description']);
			}else{
				$question['description']=preg_replace("/\[post\](.+?)\[\/post\]/eis","post('\\1',0)",$question['description']);

			}
		}

		//$question['description'] = convert($question['description']);

		//print_r($question['description']);
        //++++++
        //echo $dirction;
        if ($question['ask_area']==1){
        }elseif ($question['ask_area']==2){
        	if ($dirction=='nosolve') {
        		$dirction = "nosolve_cf_zhixun";
        	}
        }elseif ($question['ask_area']==3){
         	if ($dirction=='nosolve') {
        		$dirction = "nosolve_cf_gongxiang";
        	}
        }elseif ($question['ask_area']==4){
        	if ($dirction=='nosolve') {
        		$dirction = "nosolve_taolun";
        	}
        }
        include template($dirction);
    }

    /* �ύ�ش� */

    function onanswer() {

        /**
         *  ͳһ�ж��ǲ��ǹ�ˮģ�飬�Ƿ��ύ��ˮ��
         * 
         */
        if((isset($this->post['mulitanswer'])&&$this->post['mulitanswer']==1)||in_array($this->post['ask_area'], array(3,4))){
            $this->onmulitanswer();
            return true;
        }else{

            print_r($this->post);
            exit;
        }



        //����ֵ���
        (intval($this->user['credit3']) < $this->setting['allow_credit3']) && $this->message("�������̫�ͣ���ֹ�ش�������������ϵ����Ա!", 'BACK');
        //ֻ����ר�һش�����
        if (isset($this->setting['allow_expert']) && $this->setting['allow_expert'] && !$this->user['expert']) {
            $this->message('վ��������Ϊֻ����ר�һش����⣬������������ϵվ��.');
        }
        $qid = $this->post['qid'];
        $question = $_ENV['question']->get($qid);
        if ($this->user['uid'] == $question['authorid']) {
            $this->message('�ύ�ش�ʧ�ܣ����������Դ�', 'question/view/' . $qid);
        }
        $this->setting['code_ask'] && $this->checkcode(); //�����֤��
        $already = $_ENV['question']->already($qid, $this->user['uid']);
        $already && $this->message('�����ظ��ش�ͬһ�����⣬�����޸��Լ��Ļش�', 'question/view/' . $qid);
        $title = $this->post['title'];
        $content = $this->post['content'];
        //�����˺������ⲿURL����
        $status = intval(2 != (2 & $this->setting['verify_question']));
        $allow = $this->setting['allow_outer'];
        if (3 != $allow && has_outer($content)) {
            0 == $allow && $this->message("���ݰ����ⲿ���ӣ�����ʧ��!", 'BACK');
            1 == $allow && $status = 0;
            2 == $allow && $content = filter_outer($content);
        }
        //���Υ����
        $contentarray = checkwords($content);
        1 == $contentarray[0] && $status = 0;
        2 == $contentarray[0] && $this->message("���ݰ����Ƿ��ؼ��ʣ�����ʧ��!", 'BACK');
        $content = $contentarray[1];

        /* ����������Ƿ񳬹������� */
        ($this->user['answerlimits'] && ($_ENV['userlog']->rownum_by_time('answer') >= $this->user['answerlimits'])) &&
                $this->message("���ѳ���ÿСʱ���ش���" . $this->user['answerlimits'] . ',���Ժ����ԣ�', 'BACK');

        $_ENV['answer']->add($qid, $title, $content, $status);
        //�ش����⣬��ӻ���
        $this->credit($this->user['uid'], $this->setting['credit1_answer'], $this->setting['credit2_answer']);
        //�������߷���֪ͨ
        $this->send($question['authorid'], $question['id'], 0);
        //���ucenter��������postfeed
        if ($this->setting["ucenter_open"] && $this->setting["ucenter_answer"]) {
            $this->load('ucenter');
            $_ENV['ucenter']->answer_feed($question, $content);
        }
        $viewurl = urlmap('question/view/' . $qid, 2);
        $_ENV['userlog']->add('answer');
        if (0 == $status) {
            $this->message('�ύ�ش�ɹ���Ϊ��ȷ���ʴ�����������ǻ�����Ļش����ݽ�����ˡ������ĵȴ�......', 'BACK');
        } else {
            $this->message('�ύ�ش�ɹ���', $viewurl);
        }
    }


     /* �ύ��ˮ���ʵĻش� */

    function onmulitanswer() {
        //����ֵ���
        (intval($this->user['credit3']) < $this->setting['allow_credit3']) && $this->message("�������̫�ͣ���ֹ�ش�������������ϵ����Ա!", 'BACK');
        //ֻ����ר�һش�����
        // if (isset($this->setting['allow_expert']) && $this->setting['allow_expert'] && !$this->user['expert']) {
        //     $this->message('վ��������Ϊֻ����ר�һش����⣬������������ϵվ��.');
        // }
        $qid = $this->post['qid'];
        $question = $_ENV['question']->get($qid);
        // if ($this->user['uid'] == $question['authorid']) {
        //     $this->message('�ύ�ش�ʧ�ܣ����������Դ�', 'question/view/' . $qid);
        // }
        $this->setting['code_ask'] && $this->checkcode(); //�����֤��
        // $already = $_ENV['question']->already($qid, $this->user['uid']);
        // $already && $this->message('�����ظ��ش�ͬһ�����⣬�����޸��Լ��Ļش�', 'question/view/' . $qid);
        $title = $this->post['title'];
        $content = $this->post['content'];
        //�����˺������ⲿURL����
        $status = intval(2 != (2 & $this->setting['verify_question']));
        $allow = $this->setting['allow_outer'];
        if (3 != $allow && has_outer($content)) {
            0 == $allow && $this->message("���ݰ����ⲿ���ӣ�����ʧ��!", 'BACK');
            1 == $allow && $status = 0;
            2 == $allow && $content = filter_outer($content);
        }
        //���Υ����
        $contentarray = checkwords($content);
        1 == $contentarray[0] && $status = 0;
        2 == $contentarray[0] && $this->message("���ݰ����Ƿ��ؼ��ʣ�����ʧ��!", 'BACK');
        $content = $contentarray[1];

        /* ����������Ƿ񳬹������� */
        ($this->user['answerlimits'] && ($_ENV['userlog']->rownum_by_time('answer') >= $this->user['answerlimits'])) &&
                $this->message("���ѳ���ÿСʱ���ش���" . $this->user['answerlimits'] . ',���Ժ����ԣ�', 'BACK');

        $_ENV['answer']->add($qid, $title, $content, $status);
        //�ش����⣬��ӻ���
        $this->credit($this->user['uid'], $this->setting['credit1_answer'], $this->setting['credit2_answer']);
        //�������߷���֪ͨ
        $this->send($question['authorid'], $question['id'], 0);
        //���ucenter��������postfeed
        if ($this->setting["ucenter_open"] && $this->setting["ucenter_answer"]) {
            $this->load('ucenter');
            $_ENV['ucenter']->answer_feed($question, $content);
        }
        $viewurl = urlmap('question/view/' . $qid, 2);
        $_ENV['userlog']->add('answer');
        if (0 == $status) {
            $this->message('�ύ�ش�ɹ�������Ҫ��˺�Ż���ʾ', 'BACK');
        } else {
            $this->message('�ύ�ش�ɹ���', $viewurl);
        }
    }

    /* ���ɴ� */

    function onadopt() {

        $qid = $this->post['qid'];
        $aid = $this->post['aid'];
        $comment = $this->post['content'];
        $question = $_ENV['question']->get($qid);
        $answer = $_ENV['answer']->get($aid);
        $_ENV['answer']->adopt($qid, $answer, $comment);
        //ͬ��������
        $this->load('famous');
        //������������͸�������Ϊ�𰸵Ļش���,ͬʱ����Ϣ֪ͨ�ش���
        $this->credit($answer['authorid'], $this->setting['credit1_adopt'], intval($question['price'] + $this->setting['credit2_adopt']), 0, 'adopt');
        $this->send($answer['authorid'], $question['id'], 1);
        $viewurl = urlmap('question/view/' . $qid, 2);

        $this->message('���ɴ𰸳ɹ���', $viewurl);
    }

    /* �������⣬û������Ļش𣬻���ֱ�ӽ������ʣ��ر����⡣ */

    function onclose() {
        $qid = intval($this->get[2]) ? intval($this->get[2]) : $this->post['qid'];
        $_ENV['question']->update_status($qid, 9);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $this->message('�ر�����ɹ���', $viewurl);
    }

    /* ��������ϸ�� */

    function onsupply() {
        $qid = $this->get[2] ? $this->get[2] : $this->post['qid'];
        $question = $_ENV['question']->get($qid);
        if (!$question)
            $this->message("���ⲻ���ڻ��ѱ�ɾ��!", "STOP");
        $navlist = $_ENV['category']->get_navigation($question['cid'], true);
        if (isset($this->post['submit'])) {
            $content = $this->post['content'];
            //�����˺������ⲿURL����
            $status = intval(1 != (1 & $this->setting['verify_question']));
            $allow = $this->setting['allow_outer'];
            if (3 != $allow && has_outer($content)) {
                0 == $allow && $this->message("���ݰ����ⲿ���ӣ�����ʧ��!", 'BACK');
                1 == $allow && $status = 0;
                2 == $allow && $content = filter_outer($content);
            }
            //���Υ����
            $contentarray = checkwords($content);
            1 == $contentarray[0] && $status = 0;
            2 == $contentarray[0] && $this->message("���ݰ����Ƿ��ؼ��ʣ�����ʧ��!", 'BACK');
            $content = $contentarray[1];

            $question = $_ENV['question']->get($qid);
            //������󲹳�������
            (count(unserialize($question['supply'])) >= $this->setting['apend_question_num']) && $this->message("���ѳ���������󲹳����" . $this->setting['apend_question_num'] . ",����ʧ�ܣ�", 'BACK');
            $_ENV['question']->add_supply($qid, $question['supply'], $content, $status); //������ⲹ��
            $viewurl = urlmap('question/view/' . $qid, 2);
            if (0 == $status) {
                $this->message('��������ɹ���Ϊ��ȷ���ʴ�����������ǻ�������������ݽ�����ˡ������ĵȴ�......', 'BACK');
            } else {
                $this->message('��������ɹ���', $viewurl);
            }
        }
        include template("addsupply");
    }

    /* ׷������ */

    function onaddscore() {
        $qid = $this->get[2];
        $score = $this->post['score'];
        if ($this->user['credit2'] < $score) {
            $this->message("�Ƹ�ֵ����!", 'BACK');
        }
        $_ENV['question']->update_score($qid, $score);
        $this->credit($this->user['uid'], 0, -$score, 0, 'offer');
        $viewurl = urlmap('question/view/' . $qid, 2);
        $this->message('׷�����ͳɹ���', $viewurl);
    }

    /* �޸Ļش� */

    function oneditanswer() {
        $navtitle = '�޸Ļش�';
        $aid = $this->get[2] ? $this->get[2] : $this->post['aid'];
        $answer = $_ENV['answer']->get($aid);
        (!$answer) && $this->message("�ش𲻴��ڻ��ѱ�ɾ����", "STOP");
        $question = $_ENV['question']->get($answer['qid']);
        $navlist = $_ENV['category']->get_navigation($question['cid'], true);
        if (isset($this->post['submit'])) {
            $content = $this->post['content'];
            $viewurl = urlmap('question/view/' . $question['id'], 2);

            //�����˺������ⲿURL����
            $status = intval(2 != (2 & $this->setting['verify_question']));
            $allow = $this->setting['allow_outer'];
            if (3 != $allow && has_outer($content)) {
                0 == $allow && $this->message("���ݰ����ⲿ���ӣ�����ʧ��!", $viewurl);
                1 == $allow && $status = 0;
                2 == $allow && $content = filter_outer($content);
            }
            //���Υ����
            $contentarray = checkwords($content);
            1 == $contentarray[0] && $status = 0;
            2 == $contentarray[0] && $this->message("���ݰ����Ƿ��ؼ��ʣ�����ʧ��!", $viewurl);
            $content = $contentarray[1];

            $_ENV['answer']->update_content($aid, $content, $status);

            if (0 == $status) {
                $this->message('�޸Ļش�ɹ���Ϊ��ȷ���ʴ�����������ǻ�����Ļش����ݽ�����ˡ������ĵȴ�......', $viewurl);
            } else {
                $this->message('�޸Ļش�ɹ���', $viewurl);
            }
        }
        include template("editanswer");
    }

    /* ׷��ģ��---׷�� */

    function ontagask() {
        $this->load("message");
        $aid = $this->post['aid'];
        $qid = $this->post['qid'];
        $answer = $_ENV['answer']->get($aid);
        $question = $_ENV['question']->get($qid);
        //���»ش���������ʷ���Ϣ
        if (isset($this->post['tag_ask'])) {
            $_ENV['answer']->add_tag($aid, $this->post['tag_ask'], $answer['tag']);
            $_ENV['message']->add($question['author'], $question['authorid'], $answer['authorid'], '����׷��:' . $question['title'], $question['description'] . '<br /> <a href="' . url('question/view/' . $qid, 1) . '">����鿴����</a>');
        } else {
            $_ENV['answer']->add_tag($aid, $this->post['tag_answer'], $answer['tag']);
            $_ENV['message']->add($answer['author'], $answer['authorid'], $question['authorid'], '�������»ش�:' . $question['title'], $question['description'] . '<br /> <a href="' . url('question/view/' . $qid, 1) . '">����鿴����</a>');
        }
        $viewurl = urlmap('question/view/' . $qid, 2);
        isset($this->post['tag_ask']) ? $this->message('�������ʳɹ�!', $viewurl) : $this->message('�����ش�ɹ�!', $viewurl);
    }

    /* �������� */

    function onsearch() {
        $qstatus = $status = $this->get[2];
        (3 == $status) && ($qstatus = "1,2,6");
        @$word = urldecode($this->post['word'] ? str_replace("%27", "", $this->post['word']) : $this->get[3]);
        (!trim($word)) && $this->message("�����ؼ��ʲ���Ϊ��!", 'BACK');
        $encodeword = urlencode($word);
        $navtitle = $word . '-��������';
        @$page = max(1, intval($this->get[4]));
        $pagesize = $this->setting['list_default'];
        //��ȡ��¼�����������
        $ask_area = intval($_POST['ask_area']);
        $startindex = ($page - 1) * $pagesize;
         $rownum = $_ENV['question']->search_title_num($word, $qstatus,$ask_area); //��ȡ�ܵļ�¼��
        $questionlist = $_ENV['question']->search_title($word, $qstatus, 0, $startindex, $pagesize,$ask_area); //�����б�����
         $departstr = page($rownum, $pagesize, $page, "question/search/$status/$word/$ask_area"); //�õ���ҳ�ַ���
        $wordslist = unserialize($this->setting['hot_words']);
        include template('search');
    }

    /* ����ǩ�������� */

    function ontag() {
        $tag = urldecode($this->get['2']);
        $encodeword = urlencode($tag);
        $navtitle = $tag . '-��ǩ����';
        $qstatus = $status = intval($this->get[3]);
        (!$status) && ($qstatus = "1,2,6");
        $startindex = ($page - 1) * $pagesize;
        $rownum = $this->db->fetch_total("question_tag", " tname='$tag' ");
        $pagesize = $this->setting['list_default'];
        $questionlist = $_ENV['question']->list_by_tag($tag, $qstatus, $startindex, $pagesize);
        $departstr = page($rownum, $pagesize, $page, "question/tag/$tag/$status");
        include template('search');
    }

    /* �����Զ������Ѿ���������� */

    function onajaxsearch() {
        $title = urldecode($this->get[2]);
        $questionlist = $_ENV['question']->search_title($title, 2, 1, 0, 5);
        include template('ajaxsearch');
    }

    /* ��ָ������ */

    function onajaxgood() {
        $qid = $this->get[2];
        $tgood = tcookie('good_' . $qid);
        !empty($tgood) && exit('-1');
        $_ENV['question']->update_goods($qid);
        tcookie('good_' . $qid, $qid);
        exit('1');
    }

    /* ��ѯͼƬ�Ƿ���Ҫ����Ŵ� */

    function onajaxchkimg() {
        list($width, $height, $type, $attr) = getimagesize($this->post['imgsrc']);
        ($width > 300) && exit('1');
        exit('-1');
    }

    function ondelete() {
        $_ENV['question']->remove(intval($this->get[2]));
        $this->message('����ɾ���ɹ���');
    }

    //�����Ƽ�
    function onrecommend() {
        $qid = intval($this->get[2]);
        $_ENV['question']->change_recommend($qid, 6, 2);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $this->message('�����Ƽ��ɹ�!', $viewurl);
    }

    //�༭����
    function onedit() {
        $navtitle = '�༭����';
        $qid = $this->get[2] ? $this->get[2] : $this->post['qid'];
        $question = $_ENV['question']->get($qid);
        if (!$question)
            $this->message("���ⲻ���ڻ��ѱ�ɾ��!", "STOP");
        $navlist = $_ENV['category']->get_navigation($question['cid'], true);
        if (isset($this->post['submit'])) {
            $viewurl = urlmap('question/view/' . $qid, 2);
            $title = trim($this->post['title']);
            (!trim($title)) && $this->message('������ⲻ��Ϊ��!', $viewurl);
            $_ENV['question']->update_content($qid, $title, $this->post['content']);
            $this->message('����༭�ɹ�!', $viewurl);
        }
        include template("editquestion");
    }

    //�༭��ǩ

    function onedittag() {
        $tag = trim($this->post['tag']);
        $qid = $this->post['qid'];
        $viewurl = urlmap("question/view/$qid", 2);
        $message = $tag ? "��ǩ�޸ĳɹ�!" : "��ǩ����Ϊ��!";
        $tag && $_ENV['tag']->multi_add(explode(" ", $tag), $qid);
        $this->message($message, $viewurl);
    }

    //�ƶ�����
    function onmovecategory() {
        if (intval($this->post['category'])) {
            $cid = intval($this->post['category']);
            $cid1 = 0;
            $cid2 = 0;
            $cid3 = 0;
            $qid = $this->post['qid'];
            $viewurl = urlmap('question/view/' . $qid, 2);
            $category = $this->cache->load('category');
            if ($category[$cid]['grade'] == 1) {
                $cid1 = $cid;
            } else if ($category[$cid]['grade'] == 2) {
                $cid2 = $cid;
                $cid1 = $category[$cid]['pid'];
            } else if ($category[$cid]['grade'] == 3) {
                $cid3 = $cid;
                $cid2 = $category[$cid]['pid'];
                $cid1 = $category[$cid2]['pid'];
            } else {
                $this->message('���಻���ڣ�����»���!', $viewurl);
            }
            $_ENV['question']->update_category($qid, $cid, $cid1, $cid2, $cid3);
            $this->message('��������޸ĳɹ�!', $viewurl);
        }
    }

    //��Ϊδ���
    function onnosolve() {
        $qid = intval($this->get[2]);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $_ENV['question']->change_to_nosolve($qid);
        $this->message('����״̬���óɹ�!', $viewurl);
    }

    function onaddfavorite() {
        $qid = intval($this->get[2]);
        $cid = intval($this->get[3]);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $message = "�������Ѿ��ղأ������ظ��ղأ�";
        $this->load("favorite");
        if (!$_ENV['favorite']->get($qid)) {
            $_ENV['favorite']->add($qid, $cid);
            $message = '�����ղسɹ�!';
        }
        $this->message($message, $viewurl);
    }

    //ǰ̨ɾ������ش�
    function ondeleteanswer() {
        $qid = intval($this->get[3]);
        $aid = intval($this->get[2]);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $_ENV['answer']->remove_by_qid($aid, $qid);
        $this->message("�ش�ɾ���ɹ�!", $viewurl);
    }

    //ǰ̨��˻ش�
    function onverifyanswer() {
        $qid = intval($this->get[3]);
        $aid = intval($this->get[2]);
        $viewurl = urlmap('question/view/' . $qid, 2);
        $_ENV['answer']->change_to_verify($aid);
        $this->message("�ش�������!", $viewurl);
    }

/**
 * �༭�������
 * @return [type] [description]
 */
    public function onedittitle(){
       $qid=intval($this->post['qid']);
       $title=addslashes($this->post['title']);
       $query=$_ENV['question']->db->query('update '.DB_TABLEPRE.'question Set title=\''.$title.'\' Where id='.$qid);
       $viewurl = urlmap('question/view/' . $qid, 2);
       if($query){
            $this->message('�ɹ��༭�������',$viewurl);
       }else{
            $this->message('�༭�������ʧ��',$viewurl);

       }
    }

    function onanswercomment() {
        if (isset($this->post['credit3'])) {
            $this->load("answer_comment");
            //����ֵ���
            (intval($this->user['credit3']) < $this->setting['allow_credit3']) && $this->message("�������̫�ͣ���ֹ�ش�������������ϵ����Ա!", 'BACK');
            if ($this->post['credit3'] && trim($this->post['content'])) {
                if ($_ENV['answer_comment']->get_by_uid($this->user['uid'], $this->post['aid'])) {
                    $this->message("���Ѿ����۹��ûش��ˣ������ظ����ۣ�", 'BACK');
                    exit;
                }
                $_ENV['answer_comment']->add($this->post['aid'], trim($this->post['content']), intval($this->post['credit3']));
                //�Ա������˽��� ����ֵ�Ĵ���
                $this->credit($this->post['touid'], 0, 0, intval($this->post['credit3']));
                $this->send($this->post['touid'], $this->post['qid'], 3, $this->post['aid']);
                $viewurl = urlmap('question/view/' . $this->post['qid'], 2);
                $this->message("���۸ûش�ɹ���", $viewurl);
            }
        }
    }

    function onajaxanswercomment() {
        $commentlist = $_ENV['answer']->get_comment_by_aid(intval($this->get[2]), 0, 100);
        if (!$commentlist)
            exit("��û�����ּ�¼");
        include template("answercommentlist");
    }

}

?>