<? if(!defined('IN_TIPASK')) exit('Access Denied'); global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime['1'] + $mtime['0'] - $starttime,6); $setting=$this->setting;$user=$this->user;$headernavlist=$this->nav;$regular=$this->regular; $this->load('recommend'); $this->load('answer'); $this->load('question'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=TIPASK_CHARSET?>"/>
<title>�Լ���,���Ƽ���,���Լ���,��������Ϊһ��Ľ�����վ-58�ٿ��ʴ�</title>
<meta name="keywords" content="<?=$metakeywords?><?=$setting['seo_keywords']?>" />
<meta name="description" content="<?=$metadescription?> <?=$setting['site_name']?> <?=$setting['seo_description']?>" />
<link href="<?=SITE_URL?>skin/css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=SITE_URL?>skin/css/ask_base.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_URL?>skin/css/index.css" type="text/css" rel="stylesheet" />
<script src="<?=SITE_URL?>skin/js/some.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>skin/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>skin/js/ask_function.js" type="text/javascript"></script>
<script type="text/javascript">g_site_url='<?=SITE_URL?>';g_suffix='<?=$setting['seo_suffix']?>';</script>
<link href="<?=SITE_URL?>skin/css/tc.css" type="text/css" rel="stylesheet" />
<script language="javascript">
$(function() {
var scrtime;
$("#NewAnswer").hover(function() {
clearInterval(scrtime);
}, function() {
scrtime = setInterval(function() {
var ul = $("#NewAnswer ul");
var liHeight = ul.find("li:last").height();
ul.animate({ marginTop: liHeight + 0 + "px" }, 1000, function() {
ul.find("li:last").prependTo(ul)
ul.find("li:first").hide();
ul.css({ marginTop: 0 });
ul.find("li:first").fadeIn(1000);
});
}, 5000);
}).trigger("mouseleave");
}); 
</script>
</head>
<body>
<? include template('header'); ?>
<div class="wrap1 ask-mid">
  <div class="margintop10 mid-left"> 
    <!--���������--> 
    <span class="fenlei"><em>�������</em></span>
    <div class="cons"> 
      <? $statistics=$this->fromcache('statistics'); ?>      <ul class="ul1">
        <li>�ѽ����������<b id="TopicCount"><?=$statistics['solves']?></b></li>
        <li>�������������<b id="AnswerCount"><?=$statistics['nosolves']?></b></li>
      </ul>
        <span class="jibin"><em>58�԰�����</em><span class="spline2"></span></span>
      <ul class="ul2 color666">
       
200*200���λ
      </ul>
     
      <span class="jibin"><em>58�԰�����</em><span class="spline2"></span></span>
      <div class="menus color666"> <span class="spline"></span>
 <? $categorylist=$this->fromcache('categorylist'); if(is_array($categorylist)) { foreach($categorylist as $category1) { ?>
            
<span class="spline"></span>
 	<dl class="nomore" onmouseover="this.className='showmore'" onmouseout="this.className='nomore'">
          <dt><strong><?=$category1['name']?></strong><span class="tips">   (<?=$category1['questions']?>)    </span></dt>
          <dd>
            <h2><a href="<?=SITE_URL?>c-<?=$category1['id']?>.html"><?=$category1['name']?></a> (<?=$category1['questions']?>)</h2> 
<? if(is_array($category1['sublist'])) { foreach($category1['sublist'] as $index => $category2) { ?>
         <ul>              
  <li><a href="<?=SITE_URL?>c-<?=$category2['id']?>.html"><?=$category2['name']?></a></li> </ul>           
            
<? } } ?>
            <span class="no-ulborder"></span> <span class="close"><a href="javascript:vold(0);" title="�ر�"></a></span> </dd>
        </dl>		
 
<? } } ?>
        <span class="spline"></span> </div>
      <span class="zhuanjia">������ѯ</span> <span class="spline"></span>
      <ul class="ul44 color666">
        <li></li>
      </ul>
      <!--���������end--> 
    </div>
    <!--��վ����--> 
    <span class="help margintop10"> <span class="biaoti"><a href="<?=SITE_URL?>index/help.html#" target="_blank">��վ����</a></span>
    <ul class="ul6 uls">
      <li><a href="<?=SITE_URL?>index/help.html#�������"  target="_blank">�������</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#��λش�" target="_blank">��λش�</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#��δ�������" target="_blank">��δ�������</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#��δ����������" target="_blank">��δ����������</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#����Ϊ�α��ر�" target="_blank">����Ϊ�α��ر�</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#��α����ʴ�ɾ" target="_blank">��α����ʴ�ɾ</a></li>
      <li><a href="<?=SITE_URL?>index/help.html#<?=$setting['site_name']?>Э��" target="_blank"><?=$setting['site_name']?>Э��</a></li>
    </ul>
    <p>��������Ϣ���޷������������,����ϵ����:</p>
    <span class="lx lx1">QQ:79682153</span> <span class="lx lx2">����:admin@aixue.cc</span> <span class="lx lx3">(���#�ĳ�@)</span> </span> 
    <!--��վ����end--> 
  </div>
  <div class="margintop10 mid-right">
    <div class="right-top">
      <div class="topleft"> 
       <!--�н���ͼ-->
        <div id="focus">
          <div id="hotpic">
            <div style="display:block"><span><a href="#" target="_blank">������������⣿</a></span><a href="" target="_blank"><img src="<?=SITE_URL?>skin/im/206632.jpg" alt="" /></a></div>
            <div ><span><a href="#" target="_blank">��������������ô�죿</a></span><a href="" target="_blank"><img src="<?=SITE_URL?>skin/im/206630.jpg" alt="" /></a></div>
            <div ><span><a href="#" target="_blank">�����겻����</a></span><a href="" target="_blank"><img src="<?=SITE_URL?>skin/im/206631.jpg" alt="" id="adpic"/></a></div>
            <div ><span><a href="#" target="_blank">"�鷿С��ô�찡��</a></span><a href="" target="_blank"><img src="<?=SITE_URL?>skin/im/206629.jpg" alt="" /></a></div>
            <div ><span><a href="#" target="_blank">JJС��ô�죿</a></span><a href="/" target="_blank"><img src="<?=SITE_URL?>skin/im/206636.jpg" alt="" /></a></div>
          </div>
          <script src="<?=SITE_URL?>skin/js/ask_jiaodian.js" type="text/javascript"></script> 
        </div>
        <!--�н���ͼend--> 
        <!--����ͼ���ȵ�--> 
        <span class="redian"> <span>�ȵ�</span>
        <ul class="uls color06b">
          <? $recommendlist=$this->fromcache('recommendlist'); ?> 
          
<? if(is_array($recommendlist)) { foreach($recommendlist as $index => $recommend) { ?>
          <li><a href="<?=$recommend['url']?>" title="<?=$recommend['title']?>"><? echo cutstr($recommend['title'],22); ?></a></li>
          
<? } } ?>
        </ul>
        </span> 
        <!--����ͼ���ȵ�end--> 
        <span class="guanzhu margintop10">
        <div class="guanzhu"> <span>��ע</span>
          <ul>
            <li><a href="">����:������ά��</a></li>
            <li><a href="" title="�˹����ж���Ǯ��">�˹����ж���Ǯ��</a></li>
            <li><a href="" title="���ٰ�ȫ������">���ٰ�ȫ������</a></li>
          </ul>
        </div>
        <li><a href="">���в����ɸ߷���</a></li>
        </span> <span class="news margintop10"> 
        <!--ҽ�����½��--> 
        <strong>ҽ�����½��</strong> <span class="cons"> <span class="newanswer" id="NewAnswer"> 
        <? $famouslist=$this->fromcache('famouslist'); ?>        <ul class="color06b">
          
<? if(is_array($famouslist)) { foreach($famouslist as $famous) { ?>
          <li><span class="newqs">ҽ��<a target="_blank" href="<?=SITE_URL?>u-<?=$famous['uid']?>.html"><?=$famous['truename']?></a>�����⣢<a target="_blank" href="<?=SITE_URL?>q-<?=$famous['qid']?>.html"><? echo cutstr($famous['title'],20); ?></a>�����лظ�</span><b><?=$famous['time']?></b></li>
          
<? } } ?>
        </ul>
        </span> <span class="as"> <a href="/?question/add.html" class="a1" title="��������"><em>��������</em><br />
        10������ҽ�����</a> <a href="/?question/add.html" class="a2" title="ҽ������"><em>ҽ������</em><br />
        ��Ϊ��������ҽ��</a> <a href="#" class="a3"><em>ֱ����ѯ</em><br />
        ��ʱ�����ҽ��</a> </span> </span> 
        <!--ҽ�����½��end--> 
        </span>
        <div id="tab1" class="color06b margintop10"> 
          <!--��ҽ�����ʴ�--> 
          <span class="tabtop"> <strong><a href="#" title="��ҽ�����ʴ�">��ҽ�����ʴ�</a></strong> <em class="up" onMouseOver="showTab(1,1);">��ͨ��ѯ</em> <em onMouseOver="showTab(1,2);">������ѯ</em> <em onMouseOver="showTab(1,3);">��������</em>  <em onMouseOver="showTab(1,4);">��������</em> <span class="dingzhi"><span>վ����79682153</span></span> </span>
       <div class="block"> 
       <? $questionlist=$_ENV['question']->list_by_condition('ask_area=1',0,3); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
       <span class="qiuzhen" onmouseover="this.className='qiuzhen qiuzhenbg'" onmouseout="this.className='qiuzhen'"> <span class="qztop"> <a href="<?=SITE_URL?>q-<?=$question['id']?>.html" title="<?=$question['title']?>" target="_blank"><?=$question['title']?></a> <b></b> </span> <span class="qzdown">
            <p><span>���ԣ�</span>58�ٿ��ʴ� <a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" target="_blank"><?=$question['author']?></a>ר��</p>
            <a href="#" class="wo" title="�����ش�"></a> </span> </span>
            
<? } } ?>
         </div>
          <span class="clearer"></span>
          <div> <span class="wangqi"> <span class="wqbox "> <a href="#" target="_blank"><img src="<?=SITE_URL?>skin/im/221727.jpg"/></a> <strong class="andthen"><a href="#" target="_blank" >��֢�����������׺��Ե����⣿</a></strong> <span class="wqyy andthen">58�ٿ��ʴ�</span>
            <p><span class="wqname andthen">�Ż���</span><a href="#" title="���ʽ��"></a></p>
            </span><span class="wqbox wqbox2"> <a href="#" ><img src="<?=SITE_URL?>skin/im/221717.jpg" /></a> <strong class="andthen"><a href="#" target="_blank" >��֢���Ƶ����������˽���</a></strong> <span class="wqyy andthen">58�ٿ��ʴ�</span>
            <p><span class="wqname andthen">����ǿ</span><a href="#" title="���ʽ��"></a></p>
            </span><span class="wqbox wqbox2"> <a href="#" ><img src="<?=SITE_URL?>skin/im/221138.jpg"  /></a> <strong class="andthen"><a href="#" target="_blank">"���л���"�ı��˱�����ܵļ������ʣ�</a></strong> <span class="wqyy andthen">58�ٿ��ʴ�</span>
            <p><span class="wqname andthen">�ν���</span><a href="#" title="���ʽ��"></a></p>
            </span> </span> <span class="suoyou"><a href="#" >����ҽ�����ʴ����л�ع�</a></span> </div>
          <span class="clearer"></span>
          <div> <span class="huodong1"><a href="#"  target="_blank"><img src="<?=SITE_URL?>skin/im/203048.jpg" alt=""  /></a></span> <span class="huodong2"><a href="#"  target="_blank"><img src="<?=SITE_URL?>skin/im/203039.jpg" alt="" /></a></span> <span class="huodong2 huodong3"><a href="#"  target="_blank"><img src="<?=SITE_URL?>skin/im/203044.jpg" alt="" /></a></span> <span class="huodong2 huodong3"><a href="#"  target="_blank"><img src="<?=SITE_URL?>skin/im/203045.jpg" alt="" /></a></span> </div>
          <!--��ҽ�����ʴ�end--> 
          <span class="clearer"></span> </div>
      </div>
      <div class="topright color666"> 
        <!--��Ա--> 
        <? if(0!=$user['uid']) { ?>        <UL class=color06b>
          <LI>��ӭ�� <a href="<?=SITE_URL?>user/default.html"class=cs target=_blank ><?=$user['username']?></A><a href="<?=SITE_URL?>user/logout.html" target=_self> [�˳�]</A><a href="<?=SITE_URL?>gift.html" style="color:#F00; float:right">����ԤԼ��</A></LI>
          <LI>��<a href="<?=SITE_URL?>user/default.html" ><?=$user['newmsg']?></A>���¶���Ϣ������<a href="<?=SITE_URL?>user/default.html" target=_blank>���˹���</A></LI>
        </UL>
        <? } else { ?> 
        <span id="loginState"> <span class="login"> <a  target="_self" href="<?=SITE_URL?>user/login.html" class="a1" title="��¼"></a> <a href="<?=SITE_URL?>user/register.html" class="a2" title="ע��"></a> </span> </span> 
        <? } ?> 
        <!--��Ա--end>
        <!--ר������--> 
        <span class="boxs margintop10"> 
        <!--��վ����--> 
        <strong>��վ����</strong> <span class="cons"> <span class="imgbox"> <a href="/"><img src="<?=SITE_URL?>skin/im/220259.jpg" alt="" /></a><span> <a href="/">�ؽ�ʹ���������ô��</a> </span> </span> 
        <? $notelist=$this->fromcache('notelist'); ?>        <ul class="ul9 uls">
          
