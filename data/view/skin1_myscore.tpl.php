<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="box">
    <div class="box_left_nav font_gray" style="font-size: 12px;">�� <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a> &gt; <a>�ҵĻ���</a> </div>
    <!--���� begin-->
    <div class="ps_content">
        <!--��� begin -->
        <div class="ps_contentl">
            <!--�û���Ϣ-->
            <!--��� begin -->
            <!-- ������Ϣ ��ʼ-->
            <div class="ps_box1">
                <div class="person_name"><?=$user['username']?> </div>
                <div class="user_info">
                    <div class="person_pic"><img id="headPic" src="<?=$user['avatar']?>" alt="<?=$user['username']?>" title="<?=$user['username']?>"></div>
                    <div class="user_subinfo">
                        <span><?=$user['grouptitle']?></span>
                    </div>
                </div>
                <div class="user_info">
                    <? if(2==$user['grouptype']) { ?>                    <div>
                        <? $credit1percent=round(($user['credit1']/$user['creditshigher'])*100); ?>                        <? $credit1percentleft = 100-$credit1percent-1 ?>                        ��������<img src="css/default/jindutiao_yellow.gif" alt="" style="vertical-align: middle;" width="<?=$credit1percent?>" height="7"><img src="css/default/jindutiao_white-02.gif" alt="" style="vertical-align: middle;" width="<?=$credit1percentleft?>" height="7"><img src="css/default/jindutiao_end.gif" alt="" style="vertical-align: middle;" width="1" height="7"><span class="font_gray">(<?=$user['credit1']?>/<?=$user['creditshigher']?>)</span>
                    </div>
                    <? } ?>                </div>
            </div>
            <!-- ������Ϣ ����-->
            <div class="nav_bar">
                <dl>
                    <dd class="hover" id="myscore"><a href="<?=SITE_URL?>?user/score.html">�ҵĻ���</a></dd>
                    <dd class="nav_link" id="myask"><a href="<?=SITE_URL?>?user/profile.html">��������</a></dd>
                    <dd class="nav_link" id="myask"><a href="<?=SITE_URL?>?user/ask.html">�ҵ�����</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/answer.html">�ҵĻش�</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/favorite.html">�ҵ��ղ�</a></dd>
                    <dd class="nav_link" id="mymsg"><a href="<?=SITE_URL?>?message/new.html">�ҵ���Ϣ</a></dd>
                </dl>
            </div>
            <!--��� end -->
        </div>
        <!--��� end -->
        <!--�ұ� begin -->
        <div id="centerInfo" class="ps_contentr" style>
            <!-- ������ҳ begin-->
            <? if($setting['outextcredits']) { ?>            <div class="column">
                <div class="column_title">���ֶһ�</div>
                <form name="exchangeform"  action="<?=SITE_URL?>?user/exchange.html" method="post">
                    <div class="taber">
                        <h3>���ֶһ�</h3>
                    </div>
                    <div class="taber" style="background-color:#FAFDFE;">
                        <div style="float:left;margin-left:10px">
                            <input type="text" id="exchangeamount"  name="exchangeamount" onkeyup="init_exchange()" size="5" value="10"  >
                            <select id="tocredits"  name="tocredits" onchange="init_exchange()" >
                                
<? if(is_array($outextcredits)) { foreach($outextcredits as $index => $credits) { ?>
                                <option value="<?=$credits['creditsrc']?>|<?=$credits['creditdesc']?>" src="<?=$credits['creditsrc']?>" unit="<?=$credits['unit']?>" title="<?=$credits['title']?>" index="<?=$index?>" ratio="<?=$credits['ratio']?>"><?=$credits['title']?></option>
                                
<? } } ?>
                            </select>
                        </div>

                        <div style="float:left;margin-left:80px">
                            ����<input  type="text" id="needamount" name="needamount" size="5" disabled="disabled"  value="0">
                            <select id="fromcredits"  name="fromcredits"></select>
                        </div>
                        <span style="margin-left:80px"><input type="submit" value="�����һ�" name="exchange"></span>
                    </div>
                    <input type="hidden" id="outextindex" name="outextindex" >
                </form>
                <script type="text/javascript">
                    function init_exchange(){
                        var exchangeamount=parseFloat($('#exchangeamount').val());
                        var creditsrc=$('#tocredits').find("option:selected").attr('src');
                        var ratio=parseFloat($('#tocredits').find("option:selected").attr('ratio'));
                        var outextindex=$('#tocredits').find("option:selected").attr('index');
                        $('#outextindex').val(outextindex);
                        $('#needamount').val(exchangeamount/ratio);
                        $("#fromcredits").empty();
                        if(1==creditsrc){
                            $("#fromcredits").append('<option value="1" title="����">����ֵ</option>');
                        }else{
                            $("#fromcredits").append('<option value="2" title="�Ƹ�">�Ƹ�ֵ</option>');
                        }
                    }
                    $(document).ready(init_exchange);
                </script>
            </div>
            <? } ?>            <div class="column">
                <div class="column_title">����ֵ</div>
                <table class="jifen" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <th width="10%">�ܷ�</th>
                        <th>�ճ�����</th>
                        <th>�����÷�</th>
                        <th>Υ�洦��</th>
                    </tr>
                    <tr>
                        <td class="font_orange2"><?=$user['credit1']?></td>
                        <td class="font_orange2"><?=$detail1['other']?></td>
                        <td class="font_orange2"><?=$detail1['reward']?></td>
                        <td class="font_orange2"><?=$detail1['punish']?></td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <div class="column_title">�Ƹ�ֵ</div>
                <table class="jifen" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <th width="10%">�ܷ�</th>
                        <th>�����÷�</th>
                        <th>Υ�洦��</th>
                        <th>���͸���</th>
                        <th>�ش𱻲���</th>
                    </tr>
                    <tr>
                        <td class="font_orange2"><?=$user['credit2']?></td>
                        <td class="font_orange2"><?=$detail2['reward']?></td>
                        <td class="font_orange2"><?=$detail2['punish']?></td>
                        <td class="font_orange2"><?=$detail2['offer']?></td>
                        <td class="font_orange2"><?=$detail2['adopt']?></td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <div class="column_title">֪����ϸ</div>
                <table class="jifen" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <th width="10%">�ش���</th>
                        <th>������</th>
                        <th>������</th>
                    </tr>
                    <tr>
                        <td class="font_orange2"><?=$user['answers']?></td>
                        <td class="font_orange2"><?=$adoptpercent?>%</td>
                        <td class="font_orange2"><?=$user['questions']?></td>
                    </tr>
                </table>
            </div>
            <!--  ��Ϣ���� -->
        <!-- ���� �ش�-->
        <div class="ps_contentr"></div>
        <!--�ұ� end --></div>
    <!--���� end-->
    <div class="clear"></div>
</div>
</div>
<? include template('footer'); ?>
