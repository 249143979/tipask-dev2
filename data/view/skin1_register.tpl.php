<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script type="text/javascript">
    usernameok=1;
    repasswdok=1;
    emailok=1;
    codeok=1;
    function check_username(){
        var username=$.trim($('#username').val());
        var length=bytes(username);
        if( length <3 || length >15 ){
            $('#usernametip').html("�û�����ʹ��3��15���ַ���");
            $('#usernametip').attr('class','font_orange2');
            usernameok=0;
        }else{
            $.post("<?=SITE_URL?>index.php?user/ajaxusername",{username: username}, function(flag){
                if(-1==flag){
                    $('#usernametip').html("���û����Ѿ����ڣ�");
                    $('#usernametip').attr('class','font_orange2');
                    usernameok=0;
                }else if(-2==flag){
                    $('#usernametip').html("�û������н����ַ���");
                    $('#usernametip').attr('class','font_orange2');
                    usernameok=0;
                }else{
                    $('#usernametip').html("<font color='green'>OK</font>");
                }
            });
        }
    }

    function check_passwd(){
        var passwd=$('#password').val();
        if( bytes(passwd) <6|| bytes(passwd)>16){
            $('#passwordtip').html("��������6���ַ�������ó���16���ַ����룡</font>");
            $('#passwordtip').attr('class','font_orange2');
        }else{
            $('#passwordtip').html("<font color='green'>OK</font>");
        }
    }

    function check_repasswd(){
        var repassword=$('#repassword').val();
        if( bytes(repassword) <6|| bytes(repassword)>16){
            $('#repasswordtip').html("��������6���ַ�������ó���16���ַ����룡");
            $('#repasswordtip').attr('class','font_orange2');
            repasswdok=0;
        }else{
            if($('#password').val()==$('#repassword').val()){
                $('#repasswordtip').html("<font color='green'>OK</font>");
            }else{
                $('#repasswordtip').html("�����������벻һ�£�");
                $('#repasswordtip').attr('class','font_orange2');
                repasswdok=0;
            }
        }
    }

    function check_email(){
        var email=$.trim($('#email').val());
        if (!email.match(/^[\w\.\-]+@([\w\-]+\.)+[a-z]{2,4}$/ig)){
            $('#emailtip').html("�ʼ���ʽ����ȷ!");
            $('#emailtip').attr('class','font_orange2');
            usernameok=0;
        }else{
            $.post("<?=SITE_URL?>index.php?user/ajaxemail",{email: email}, function(flag){
                if(-1==flag){
                    $('#emailtip').html("���ʼ���ַ�Ѿ�ע�ᣡ");
                    $('#emailtip').attr('class','font_orange2');
                    emailok=0;
                }else if(-2==flag){
                    $('#emailtip').html("�ʼ���ַ����ֹע�ᣡ");
                    $('#emailtip').attr('class','font_orange2');
                    emailok=0;
                }else{
                    $('#emailtip').html("<font color='green'>OK</font>");
                    $('#emailtip').attr('class','font_orange2');
                }
            });
        }
    }

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

    function docheck(){
        <? if($setting['code_register']) { ?>        return (usernameok && repasswdok && emailok && codeok);
        <? } else { ?>        return (usernameok && repasswdok && emailok );
        <? } ?>    }


</script>
<div class="box">
    <div class="box_left">
        <div class="box_left_nav font_gray">
            �� <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
        </div>
        <!--���� ��ʼ-->
        <div class="box_left1">
            <div class="boxtop2_title boxtop1">
                <strong>ע�����û�</strong>
            </div>
            <div style="padding-bottom: 0pt;" class="box_left1_down">
                <br />

                <div class="write">
                    <form name="reg" name="registform"   action="<?=SITE_URL?>user/register.html" method="post" onsubmit="return docheck();">
                        <div class="fjr">
                            <div class="retext fL fontBold"> �� �� ����</div>
                            <div class="fC">
                                <input type="text" size="35"  maxlength="18" id="username" name="username" onblur="check_username()">
                                <span id="usernametip" class="font_gray2">����ó���7�����ֻ�14���ֽ�(���֣���ĸ���»���)</span>
                            </div>
                        </div>
                        <div class="fjr">
                            <div class="retext fL fontBold"> ��¼���룺</div>
                            <div class="fC">
                                <input type="password" size="35" maxlength="64"  id="password" name="password"  onblur="check_passwd()">
                                <span id="passwordtip" class="font_gray2">����6-14λ����ĸ���ִ�Сд</span>
                            </div>
                        </div>
                        <div class="fjr">
                            <div class="retext fL fontBold"> ����ȷ�ϣ�</div>
                            <div class="fC">
                                <input type="password" size="35" maxlength="16" id="repassword" name="repassword"  onblur="check_repasswd()">
                                <span id="repasswordtip" class="font_gray2">���¼��������һ��</span>
                            </div>
                        </div>
                        <div class="fjr">
                            <div class="retext fL fontBold"> �����ʼ���</div>
                            <div class="fC">
                                <input type="text" size="35" maxlength="100" id="email" name="email" onblur="check_email()" >
                                <span id="emailtip" class="font_gray2">��������Ч���ʼ���ַ����������ʧʱƾ����ȡ</span>
                            </div>
                        </div>
                      <? if($setting['code_login']) { ?>                        <div class="fjr">
                            <div class="retext fL fontBold"> ��֤�룺</div>
                            <div class="fC">
                                <input type="text" size="10"  maxlength="4"  id="code" name="code" onblur="check_code()" />&nbsp;<img id="verifycode" onclick="javascript:updatecode();" src="<?=SITE_URL?>user/code.html"/>
                                <span><a href="javascript:updatecode();">�����壬��һ��</a></span>
                                <span id="codetip" class="font_gray2"></span>
                            </div>
                        </div>
                        <? } ?>                        <div class="btn_sure">&nbsp;&nbsp;<input type="submit" name="submit" value="�����û�" /></div>
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
        <div class="box_left_nav" align="right"><a href="<?=SITE_URL?>user/login.html" class="f14">������Ѿ�ע�ᣬ���ˡ���¼����>></a></div>
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