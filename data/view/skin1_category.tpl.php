<? if(!defined('IN_TIPASK')) exit('Access Denied'); global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime['1'] + $mtime['0'] - $starttime,6); $setting=$this->setting;$user=$this->user;$headernavlist=$this->nav;$regular=$this->regular; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=TIPASK_CHARSET?>"/>
<title><?=$navtitle?>��ѯ|<?=$navtitle?>��������|<?=$navtitle?>ƫ��|<?=$navtitle?>��������|<?=$navtitle?>������ѯ <?=$setting['site_name']?> <?=$setting['seo_title']?></title>
<meta name="keywords" content="<?=$metakeywords?><?=$setting['seo_keywords']?>" />
<meta name="description" content="<?=$metadescription?> <?=$setting['site_name']?> <?=$setting['seo_description']?>" />
<link href="<?=SITE_URL?>skin/css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=SITE_URL?>skin/css/ask_base.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_URL?>skin/css/list.css" type="text/css" rel="stylesheet" />
<script src="<?=SITE_URL?>skin/js/ask_function.js" type="text/javascript"></script>
<script type="text/javascript">g_site_url='<?=SITE_URL?>';g_suffix='<?=$setting['seo_suffix']?>';</script>
</head>
<body>
<? include template('header'); ?>
<div class="wrap1">
  <div class="wrap1 ask-sub"> <span class="subleft margintop10 color06b">
  
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
 
  &gt;<a href="<?=SITE_URL?>c-<?=$nav['id']?>.html/all/2.html"> <?=$nav['name']?></a> 
  
<? } } ?>
 </span> <span class="subright margintop10 color666"> </span> </div>
  <div class="list-left">
    <div class="lefttop margintop10"> <span class="kebt">
      <h1><?=$category['name']?>������ѯ</h1>
      <span class="you"> <a href="" class="a1" target="_blank" title="��ѯר��">��ѯר��</a> <a href="" class="a2" target="_blank" title="����">������</a> </span> <span class="jiahao" onclick="openShutManager(this,'showulbox')" title="���չ��"></span> </span> <span class="showul" id="showulbox" style="display:block;">
      <ul class="color06b uls">
        
<? if(is_array($sublist)) { foreach($sublist as $index => $sub) { ?>
        <li> 
          <? if($sub['id']==$cid) { ?> 
          <font style="color: black; font-size: 14px;"><?=$sub['name']?></font> 
          <? } else { ?> 
        <a href="<?=SITE_URL?>c-<?=$sub['id']?>/all/<?=$ask_area?>.html"><? echo cutstr($sub['name'],10,''); ?></a>
          <? } ?> 
        </li>
        
<? } } ?>
      </ul>
      <span class="jianhao" onclick="openShutManager(this,'showulbox')" title="����ر�"></span> </span> </div>
    <!--������-->
    
    <div class="chongxin"> <span class="tw"><a href="/?question/add.html" title="�����������" target="_blank" ></a></span> <span class="bz color06b">���˽����ʲ��裿��鿴�� ��<a href="<?=SITE_URL?>?index/help.html#�������" target="_blank" title="����鿴���ʰ���">���ʰ���</a></span> </div>
    <div class="list"> <span class="limenu"> 
      <? if(all==$status) { ?><a class="now">ȫ������</a><? } else { ?><a href="<?=SITE_URL?>c-<?=$cid?>/all/1.html.html">ȫ������</a><? } ?>      </h3>
      <? if(4==$status) { ?><a class="now">��������</a><? } else { ?><a href="<?=SITE_URL?>c-<?=$cid?>/4/1.html.html">��������</a><? } ?> 
  <? if(6==$status) { ?><a class="now">�Ƽ�����</a><? } else { ?><a href="<?=SITE_URL?>c-<?=$cid?>/6/1.html.html">�Ƽ�����</a><? } ?> 
      <? if(1==$status) { ?><a class="now"><font color="#ff6600">��</font>�����</a><? } else { ?><a href="<?=SITE_URL?>c-<?=$cid?>/1/1.html.html"><font color="#ff6600">��</font>�����</a><? } ?> 
      <? if(2==$status) { ?><a class="now"><font color="#1bbf00">�� </font>�ѽ��</a><? } else { ?><a href="<?=SITE_URL?>c-<?=$cid?>/2/1.html.html"><font color="#1bbf00">�� </font>�ѽ��</a><? } ?> 
      </span> 
      <!--�������--> 
      
      <span class="lititle"><span>�ظ�/���</span><span>״̬</span><span>���ظ�</span></span>
      <ul class="color06b">
        
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
        <li class=" " onmouseover="this.className='bg9fc'" onmouseout="this.className=' '"> <span class="tit">        <? if($question['price'] > 0) { ?>      <img src="<?=SITE_URL?>css/default/TB2.gif" /><span class="qlscore"><?=$question['price']?></span>
      <? } ?><a class="areatop" href="<?=$question['url']?>" class="bt" title="<?=$question['title']?>" target="_blank"><?=$question['title']?></a> [<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html/all/1.html" target="_blank" class="ks"><?=$question['category_name']?></a>] </span> <span class="huifu"><?=$question['answers']?>/6</span> <span class="zhuan"><img src="<?=SITE_URL?>css/common/icn_<?=$question['status']?>.gif" /></span> <span class="zuiho"><?=$question['format_time']?></span> </li>
        
<? } } ?>
      </ul>
      <span class="pages"> <span class="pgleft"><?=$departstr?></span> <span class="pgright"> </span> </span> </div>
    <div class="lisearch margintop10">    <form name="searchform"  action="<?=SITE_URL?>?question/search/3.html" method="post">
      <input id="kw" type="text" class="inputtext"  value="���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����" onfocus="if (this.value=='���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����'){this.value='';}; this.style.color='#333';" onblur="if (this.value==''){this.value='���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����';this.style.color='#bbb';}" style="color:#bbb;" name="word" />
      <input type="button" class="inputbut inputbut1" onmouseover="this.className='inputbut inputbut2'" onmouseout="this.className='inputbut inputbut1'" value="�� ��" onclick="ask_submit();" />
            <input type="submit" class="inputbut inputbut1" onmouseover="this.className='inputbut inputbut2'" onmouseout="this.className='inputbut inputbut1'" value="�� ��"  >
    </form>
      <span class="leftbg"></span> <span class="rightbg"></span> </div>
  </div>
  <div class="list-right"> <span id="minyi"> </span><span class="liboxs color06b"> <strong>�Ƽ�ҽ��</strong> <span class="cons"> 
    <? $famouslist=$this->fromcache('famouslist'); ?> 
    