<? if(is_array($notelist)) { foreach($notelist as $note) { ?>
          <li><a <? if($note['url']) { ?>href="<?=$note['url']?>" target="_blank" <? } else { ?> href="<?=SITE_URL?>note/view/<?=$note['id']?>.html" <? } ?> ><?=$note['title']?></a></li>
          
<? } } ?>
        </ul>
        </span> </span> 
        <!--��վ����end--> 
        <span class="boxs boxsa"> <strong>�ȵ�ؼ���</strong> <span class="cons">
        <ul class="ul3 color0C6">
          
<? if(is_array($wordslist)) { foreach($wordslist as $hotword) { ?>
          <li> <a <? if($hotword['qid']) { ?>href="<?=SITE_URL?>q-<?=$hotword['qid']?>.html" <? } else { ?>href="<?=SITE_URL?>question/search/3/<?=$hotword['w']?>.html"<? } ?>><?=$hotword['w']?></a></li>
          
<? } } ?>
        </ul>
        </span> </span> </div>
    </div>
    <div class="right-bottom">
      <div id="tab2" class="color06b margintop10"> 
        <!--��������title--> 
        <span class="tabtop"> <strong><a href="#" title="��������">��������</a></strong> <em class="up" onMouseOver="showTab(2,1);">�п�</em> <em onMouseOver="showTab(2,2);">���Խ���</em> <em onMouseOver="showTab(2,3);">��������</em> <em onMouseOver="showTab(2,4);">IT����</em> <em onMouseOver="showTab(2,5);">��Ƥ����</em> <em onMouseOver="showTab(2,6);">������й</em> <em onMouseOver="showTab(2,7);">��Ϸ֪ʶ</em></span>
        <div class="block"> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=1',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--���ȿ�������titleEND--> 
          <!--���������Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">������</a></span> <span class="jj">������</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html"><?=$questiontotal?></a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">������</a></span> <span class="jj">�п�</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html"><?=$questiontotal?></a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=2',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--���Ƽ�ר��end--> 
          <!--����Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">������</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html"><?=$questiontotal?></a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">����ǿ</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html"><?=$questiontotal?></a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=3',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html"><?=$questiontotal?></a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">��ҽ��</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html"><?=$questiontotal?></a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=4',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--����Ƽ�ר��end--> 
          <!--�����Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html">54716</a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">����ǿ</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html">61056</a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=5',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--�����Ƽ�ר��end--> 
          <!--�п��Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html">54716</a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">����ǿ</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html">61056</a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=6',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--�п��Ƽ�ר��end--> 
          <!--��Ⱦ�����Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">��й</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html">54716</a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">����ǿ</a></span> <span class="jj">����</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html">61056</a></b> ��</p>
          </span></span> </div>
        <span class="clearer"></span>
        <div> <span class="divleft">
          <ul>
            <? $questionlist=$_ENV['question']->list_by_condition('cid1=7',0,8); ?> 
            
