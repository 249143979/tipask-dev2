<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('headers'); ?>
<script type="text/javascript">

    function check_code(){
        var code=$.trim($('#code').val());
        $.post("<?=SITE_URL?>index.php?user/ajaxcode",{code: code}, function(flag){
            if(1==flag){
                $('#codetip').html("<font color='green'>OK</font>");
            }else{
                $('#codetip').html("��֤�벻ƥ�䣡");
                $('#codetip').attr('class','font_orange2');
                codeok=0;
            }
        });
    }

</script>
<div class="box">
    <div class="box_left">
        <div class="box_left_nav font_gray">
            �� <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
        </div>
        <!--���� ��ʼ-->
        <div class="box_left1">
            <div class="boxtop2_title boxtop1">
                <strong>���û�ӭ��¼<?=$setting['site_name']?>�ʴ���</strong>
            </div>
            <div style="padding-bottom: 0pt;" class="box_left1_down">
                <br />

                <div class="write">
                    <form name="loginform"  action="<?=SITE_URL?>user/login.html" method="post">
                    <div class="fjr">
                        <div class="retext fL fontBold"> �� �� ����</div>
                        <div class="fC"><input type="text" size="35"  maxlength="18" id="username" name="username" /></div>
                    </div>
                    <div class="fjr">
                        <div class="retext fL fontBold"> ��¼���룺</div>
                        <div class="fC"><input type="password" size="35" maxlength="64"  id="password" name="password" /></div>
                    </div>
                      <? if($setting['code_login']) { ?>                        <div class="fjr">
                            <div class="retext fL fontBold"> ��֤�룺</div>
                            <div class="fC">
                                <input type="text" size="10"  maxlength="4" id="code" name="code" onblur="check_code()" />&nbsp;<img id="verifycode" onclick="javascript:updatecode();" src="<?=SITE_URL?>user/code.html"/>
                                <span><a href="javascript:updatecode();">�����壬��һ��</a></span>
                                <span id="codetip" class="font_gray2"></span>
                            </div>
                        </div>
                        <? } ?>                    <div class="fjr">
                        <div class="retext fL fontBold">&nbsp;</div>  
                        <div class="fC"><input type="checkbox" checked value="2592000" id="cookietime" name="cookietime">&nbsp;�´��Զ���¼</div>
                    </div>

                    <div class="btn_sure">&nbsp;&nbsp;<input type="submit" name="submit" value="��&nbsp;¼" />&nbsp;���������ˣ����� ��<a class="red" href="<?=SITE_URL?>user/getpass.html">�һ�����</a>�� ��</div>
                    </form>
                </div>
            </div>
            <br /><br /><br />
        </div>
        <!--���� ����-->
        <div class="blank10">
        </div>
        <!--�����Ƽ� ��ʼ-->
        <!--�����Ƽ� ����-->
        <div class="blank10">
        </div>
        <!--��������� begin-->

        <!--��������� end--></div>
    <!--�������� end-->
    <!--�������� begin-->
    <div class="boxthree">
        <div class="box_left_nav" align="right"><a href="<?=SITE_URL?>user/register.html">��û���˺ţ�����ע�ᣡ >></a></div>
        <div class="boxthree2">
            <div class="boxtop">������ʿ</div>
            <div class="boxthree2down blue">
                <div id="Userorder1_plNo2">
                    <div class="fenr margb">
                        <div class="flmrbc">
                            <p>������������ע�⣬����Ҫע�Ტ��½�������������ǵ�����������и��������������ֻ�������������Ȩ�ޡ�</p><br />
                            <p>��������ڼ��б����ķ��գ�һ�����뱻����ĸ�����Ϣ��й©��Σ�գ�ͬʱ�������ѵ�����Ҳ������𺦡�</p><br />
                            <p>�����Ǿܾ������ʼ�����ʹ����Ч���ʼ���ַ��</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--�������� end-->
    <div class="clear">
    </div>
</div>
<? include template('footer'); ?>
