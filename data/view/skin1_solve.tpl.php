<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrap1 ask-sub"> <span class="subleft margintop10 color06b"><a href="<?=SITE_URL?>"><?=$setting['site_name']?></a> 
  
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
 
  &gt;<a href="<?=SITE_URL?>index.phpc-<?=$nav['id']?>.html"> <?=$nav['name']?></a> 
  
<? } } ?>
 </span> <span class="subright margintop10 color666"> <a href="">58�԰�����</a> <a href="">58�԰���������ô����</a> </span> </div>
<div class="wrap1 ask-tie">
  <div class="tie-left">
    <div class="tboxs tbstyle110">
      <div class="tbtop">
        <dl>
          <dt>�ѽ������</dt>
          <dd>�������Ѿ���������ӭ�������ۣ���</dd>
        </dl>
        <ul>
          <li><a href="<?=SITE_URL?>index.phpc-<?=$nav['id']?>.html" title="�鿴�ü�������" target="_blank">�ü�������</a></li>
          <li><a style="cursor: pointer;" class="margin10 blue2" href="<?=SITE_URL?>index.php?question/addfavorite/<?=$question['id']?>/<?=$question['cid']?>.html">����ղ�</a></li>
        </ul>
      </div>
      <div class="tblef"> <span class="touxiang"> <span class="xinxibox"> <a href="<?=SITE_URL?>index.phpu-<?=$question['authorid']?>.html" class="yisheng"><img src="<?=$question['author_avartar']?>" alt=""  /></a> <span class="xinxi"> <span class="point2"></span> </span> </span> <span class="point"></span> </span> <span class="username color06b"><a href="<?=SITE_URL?>index.phpu-<?=$question['authorid']?>.html"><?=$question['author']?></a></span> </div>
      <div class="tbrig"> <span class="tousu color999">����ʱ�䣺<b><?=$question['format_time']?></b>��</span>
        <h1><?=$question['title']?></h1>
        <span id="mydescription"><?=$question['description']?></span><br>
        <? if($supplylist) { ?> 
        {loop <?=$supplylist?> <?=$supplcript?>>

        <span class="buchong margintop10">
        <p><span >�������⣺</span><b>(<?=$supply['format_time']?>)</b><br />
          <?=$supply['content']?></p>
        </span> 
        <!--{/loop} 
        <? } ?> 
        <span class="anniu margintop10"> <a href="javascript:void(0);" style="display:none;" id="asropt" target="_self" class="wolai" title="�����ش�"  onclick="QuickReply();"></a></span> 
        <!--������--> 
        <span class="clearer"><script type="text/javascript">/*468*60�������Ƽ��·����*/ var cpro_id = 'u630081';</script><script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script></span> <span class="fenxiang margintop10"></span> </div>
    </div>
    <div class="huida margintop10"  style="display:none"> <span class="hdleft"></span> <span class="hdright"> </span> </div>
    
    <!--���ɴ�-->
    <div class="tboxs tbstyle220">
      <div class="tbtop">
        <dl>
          <dt>�Ѳ��ɴ�</dt>
          <dd>���˴��������ߵ�ѡ��</dd>
        </dl>
      </div>
      <div class="tblef"> <span class="touxiang"> <span class="xinxibox" onmouseover="this.className='xinxibox showxx'" onmouseout="this.className='xinxibox'"> <a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" class="yisheng"  target="_blank"><img src="<?=$bestanswer['author_avartar']?>" alt=""  /></a> <span class="xinxi">
        <dl>
          <dd class="imgbox"><a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" class="yisheng" target="_blank"><img src="<?=$bestanswer['author_avartar']?>" alt="" /></a></dd>
          <dd class="name color06b"><a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" ><?=$bestanswer['author']?></a></dd>
          <dd class="jj">58�԰��ʴ�</dd>
          <dd class="jj">�԰�ר��</dd>
          <dd class="js color666">�ѻش�� <a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" target="_blank">101971</a> λ���⣬ <a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573">6878</a> ���ش𱻻�����Ϊ���ɴ�</dd>
          <dd class="tw"><a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573" class="a1" title="���ҽ������" target="_blank">���ҽ������</a><a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" class="a2" title="�鿴��ҽ��������ҳ">�鿴��ҽ��������ҳ</a></dd>
        </dl>
        <span class="point2"></span> </span> </span> <span class="point"></span> </span> <span class="username color06b"><a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html" target="_blank"><?=$bestanswer['author']?></a></span> <span class="ziliao">����ҽ</span> <span class="ziliao color666">�ѻش�:<a href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html">101971</a>��</span> <span class="tiwen"><a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573" title="���ҽ������"></a></span> </div>
      <div class="tbrig"> <span class="tousu color999"> ����ʱ�䣺<b><?=$question['format_time']?></b> <a class="margin10 blue2"  href="javascript:inform('<?=$answer['author']?>',2);">Ͷ��</a></span>
        <p><?=$bestanswer['content']?><p>
        <p class="pingjia color06b"><span>�����߶��ڴ𰸵����ۣ�</span><br />
          <a target="_blank" href="<?=SITE_URL?>index.phpu-<?=$bestanswer['authorid']?>.html"><?=$question['author']?></a>��<? if($bestanswer['comment']) { ?><?=$bestanswer['comment']?><? } else { ?>лл���Ľ��<? } ?><span class="point"></span></p>
        </p>
        <span class="annius"> <span class="zhichi" id="pingjia"><a href="javascript:vote(<?=$question['id']?>);">֧��(<span id="goods"><?=$question['goods']?></span>)</a> </span> </span> <span class="clearer"></span>
        <ul class="color06b margintop10" id="divReply_48632414">
        </ul>
      </div>
    </div>
    
    <!--���ɴ𰸽���--> 
    
    <!--��ҽ�����ʼ--> 
    
<? if(is_array($answerlist)) { foreach($answerlist as $index => $answer) { ?>
 
    <? if(!$answer['adopttime']) { ?> 
    <? $index++ ?>    <div class="tboxs tbstyle<?=$index?>" id="asr<?=$answer['authorid']?>">
      <div class="tbtop">
        <dl>
          <dt>����ҽ���ش�</dt>
        </dl>
      </div>
      <div class="tblef"> <span class="touxiang"> <span class="xinxibox" onmouseover="this.className='xinxibox showxx'" onmouseout="this.className='xinxibox'"> <a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" class="yisheng" ><img src="<?=$answer['author_avartar']?>" alt=""  /></a> <span class="xinxi">
        <dl>
          <dd class="imgbox"><a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" class="yisheng" ><img src="<?=$answer['author_avartar']?>" alt="" /></a></dd>
          <dd class="name color06b"><a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" ><?=$answer['author']?></a></dd>
          <dd class="jj">58�԰��ʴ�</dd>
          <dd class="jj">�԰�ר��</dd>
          <dd class="js color666">�ѻش�� <a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html">101971</a> λ���⣬ <a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573" target="_blank">6878</a> ���ش𱻻�����Ϊ���ɴ�</dd>
          <dd class="tw"><a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573" class="a1" title="���ҽ������" target="_blank">���ҽ������</a><a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" class="a2" title="�鿴��ҽ��������ҳ">�鿴��ҽ��������ҳ</a></dd>
        </dl>
        <span class="point2"></span> </span> </span> <span class="point"></span> </span> <span class="username color06b"> <a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" title="<?=$answer['author']?>"><?=$answer['author']?></a> </span> <span class="ziliao">58�԰��ʴ�</span> <span class="ziliao color666">�ѻش�:<a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html">101971</a>��</span> <span class="tiwen"><a href="<?=SITE_URL?>index.phpu-<?=$answer['authorid']?>.html" title="���ҽ������"></a></span> </div>
      <div class="tbrig"> <span class="tousu color999"> ����ʱ�䣺<b><?=$question['format_time']?></b> <a class="margin10 blue2"  href="javascript:inform('<?=$answer['author']?>',2);">Ͷ��</a></span> <span id="mc<?=$index?>"><?=$answer['content']?></span> <span class="annius">
        <div id="apt_<?=$answer['id']?>" style="display:none;"> <A class=caina title=���ɴ� onclick="adoptanswer(<?=$answer['id']?>);" style="cursor:hand;" name="adoptanswer" target=_self>���ɴ�</A> </div>
        <? if($answer['status'] ) { ?> 
        <span id="eaopt<?=$answer['authorid']?>" style="display:none;"> <A class=caina title=�޸Ĵ� onclick="editanswer(<?=$answer['id']?>,'mc<?=$index?>');" style="cursor:hand;" name="submit" target=_self>�޸Ĵ�</A> </span> 
        <? } ?> 
        <span class="zhichi" id="pingjia"><a href="javascript:vote(<?=$question['id']?>);">֧��(<span id="goods"><?=$question['goods']?></span>)</a> </span> </span><span class="clearer"></span> 
        
        <? if($user['groupid']==1) { ?> 
        <span class="fenxiang margintop10"> <span  class="boxtop1_title">�ش����</span><br>
        <span class="blue2"><a href="javascript:void(0);" onclick="editanswer(<?=$answer['id']?>,'mc<?=$index?>');return false;">�༭����</a></span> <span class="blue2"><a href="javascript:delanswer(<?=$answer['id']?>,<?=$question['id']?>);">ɾ��</a></span> 
        <? if(!$answer['status']) { ?> 
        <span class="blue2"><a href="javascript:verifyanswer(<?=$answer['id']?>,<?=$question['id']?>);">���</a></span><? } ?> 
        <span class="clearer"></span></span> 
        <? } ?> 
      </div>
    </div>
    <? } ?> 
    
<? } } ?>
 
    <!--ҽ���ظ�����-->
    <div class="ulbox">
      <div class="ultop color06b"><span class="zui">���δ����Ƽ�</span></div>
      <ul class="ul1 color06b">
        ���λ
      </ul>
    </div>
    <div class="chongxin margintop10"> <span class="cx"><a href="/?question/add.html" title="���������������" target="_blank"></a></span> <span class="bz color06b">���˽����ʲ��裿��鿴�� ��<a href="/?question/add.html" target="_blank" title="����鿴���ʰ���" target="_blank">���ʰ���</a></span> </div>
    <div class="ulbox">
      <div class="ultop color06b"><span class="zui">��������Ƽ�</span></div>
      <ul class="ul1 color06b">
        
<? if(is_array($solvelist)) { foreach($solvelist as $solve) { ?>
 
        <? if($question['id'] != $solve['id']) { ?>        <li><span class="tit"><a href="<?=SITE_URL?>index.phpq-<?=$solve['id']?>.html" title="<?=$solve['title']?>" target="_blank"><?=$solve['title']?></a></span><span class="otr"><?=$solve['answers']?>���ش�</span></li>
        <? } ?> 
        
<? } } ?>
      </ul>
    </div>
    <span class="clearer"></span> </div>
  <div class="tie-right"> <span class="spboxs color06b"> <strong>�Ƽ�ҽ��</strong> <span class="cons"> 
    <? $expertlist=$this->fromcache('expertlist'); ?> 
    
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
 
    <span class="banzhu">
    <p class="p1"> <span class="imgbox"><a href="<?=SITE_URL?>index.phpu-<?=$expert['uid']?>.html"><img src="<?=$expert['avatar']?>" /></a></span> <span class="name"><a href="<?=SITE_URL?>index.phpu-<?=$expert['uid']?>.html" title=""><?=$expert['username']?></a></span> <span class="jj">�ó���<?=$expert['categoryname']?></span> <span class="tiwen"><a href="http://bft.zoosnet.net/LR/Chatpre.aspx?id=BFT68464573"  target="_blank" title="���ҽ������"></a></span> <span class="clearer"></span> </p>
    <p class="p2">�ѻش���������<b><a href="<?=SITE_URL?>index.phpu-<?=$expert['uid']?>.html"><?=$expert['credit1']?></a></b> ��</p>
    </span> 
    
<? } } ?>
 
    </span> </span> <span class="looks2"> <strong>�����Ƽ�</strong> <span class="imgbox imgbox1"> 