<? if(is_array($questionlist)) { foreach($questionlist as $index => $question) { ?>
            <li><span class="bt">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"  class="color333" title="<?=$question['category_name']?>"><?=$question['category_name']?></a>] <a href="<?=$question['url']?>" title="<?=$question['title']?>"><?=$question['title']?></a></span><span class="doctor"><a href="<?=SITE_URL?>u-<?=$question['authorid']?>.html" ><?=$question['author']?></a></span><span class="when"><?=$question['category_name']?></span></li>
            
<? } } ?>
          </ul>
          </span> 
          <!--֢״���Ƽ�ר��end--> 
          <!--�������Ƽ�ר��--> 
          <span class="divright"> <span class="rigtop">�Ƽ�ר��</span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-2.html"><img src="<?=SITE_URL?>skin/im/201106211903391798.jpg" alt="" /></a></span> <span class="name"><a href="/?u-2.html" title="">�Ż���</a></span> <span class="jj">�Թ���</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-2.html">54716</a></b> ��</p>
          </span> <span class="tuijian">
          <p class="p1"> <span class="imgbox"><a href="/?u-3.html"><img src="<?=SITE_URL?>skin/im/204306.jpg" alt="" /></a></span> <span class="name"><a href="/?u-3.html" title="">����ǿ</a></span> <span class="jj">�Թ���</span> <span class="tiwen"><a href="#" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
          <p class="p2">�ѻش���������<b><a href="/?u-3.html">61056</a></b> ��</p>
          </span></span> 
          <!--�������Ƽ�ר��end--> 
        </div>
        <span class="clearer"></span> </div>
    </div>
  </div>
