<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryui.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#list").sortable({
            update: function(){
                var reorderid="";
                var numValue=$("input[name='order[]']");
                for(var i=0;i<numValue.length;i++){
                    reorderid+=$(numValue[i]).val()+",";
                }
                var hiddencid=$("input[name='hiddencid']").val();
                $.post("index.php?admin_link/reorder<?=$setting['seo_suffix']?>",{order:reorderid,hiddencid:hiddencid});
            }
        });
    });

    function remove(lid){
        if(confirm('ɾ�������ӣ�ȷ������?')){
            window.location="index.php?admin_link/remove/"+lid+"<?=$setting['seo_suffix']?>";;
        }
    }
</script>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>���������ҳ</b></a>&nbsp;&raquo;&nbsp;�ö����ѹ�������</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><table width="100%" cellspacing="1" cellpadding="4" align="center" class="tableborder">
    <tbody><tr class="header"><td>�ö����ѹ����б�</td></tr>
        <tr class="altbg1"><td>.</td></tr>
    </tbody>
</table>
<form action="index.php?admin_setting/topset<?=$setting['seo_suffix']?>" method="post">
    <table cellspacing="1" cellpadding="4" width="100%" align="center" style="border: 0 none !important; border-collapse: separate !important;empty-cells: show;margin-bottom: 0px;">
        <tr class="header" align="center">
            <td width="30%">��������</td>
            <td  width="35%">���ֵ</td>
        </tr>
        <tr class="smalltxt" align="center">
            <td  width="30%"  class="altbg1">��ǰ�����ö�ÿ�����ѽ��:</td>
            <td  width="35%" class="altbg2"><input value="<?=$setting['top_cat']?>" type="text" name="top_cat"></td>
        <tr class="smalltxt" align="center">
            <td  width="30%" class="altbg1">�����ö�ÿ�����ѽ��:</td>
            <td  width="35%" class="altbg2"><input value="<?=$setting['top_area']?>" name="top_area" type="text" ></td>
        </tr>
        <tr class="smalltxt" align="center">
            <td  width="30%" class="altbg1">ȫ���ö�ÿ�����ѽ��:</td>
            <td  width="35%" class="altbg2"><input value="<?=$setting['top_all']?>" name="top_all" type="text" ></td>
        </tr>
        
    </table>
    <br />
    <center><input type="submit" class="button" name="submit" value="�� ��"></center><br>
</form>
<br />
<? include template(footer,admin); ?>