<? if(is_array($famouslist)) { foreach($famouslist as $famous) { ?>
 
    <span class="banzhu banzhu2">
    <p class="p1"> <span class="imgbox"><a href="<?=SITE_URL?>u-<?=$famous['uid']?>.html" target="_blank"><img src="<?=$famous['avatar']?>" /></a></span> <span class="name"><a href="<?=SITE_URL?>u-<?=$famous['uid']?>.html" title="<?=$famous['username']?>" target="_blank"><?=$famous['username']?></a></span> <span class="jj"><?=$expert['categoryname']?></span> <span class="tiwen"><a href="#" title="���ҽ������" target="_blank"></a></span> <span class="clearer"></span> </p>
    <p class="p2">�ѻش���������<b><a href="<?=SITE_URL?>u-<?=$famous['uid']?>.html" target="_blank"><?=$questiontotal?></a></b> ��</p>
    </span> 
    
<? } } ?>
 
    </span> </span> <span class="liboxs color06b"> <strong>��Լר��</strong> <span class="cons"> 
    <? $expertlist=$this->fromcache('expertlist'); ?> 
    
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
 
    <span class="banzhu">
    <p class="p1"> <span class="imgbox"><a href="<?=SITE_URL?>u-<?=$expert['uid']?>.html" target="_blank"><img src="<?=$expert['avatar']?>" /></a></span> <span class="name"><a href="<?=SITE_URL?>u-<?=$expert['uid']?>.html" target="_blank"><?=$expert['username']?></a></span> <span class="jj">�ó���<?=$expert['categoryname']?></span> <span class="zixun"><a href="#" title="������ѯ" target="_blank"></a></span> <span class="clearer"></span> </p>
    <p class="p2 p3">�ѻ�û��֣�<b><a href="#"><?=$expert['credit1']?></a></b>��</p>
    </span> 
    
<? } } ?>
 
    </span> </span> <span class="liboxs"> <strong>������������������</strong> <span class="cons">
    <ul class="uls">
      <? $recommendlist=$this->fromcache('recommendlist'); ?> 
      
<? if(is_array($recommendlist)) { foreach($recommendlist as $index => $recommend) { ?>
      <li><a href="<?=SITE_URL?>q-<?=$recommend['qid']?>.html"  title="<?=$recommend['title']?>" target="_blank"><? echo cutstr($recommend['title'],30); ?></a></li>
      
<? } } ?>
    </ul>
    </span> </span> <span class="liboxs"> <strong>������ȫ</strong> <span class="cons cons1"> <span class="abox"> 
<? if(is_array($wordslist)) { foreach($wordslist as $hotword) { ?>
           <a <? if($hotword['qid']) { ?>href="<?=SITE_URL?>q-<?=$hotword['qid']?>.html" <? } else { ?>href="<?=SITE_URL?>?question/search/3/<?=$hotword['w']?>.html"<? } ?>><?=$hotword['w']?></a>
          
<? } } ?>
 </span> <span class="noline"></span> </span> </span> </div>
</div>
<? include template('footers'); ?>
</body>
</html>