</div>
<!--Ϊʲôѡ��39�����ʴ�--><a style="DISPLAY: none" herf="http://wwww.skin">58�ٿ��ʴ�</a>
<div class="wrap1 ask-tips">
  <dl>
    <dt>58�ٿ��ʴ���� </dt>
    <dd class="dd1"><span>ְҵ����</span>58�ٿ��ʴ�ÿһλҽ�����������ϸ���ʸ��֤��ȷ����������ҽִҵ�ʸ�</dd>
    <dd class="ddline"></dd>
    <dd class="dd2"><span>�ش����</span>����ȫ����ҽԺ������ҽ�������ݷḻ���ٴ�������רҵ֪ʶ���߷����ߡ�</dd>
    <dd class="ddline"></dd>
    <dd class="dd3"><span>��x24Сʱ����</span>���л��ߵ���ϸ��������������֪ʶ����24Сʱ�ڱ�֤100%�õ�ҽ��רҵ�ظ���</dd>
    <dd class="ddline"></dd>
    <dd class="dd4"><span>ר�������ʴ�</span>ÿ������ȫ�������������ҽԺ����Ժ��ר�ҽ������Ϲ����ʴ���</dd>
    <dd class="ddline"></dd>
    <dd class="dd5"><span>��ѽ��</span>58�ٿ��ʴ��ϵ��������ʣ�����ҽ���ʴ��Ϊ��ѣ����������м���������ҽ��</dd>
  </dl>
