<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/dialog.js" type="text/javascript"></script>
<script src="js/admin.js" type="text/javascript"></script>
<script src="js/calendar.js" type="text/javascript"></script>
<div id="append">
</div>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>���������ҳ</b></a>&nbsp;&raquo;&nbsp;�������</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><form action="index.php?admin_question/searchquestion<?=$setting['seo_suffix']?>" method="post">
    <table width="100%" cellspacing="0" cellpadding="4" align="center" class="tableborder">
        <tbody>
            <tr class="header" ><td colspan="4">�����б�</td></tr>
            <tr class="altbg1"><td colspan="4">����ͨ������������������������</td></tr>
            <tr>
                <td width="200"  class="altbg2">����:<input class="txt" name="srchtitle" <? if(isset($srchtitle)) { ?>value="<?=$srchtitle?>" <? } ?>></td>
                <td  width="200" class="altbg2">������:<input class="txt" name="srchauthor" <? if(isset($srchauthor)) { ?>value="<?=$srchauthor?>" <? } ?>></td>
                <td  width="200" class="altbg2">״̬:					
                    <select name="srchstatus">
                        <option <? if((isset($srchstatus) && '-1'==$srchstatus) ) { ?> selected <? } ?> value="-1">--����--</option>
                        <option value="1" <? if((isset($srchstatus) && 1==$srchstatus) ) { ?> selected <? } ?>>�����</option>
                        <option value="2" <? if((isset($srchstatus) && 2==$srchstatus) ) { ?> selected <? } ?>>�ѽ��</option>
                        <option value="6" <? if((isset($srchstatus) && 6==$srchstatus) ) { ?> selected <? } ?>>�Ƽ�����</option>
                        <option value="9" <? if((isset($srchstatus) && 9==$srchstatus) ) { ?> selected <? } ?>>�ѹر�����</option>
                    </select>
                </td>
                <td  rowspan="2" class="altbg2"><input class="btn" type="submit" value="�� ��"></td>
            </tr>
            <tr>
                <td  colspan="3" rowspan="2" class="altbg2">ʱ��:
                    <input class="txt" onclick="showcalendar();" name="srchdatestart" <? if(isset($srchdatestart)) { ?>value="<?=$srchdatestart?>" <? } ?>>&nbsp; ��&nbsp; 
                           <input class="txt" onclick="showcalendar();" name="srchdateend" <? if(isset($srchdateend)) { ?>value="<?=$srchdateend?>" <? } ?>>
                </td>
            </tr>
        </tbody>
    </table>
</form>
[�� <font color="green"><?=$rownum?></font> ������]
<form name="queslist" method="POST">
    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="tableborder">
        <tr class="header">
            <td width="5%"><input class="checkbox" id="chkall" onclick="checkall('qid[]')" type="checkbox" name="chkall"><label for="chkall">ȫѡ</label></td>
            <td  width="30%">����</td>
            <td  width="15%">������</td>
            <td  width="5%">����</td>
            <td  width="10%">�ش�/�鿴</td>
            <td  width="5%">״̬</td>
            <td  width="10%">IP</td>
            <td  width="12%">����ʱ��</td>
            <td  width="18%">���Ƽ�</td>
        </tr>
        <? if(isset($questionlist)) { ?> 
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
        <tr>
            <td class="altbg2">
                <input class="checkbox" type="checkbox" value="<?=$question['id']?>" name="qid[]" >
            </td>
            <td class="altbg2" id="title_<?=$question['id']?>"><a href="index.php?question/view/<?=$question['id']?><?=$setting['seo_suffix']?>" target="_blank"><? echo cutstr($question['title'],46,''); ?></a></td>
            <td class="altbg2"><a href="index.php?user/space/<?=$question['authorid']?><?=$setting['seo_suffix']?>" target="_blank"><?=$question['author']?></a></td>
            <td class="altbg2"><font color="#FC6603"><?=$question['price']?></font></td>
            <td class="altbg2"><?=$question['answers']?> / <?=$question['views']?></td>
            <td class="altbg2"><img src="<?=SITE_URL?>css/common/icn_<?=$question['status']?>.gif"></td>
            <td class="altbg2"><?=$question['ip']?></td>
            <td class="altbg2"><?=$question['format_time']?></td>
            <td class="altbg2"><? if($question['status']==6) { ?><img src="<?=SITE_URL?>css/common/icn_6.gif"><? } else { ?>��<? } ?></td>
        </tr>
        <? $content=htmlspecialchars($question['description']); ?>        <input type="hidden" id="cont_<?=$question['id']?>" value="<?=$content?>" >
        
<? } } ?>
        <? } ?>        <? if($departstr) { ?>        <tr class="smalltxt">
            <td class="altbg2" colspan="9" align="right"><div class="scott"><?=$departstr?></div></td>
        </tr>
        <? } ?>        <tr class="altbg1">
            <td colspan="9">
                <input name="ctrlcase" class="btn" type="button" onClick="buttoncontrol(2);" value="�Ƽ�">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="button" onClick="buttoncontrol(7);" value="��ӵ�ר��">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="submit" onClick="buttoncontrol(3);" value="ȡ���Ƽ�">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="button" onClick="movecate();" value="�ƶ�����">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="submit" onClick="buttoncontrol(4);" value="�ر�����">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="submit" onClick="buttoncontrol(5);" value="��Ϊ�����">&nbsp;&nbsp;&nbsp;
                <input name="ctrlcase" class="btn" type="submit" onClick="buttoncontrol(6);" value="ɾ��">
            </td>
        </tr>
    </table>
