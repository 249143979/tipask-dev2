<? if(!defined('IN_TIPASK')) exit('Access Denied'); global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime['1'] + $mtime['0'] - $starttime,6); $setting=$this->setting;$user=$this->user;$headernavlist=$this->nav;$regular=$this->regular; ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=TIPASK_CHARSET?>"/>
<title><?=$navtitle?> <?=$setting['site_name']?> <?=$setting['seo_title']?></title>
<meta name="keywords" content="<?=$metakeywords?><?=$setting['seo_keywords']?>" />
<meta name="description" content="<?=$metadescription?> <?=$setting['site_name']?> <?=$setting['seo_description']?>" />
<script type="text/javascript">
g_site_url='<?=SITE_URL?>';g_prefix='<?=$setting['seo_prefix']?>';g_suffix='<?=$setting['seo_suffix']?>';editor_items='<?=$setting['editor_items']?>';
</script> 
<script src="<?=SITE_URL?>js/jquery.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/dialog.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/common.js" type="text/javascript"></script><? $toolbars="'".str_replace(",", "','", $setting['editor_toolbars'])."'"; if(strpos($this->regular,"add")==false) $toolbars=str_replace("'insertbuy','insertreply',",'',$toolbars); ?><script type="text/javascript">
      g_site_url='<?=SITE_URL?>';g_prefix='<?=$setting['seo_prefix']?>';g_suffix='<?=$setting['seo_suffix']?>';editor_options={toolbars:[[<?=$toolbars?>]],wordCount:<?=$setting['editor_wordcount']?>,elementPathEnabled:<?=$setting['editor_elementpath']?>};messcode='<?=$setting['code_message']?>';</script>
<link href="<?=SITE_URL?>css/default/ask2.css" rel="stylesheet" type="text/css">
<link href="<?=SITE_URL?>skin/css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=SITE_URL?>skin/css/ask_base.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_URL?>skin/css/tiezi.css" type="text/css" rel="stylesheet" />
<?=$setting['seo_headers']?>
</head>
<script type="text/javascript">
function setSearcharea(obj) {
  $('#searchipt').val($(obj).text());
    switch($(obj).text()){
        case "ȫ������":
        $(':input[name="ask_area"]').val('');
        break;
        case "��ͨ��ѯ":
        $(':input[name="ask_area"]').val('1');
        break;
        case "������ѯ":
        $(':input[name="ask_area"]').val('2');
        break;
        case "��������":
        $(':input[name="ask_area"]').val('3');
        break;
        case "��������":
        $(':input[name="ask_area"]').val('4');
        break;  
    }
    $('#searchType').fadeOut('fast');
}

function showAreaSelect(obj){
  var top=$(obj).offset().top+$(this).height();
  var left=$(obj).offset().left;
  top=5;left=154;
  $('#searchType').css({'left':left+'px','top':top+'px'});
  $('#searchType').fadeIn('fast');
}
</script>
<body>
<div class="wrap">
  <DIV id=userbar class=new_nav>
    <DIV class=new_nav>
      <DIV class=new_navtext><SPAN><A href="/">��ҳ</A><a href="<?=SITE_URL?>c-all/all/1.html" >��ͨ��ѯ</a><a href="<?=SITE_URL?>c-all/all/2.html" >������ѯ</a><a href="<?=SITE_URL?>c-all/all/3.html" >��������</a><a href="<?=SITE_URL?>c-all/all/4.html" >��������</a></SPAN></DIV>
      <DIV class=new_navlogin>
        <DIV><? if(0!=$user['uid']) { ?>����,<a href="<?=SITE_URL?>user/default.html" target=_blank><?=$user['username']?></A><SPAN>|</SPAN><a href="<?=SITE_URL?>user/ask.html.html">�ҵ�����</A><SPAN>|</SPAN><a href="<?=SITE_URL?>user/default.html" target=_blank>���˹���</A><SPAN>|<? if($user['groupid']<=3) { ?></SPAN><a href="<?=SITE_URL?>index.php?admin_main">ϵͳ����</a><SPAN>|<? } ?></SPAN><a href="<?=SITE_URL?>message/new.html">����Ϣ(<B class=orange><?=$user['newmsg']?></B>/<B>1</B>)</A><IMG alt=���ɴ� src="<?=SITE_URL?>skin/images/icon_zhang1.gif"><?=$user['credit1']?><IMG alt=���� src="<?=SITE_URL?>skin/images/icon_bi.gif"><a href="<?=SITE_URL?>user/default.html" target=_blank><?=$user['credit2']?></A><IMG alt=������ src="<?=SITE_URL?>skin/images/icon_q.gif"><?=$user['questions']?><IMG alt=�ش��� src="<?=SITE_URL?>skin/images/icon_a.gif"><?=$user['answers']?><SPAN>|</SPAN><a href="<?=SITE_URL?>user/logout.html" target=_self>�˳�</A><SPAN>|</SPAN><a href="<?=SITE_URL?>gift.html" style="color:#F00">ԤԼ�Ŷһ�</A><? } else { ?> 
          ���ã���ӭ��<?=$setting['site_name']?>��[<a  href="<?=SITE_URL?>user/login.html">���¼</a>] [<a  href="<?=SITE_URL?>user/register.html">���ע��</a>]<? } ?></DIV>
      </DIV>
    </DIV>
  </DIV>
