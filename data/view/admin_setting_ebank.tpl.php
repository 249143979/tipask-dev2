<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>���������ҳ</b></a>&nbsp;&raquo;&nbsp;�Ƹ���ֵ</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><form action="index.php?admin_setting/ebank<?=$setting['seo_suffix']?>" method="post">
    <a name="��������"></a>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
        <tr class="header">
            <td colspan="2">֧��������˵��</td>
        </tr>
        <tr>
            <td colspan="2">
                1����֧������(http://www.alipay.com)���й����ȵ�����֧��ƽ̨����ȫ����� B2B ��˾����Ͱ͹�˾������Ϊ Tipask �û��ṩ�Ƹ���ֵƽ̨����ֻ����м򵥵����ã�����ʹϵͳ���ݺ����������Ϊ��������������Ҫ������Դ���Ӷ�ʵ����վ�Ĺ�ģ����Ӫ��<br />
                2�������漰�ֽ��ף�Ϊ�����������������ɵ��ʽ���ʧ�����ڿ�ʼʹ��֧�������ֽ��׹���(������֧������ť����)ǰ�������ϸ�Ķ����û�ʹ��˵���顷���йص�������Ĳ��֣���ȷ����ȫ����ͽ���������̼�ʹ�÷������ٽ���������á�<br />
                3����������������û�ͨ���ֽ�����֧���ķ�ʽ��Ϊ�佻�׻����˻���ֵ�����ڹ��򷢲��������⡢�һ���Ʒ�ȹ��ܡ�֧�������ֽ��׹��ܣ����ڡ��������á������ý��׻��֣���ͬʱ������Ӧ�Ļ��ֲ��������㲻ͬ���ϵ���Ҫ���������ȷ��������տ�֧�����˺ţ���������û����������޷�ʵʱ���ˣ���ɴ�����Ҫ�˹������Ķ�����Ϣ��<br />
                4���� Tipask �ٷ���վ��ٷ���̳����֪ͨ���⣬Tipask �ṩ��֧����֧������ÿ�ʽ�����ȡ 1.5% �������ѡ��뼰ʱ��ע���ҵ�������֪ͨ���������߻����̵ı������������ Tipask �ٷ���վ��ٷ���̳�ṩ����ϢΪ׼��<br />
                5����ʹ��֧���������ǽ�������ȫ��Ը�Ļ����ϣ��� Tipask �����۶����������ɵ��ʽ���ʧ���⣬Tipask�ٷ�������ʹ�ô˹�����ɵ��κ���ʧ�е����Ρ�<br />
                6��֧����ҵ����ѯ Email Ϊ 6688@taobao.com��֧�����ͻ�����绰Ϊ +86-0571-88156688��
            </td>
        </tr>
        <tr class="header">
            <td colspan="2">��������</td>
        </tr>
        <tr>
            <td width="45%"><b>�����Ƹ���ֵ��</b><br><span class="smalltxt">�رպ���վ��û�вƸ���ֵ�Ĺ���</span></td>
            <td>
                <input class="radio" type="radio" <? if(1==$setting['recharge_open'] ) { ?>checked<? } ?>  value="1" name="recharge_open" />��&nbsp;&nbsp;
                       <input class="radio" type="radio" <? if(0==$setting['recharge_open'] ) { ?>checked<? } ?>  value="0" name="recharge_open" />��
            </td>
        </tr>
        <tr>
            <td width="45%"><b>��ֵ����:</b><br><span class="smalltxt">��������1ԪΪ��λ������ 1Ԫ=10�Ƹ�ֵ</span></td>
            <td>1Ԫ = <input type="text" class="txt" name="recharge_rate" value="<?=$setting['recharge_rate']?>" size="8"/> �Ƹ�ֵ</td>
        </tr>
        <tr class="header">
            <td colspan="2">֧������ʱ��������</td>
        </tr>
        <tr>
            <td width="45%"><b>�տ�֧�����˺ţ�</b><br><span class="smalltxt">����վ���տ�֧�����˺ţ�ȷ����ȷ��Ч</span></td>
            <td><input type="text" class="txt" name="alipay_seller_email" value="<?=$setting['alipay_seller_email']?>"/></td>
        </tr>
        <tr>
            <td width="45%"><b>���������� (partnerID):</b><br><span class="smalltxt">֧����ǩԼ�û����ڴ˴���д֧�����������ĺ��������ݣ�ǩԼ�û��������Ѱ�������֧�����ٷ���ǩԼЭ��Ϊ׼,����ѯ0571-88158090</span></td>
            <td><input type="text" class="txt" name="alipay_partner" value="<?=$setting['alipay_partner']?>"/></td>
        </tr>
        <tr>
            <td width="45%"><b>���װ�ȫУ���� (key):</b><br><span class="smalltxt">֧����ǩԼ�û������ڴ˴���д֧�����������Ľ��װ�ȫУ���룬��У��������Ե�֧�����ٷ����̼ҷ����ܴ��鿴</span></td>
            <td><input type="text" class="txt" name="alipay_key" value="<?=$setting['alipay_key']?>"/></td>
        </tr>
    </table>
    <br>
    <center><input type="submit" class="button" name="submit" value="�� ��"></center><br>
</form>
<br>
<? include template(footer,admin); ?>