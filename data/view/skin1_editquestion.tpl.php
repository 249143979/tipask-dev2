<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<!--head����-->
<script src="<?=SITE_URL?>js/ueditor/editor_config.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/ueditor/editor_all.js" type="text/javascript"></script>
<script src="<?=SITE_URL?>js/ueditor/third-party/SyntaxHighlighter/shCore.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=SITE_URL?>js/ueditor/themes/default/ueditor.css"/>
<link rel="stylesheet" href="<?=SITE_URL?>js/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css"/>
<div class="wrap1 ask-tie">
<div class="wrap1 ask-sub">
    <span class="subleft margintop10 color06b">
        <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
        
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
        &gt; <a href="<?=SITE_URL?>c-<?=$nav['id']?>.html"><?=$nav['name']?></a>
        
<? } } ?>
 &gt; 
        <a href="<?=SITE_URL?>q-<?=$qid?>.html"><?=$question['title']?></a>&gt; �༭����
    </span></div>
    <div class="tie-left">

        <div class="clr"></div>
        <div class="leftc">
            <form name="questionform" onsubmit="return check_form();" action="<?=SITE_URL?>?question/edit.html" method="post" >
                <input type="hidden" value="<?=$qid?>" name="qid" />
                <div class="tiwen">
                    <div style="padding-left:10px;margin-bottom: 10px;"><input type="text"  maxlength="100" size="65" name="title" value="<?=$question['title']?>" id="mytitle"  class="input1"  /></div>
                    <script type="text/plain" id="mycontent" name="content" style="width:720px;padding-left:10px;"><?=$question['description']?></script>
                    <div style="float:right;margin-right:12px;padding-top: 10px;padding-bottom: 20px;"><input name="submit" type="submit" class="button4" value="��&nbsp��"/><?=$question['content']?></div>
                    <div class="clr"></div>
                </div>
            </form>
        </div>
        <div class="clr"></div>
 
    </div>
   <div class="tie-right">
        <div class="gg">
            <div class="ggtitle">
                <ul>
                    <li class="gga11"></li>
                    <li class="gga21">
                        <div class="juzhong">&nbsp;֪��С��ʿ</div>
                    </li>
                    <li class="gga31"></li>
                </ul>
            </div>
            <div class="clr"></div>
            <div class="ggcon">
                <ul>
                    <li><a target="_blank" title="�������" href="<?=SITE_URL?>?index/help.html#�������">�������</a></li>
                    <li><a target="_blank" title="��λش�" href="<?=SITE_URL?>?index/help.html#��λش�">��λش�</a></li>
                    <li><a target="_blank" title="��λ�û���" href="<?=SITE_URL?>?index/help.html#��λ�û���">��λ�û���</a></li>
                    <li><a target="_blank" title="��δ�������" href="<?=SITE_URL?>?index/help.html#��δ�������">��δ�������</a></li>
                </ul>
            </div>
            <div class="ggbuttom">
                <ul>
                    <li class="ggba1"></li>
                    <li class="ggba2"></li>
                    <li class="ggba3"></li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
    </div>
</div>
<div class="clr"></div>
<script type="text/javascript">
    var mycontent = new baidu.editor.ui.Editor({toolbars:[[<?=$toolbars?>]],minFrameHeight:300,wordCount:<?=$setting['editor_wordcount']?>,elementPathEnabled:<?=$setting['editor_elementpath']?>});
    mycontent.render("mycontent");
    function check_form(){
        mycontent.sync();
        var title = ("#title").val();
        if($.trim(title) == ''){
            alert("������ⲻ��Ϊ��!");
            return false;
        }
        return true;
        
    }
</script>
<? include template('footer'); ?>