</div>
<div class="wrap1">
  <div class="ask-top"> <span class="bgleft"> <span class="bgright"> <span class="topcon"> <span class="conup"> <span class="asklogo"><a href="/" title="�����ʴ�">�����ʴ�</a></span>
    <form name="searchform"  action="<?=SITE_URL?>question/search/3.html" method="post">
      <input id="kw" type="text" class="inputtext"  value="���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����" onfocus="if (this.value=='���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����'){this.value='';}; this.style.color='#333';" onblur="if (this.value==''){this.value='���ڴ��ύ�������⣬��������ҽ��10������Ϊ�����';this.style.color='#bbb';}" style="color:#bbb;width:360px;" name="word"/>
    <div id="searchType" style="display:none">
      <a href="javascript:void(0)" onclick="setSearcharea(this)">ȫ������</a>
      <a href="javascript:void(0)" onclick="setSearcharea(this)">��ͨ��ѯ</a>
      <a href="javascript:void(0)" onclick="setSearcharea(this)">������ѯ</a>
      <a href="javascript:void(0)" onclick="setSearcharea(this)">��������</a>
      <a href="javascript:void(0)" onclick="setSearcharea(this)">��������</a>
    </div>
      <input type="hidden" name="ask_area" value=""/>
      <input id="searchipt" type="text" class="inputtext" value="ȫ������" style="left:-50px;width:65px; background:url('<?=SITE_URL?>images/select_down.png') no-repeat right transparent;cursor:pointer" onclick="showAreaSelect(this)" readonly="true"/>
      <input type="submit" class="inputbut inputbut1" onmouseover="this.className='inputbut inputbut2'" onmouseout="this.className='inputbut inputbut1'" value="�� ��"  >
      <input type="button" class="inputbut inputbut1" onmouseover="this.className='inputbut inputbut2'" onmouseout="this.className='inputbut inputbut1'" value="�� ��" onclick="ask_submit();" />
      <input type="button" name="" value="������ҩ" class="inputbut inputbut3" onmouseover="this.className='inputbut inputbut4'" onmouseout="this.className='inputbut inputbut3'" onclick=""  />
    </form>
    </span> <span class="condown">
    <ul class="ul1 color666">
      <li><a href="/?c-2.html" title="���»ش�">���»ش�</a></li>
      <li><a href="/?c-2.html" title="ר��">ר��</a></li>
    </ul>
    <ul class="ul2 color666">
    <li><a href="index.php?c-all/all/1/.html" >��ͨ��ѯ</a></li>
    </ul>
    </span> </span> </span> </span> </div>
</div>
<!--����&Ƶ�����end--> 
<!---ͨ��1-->
<div class="wrap1"> 960*90���λ </div>
<!---ͨ��1end-->