</div>
<!--Ϊʲôѡ��39�����ʴ�end-->
<div class="wrap1 ask-bot">
  <div id="tab4" class="color666 margintop10"> <span class="tabtop"> <em onMouseOver="showTab(4,1);" id="em1">��������</em> <em class="up" onMouseOver="showTab(4,2);" id="em2">�����ʴ����</em> </span> 
    <!--��������--> 
    <? if('index/default'==$regular) { ?>    <div>
      <ul class="uls">
        
<? if(is_array($linklist)) { foreach($linklist as $link) { ?>
        <li><a target="_blank" href="<?=$link['url']?>" title="<?=$link['description']?>"><?=$link['name']?></a> <? } ?></li>
        
<? } } ?>
      </ul>
    </div>
    <!--��������end--> 
    <span class="clearer"></span> 
    <!--�����ʴ����-->
    <div class="block">
      <ul class="uls">
        <li><a href="http://skin" title="58�����ʴ�">58�����ʴ�</a></li>
      </ul>
    </div>
    <!--�����ʴ����end--> 
    <span class="clearer"></span> </div>

</div>
<!--�Ų�-->
<div class="bottominfo" id="bottominfo" style="padding-top:10px;"> <a href="">��վ���</a> | <a href="">��վ��ͼ</a> | <a href="/">��������</a> | <a href="">ý�屨��</a> | <a href="">�������</a> | <a href="">������Դ</a> | <script src="http://s23.cnzz.com/stat.php?id=3435241&web_id=3435241" type="text/javascript"></script>| <a href="">��ϵ��ʽ</a> | <a href="javascript:myhomepage()" name="homepage" target="_self">��Ϊ��ҳ</a> | <a href="javascript:addfavorite()" target="_self">�����ղ�</a><br />
  Copyright &copy; 2000-2011  All Rights Reserved. 58�ٿ��ʴ� <a href="">��Ȩ����</a> <font color="#ffffff">1653.6848ms</font> </div>
<!--�Ų�end-->

</body>
</html>