���λ
    </span> </span> <span class="gpboxs"> <strong>���Ż���</strong> <span class="cons">
    <ul class="ul4 uls">
      <? $recommendlist=$this->fromcache('recommendlist'); ?> 
      
<? if(is_array($recommendlist)) { foreach($recommendlist as $index => $recommend) { ?>
      <li><a href="<?=SITE_URL?>index.phpq-<?=$recommend['qid']?>.html"  title="<?=$recommend['title']?>" target="_blank"><? echo cutstr($recommend['title'],30); ?></a></li>
      
<? } } ?>
    </ul>
    </span> </span> </div>
</div>
<? include template('footers'); ?>
 <? if($setting['editor_on'] ) { ?> 
<script src="<?=SITE_URL?>js/xheditor/xheditor-zh-cn.min.js" type="text/javascript"></script> <? } ?> 
<script type="text/javascript">
    var user=null;
    $.getJSON(g_site_url+"index.php?user/ajaxheader/"+Math.random(),function(myuser){
        user=myuser;
    });

    //�������
    function managequest(num){
        switch(num){
            case 1:
                $.dialog({
                    id:'renametitle',
                    position:'center',
                    align:'left',
                    fixed:1,
                    width:300,
                    height:100,
                    title:'�޸��������',
                    fnOk:function(){document.renameForm.submit();$.dialog.close('renametitle')},
                    fnCancel:function(){$.dialog.close('renametitle')},
                    content:'<div class="mainbox"><form name="renameForm"  action="<?=SITE_URL?>index.php?question/edittitle.html" method="post" ><input type="hidden" value="<?=$question['id']?>" name="qid"/>������⣺<br /><input type="text" name="title" value="<?=$question['title']?>" class="txt" size="45" /></form></div>'});
                break;
            case 2:
                $.dialog({
                    id:'editquesDiv',
                    position:'center',
                    align:'left',
                    fixed:1,
                    width:600,
                    title:'�޸���������',
                    fnOk:function(){editor.getSource();document.editquescontForm.submit();$.dialog.close('editquesDiv')},
                    fnCancel:function(){$.dialog.close('editquesDiv')},
                    content:'<div>���⣺<?=$question['title']?><br /><form name="editquescontForm"  action="<?=SITE_URL?>index.php?question/editcont.html" method="post" ><textarea id="mc" name="content" style="width: 95%; padding-top: 1px; font-size: 14px;" rows="10" ><?=$question['description']?></textarea><input type="hidden"  value="<?=$question['id']?>" name="qid"/></form></div>'
                });
                editor=showeditor('mc');
                break;
            case 2:
                if(!confirm('ȷ��ɾ�����⣿�ò������ɷ��أ�')==false){
                    document.location.href="<?=SITE_URL?>index.php?index/default.html";
                }
                break;
            case 3:
                $.dialog({
                    id:'editcatediv',
                    position:'center',
                    align:'left',
                    fixed:1,
                    width:300,
                    height:100,
                    title:'�ƶ�����',
                    fnOk:function(){document.askform.submit();$.dialog.close('editcatediv')},
                    fnCancel:function(){$.dialog.close('editcatediv')},
                    content:'<div class="mainbox">��ѡ��Ҫ�ƶ����ķ��ࣺ<form name="askform" action="<?=SITE_URL?>index.php?question/movecategory.html" method="post" ><input type="hidden" name="qid" value="<?=$question['id']?>" /><select name="category" size=1 style="width:240px" ><?=$catetree?></select></form></div>'  });
                break;
            case 4:
                if(!confirm('ȷ���رո�����?')==false){
                    document.location.href="<?=SITE_URL?>index.php?question/close/<?=$question['id']?>.html";
                }
                break;
            case 5:
                document.location.href="<?=SITE_URL?>index.php?question/recommend/<?=$question['id']?>.html";
                break;
            case 6:
                if(!confirm('ȷ��ɾ�����⣿�ò������ɷ��أ�')==false){
                    document.location.href="<?=SITE_URL?>index.php?question/delete/<?=$question['id']?>.html";
                }
                break;
            default:
                alert("�Ƿ�������");
                break;
        }
    }

    //����ش�
    function editanswer(aid,mcdivid){
        var mc_content=$('#'+mcdivid).html();
        if('undefined'== typeof KE) mc_content=$.trim(mc_content.replaceAll("<br>","\n"));

        $.dialog({
            id:'editanswerDiv',
            position:'center',
            align:'left',
            fixed:1,
            width:600,
            title:'�޸Ļش�',
            fnOk:function(){editor.getSource();document.editanswerForm.submit();$.dialog.close('editanswerDiv')},
            fnCancel:function(){$.dialog.close('editanswerDiv')},
            content:user.username+',��Ҫ�޸ĵĻش�����: <div><form name="editanswerForm"  action="<?=SITE_URL?>index.php?question/editanswer.html" method="post" ><textarea id="mc" name="content" style="width: 95%; padding-top: 1px; font-size: 14px;" rows="12" cols="100" >'+mc_content+'</textarea><input type="hidden"  value="<?=$question['id']?>" name="qid"/><input type="hidden" id="ma" value="'+aid+'" name="aid"/></form></div>'

        });
        editor=showeditor('mc');

    }

    //ɾ���ش�
    function delanswer(aid,qid){
        if(confirm("ȷ��ɾ���ûش�?")){
            document.location.href='<?=SITE_URL?>index.php?question/deleteanswer/'+aid+'/'+qid+'.html';
        }
    }
