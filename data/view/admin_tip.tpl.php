<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="1" width="45%" align="center" class="tableborder">
<tr class="header"><td>��Ϣ��ʾ</td></tr>
<tr class="altbg2"><td><font color="#FFA406"><?=$message?></font><? if('BACK'!=$redirect) { ?><br /><span class="smalltxt">ҳ�潫��3����Զ���ת����һҳ����Ҳ����ֱ�ӵ� <a href="<?=$redirect?>" >������ת</a>��</span>
<script type="text/javascript">
function redirect(url, time) {
setTimeout("window.location='" + url + "'", time * 1000);
}
redirect('<?=$redirect?>', 3);
</script>
 <? } ?>  </td></tr>
</table><? } include template(footer,admin); ?>