</form>
<? include template(footer,admin); ?>
<script type="text/javascript">
    function buttoncontrol(num){
        if($("input[name='qid[]']:checked").length==0){
            alert('��û��ѡ���κ�Ҫ���������⣡');
            return false;
        }else{
            switch(num){
                case 2:
                    if(confirm('ȷ���Ƽ����������ֻ���ѽ��������Ч��')==false){
                        return false;
                    }else{
                        document.queslist.action="index.php?admin_question/recommend<?=$setting['seo_suffix']?>";
                        document.queslist.submit();
                    }
                    break;
                case 3:
                    document.queslist.action="index.php?admin_question/inrecommend<?=$setting['seo_suffix']?>";
                    document.queslist.submit();
                    break;
                case 4:
                    if(confirm('ȷ���ر����⣿')==false){
                        return false;
                    }else{
                        document.queslist.action="index.php?admin_question/close<?=$setting['seo_suffix']?>";
                        document.queslist.submit();
                    }

                    break;
                case 5:
                    if(confirm('ȷ����Ϊ��������������ֻ���ѽ�����ѹر�������Ч��')==false){
                        return false;
                    }else{
                        document.queslist.action="index.php?admin_question/nosolve<?=$setting['seo_suffix']?>";
                        document.queslist.submit();
                    }

                    break;
                case 6:
                    if(confirm('ȷ��ɾ�����⣿�ò������ɷ��أ�')==false){
                        return false;
                    }else{
                        document.queslist.action="index.php?admin_question/delete<?=$setting['seo_suffix']?>";
                        document.queslist.submit();
                    }
                    break;
                case 7:
                    if($("input[name='qid[]']:checked").length == 0){
                        alert('��û��ѡ���κ�����');
                        return false;
                    }
                    var qids = document.getElementsByName('qid[]');
                    var num='',tag='';
                    for(var i=0;i<qids.length;i++){	
                        if(qids[i].checked==true){
                            num+=tag+qids[i].value;
                            tag=",";
                        }
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?=SITE_URL?>admin_topic/ajaxgetselect.html",
                        success: function(selectstr){
                            $.dialog({
                                id:'selecttopic',
                                position:'center',
                                align:'left',
                                fixed:1,
                                width:300,
                                height:100,
                                title:'��ӵ�ר��',
                                fnOk:function(){document.addtotopicForm.submit();$.dialog.close('selecttopic')},
                                fnCancel:function(){$.dialog.close('selecttopic')},
                                content:'<div class="mainbox"><form name="addtotopicForm"  action="index.php?admin_question/addtotopic<?=$setting['seo_suffix']?>" method="post" ><input type="hidden" name="qids" value="'+num+'" />'+selectstr+'</form></div>'
                            });
                        }
                    });
                    break;
                default:
                    alert("�Ƿ�������");
                    break;	
            }
        }
    }
    function renametitle(){
        if ($("input[name='qid[]']:checked").length > 1){
            alert('ֻ��ͬʱ��һ��������в�����');
            return false;
        }else if($("input[name='qid[]']:checked").length == 0){
            alert('��û��ѡ���κ�����');
            return false;
        }else{
            var qid = $("input[name='qid[]']:checked").val();
            var title = $('#title_'+qid).text();
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
                content:'<div class="mainbox"><form name="renameForm"  action="index.php?admin_question/renametitle<?=$setting['seo_suffix']?>" method="post" ><input type="hidden" value="'+qid+'" name="qid"/>������⣺<br /><input type="text" name="title" value="'+title+'" class="txt" size="45" /></form></div>'
            });
        }
    }
    function movecate(){
        if($("input[name='qid[]']:checked").length == 0){
            alert('��û��ѡ���κ�����');
            return false;
        }else{
            var qids = document.getElementsByName('qid[]');
            var num='',tag='';
            for(var i=0;i<qids.length;i++){	
                if(qids[i].checked==true){
                    num+=tag+qids[i].value;
                    tag=",";
                }
            }
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
                content:'<div class="mainbox">��ѡ��Ҫ�ƶ����ķ��ࣺ<form name="askform" action="index.php?admin_question/movecategory<?=$setting['seo_suffix']?>" method="post" ><input type="hidden" name="qids" value="'+num+'" /><select name="category" size=1 style="width:240px" ><?=$catetree?></select></form></div>'
            });
        }
    }
</script>