</script> 
<script type="text/javascript">
    function vote(qid){
        $.get(g_site_url+"index.php?question/ajaxgood/"+qid+"/"+Math.random(), function(flag){
            if(-1==flag){
                alert('�������ۣ�');
            }else{
                $('#goods').html(1+parseInt($('#goods').html()));
            }
        });
    }
    <!--�û������л�-->
    function show_tabz1(num){
        for(i=0;i<100;i++){
            if(document.getElementById('zbfa0'+i)){
                document.getElementById('zbfa0'+i).className='boxtop2B';
                document.getElementById('zblia0'+i).style.display='none';
            }
        }
        document.getElementById('zbfa0'+num).className='boxtop2A';
        document.getElementById('zblia0'+num).style.display='block';
    }
    function show_tabz(num){
        for(i=0;i<100;i++){
            if(document.getElementById('zbf0'+i)){
                document.getElementById('zbf0'+i).className='boxtop2B';
                document.getElementById('zbli0'+i).style.display='none';
            }
        }
        document.getElementById('zbf0'+num).className='boxtop2A';
        document.getElementById('zbli0'+num).style.display='block';
    }
    function inform(name,type){
        var content = name+'�Ļش�';
        if(type==1){
            content = name+'������';
        }
        $.dialog({
            id:'informDiv',
            position:'center',
            align:'left',
            fixed:1,
            width:500,
            title:'�ٱ�',
            fnOk:function(){document.informform.submit();$.dialog.close('informDiv')},
            fnCancel:function(){$.dialog.close('informDiv')},
            content:'<div style="display: block; border-bottom: 1px dotted rgb(136, 136, 136);" class="font_orange2">��������ֲ����������ݻ���Ϊ���뼰ʱ��ϵ����Ա��</div><form name="informform" action="<?=SITE_URL?>index.php?inform/add.html" method="POST"> <div><p><strong>�ٱ����ݣ�</strong>'+content+'</p><p><strong>�ٱ�ԭ��</strong>(�ɶ�ѡ)</p><p><input type="checkbox" name="informkind[]" value="0" />���з���������</p><p><input type="checkbox" name="informkind[]" value="1" />����������������</p><p><input type="checkbox" name="informkind[]" value="2" />���й�����ʵ�����</p><p><input type="checkbox" name="informkind[]" value="3" />�漰Υ�����������</p><p><input type="checkbox" name="informkind[]" value="4" />����Υ��������µ�����</p><p><input type="checkbox" name="informkind[]" value="5" />��ɫ�顢�������ֲ�������</p><input type="checkbox" name="informkind[]" value="5" />���ж������Ĺ�ˮ������</p></div><input type="hidden"  value="<?=$question['id']?>" name="qid"/><input type="hidden"  value="'+content+'" name="content"/><input type="hidden"  value="<?=$question['title']?>" name="title"/></from>'
        });
    }
    $(document).ready(share);
</script>
</body>
</html>