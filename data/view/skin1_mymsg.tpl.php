<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL?>css/default/message.css" />
<div class="box">
    <div class="box_left_nav font_gray" style="font-size: 12px;">�� <a href="<?=SITE_URL?>"><?=$setting['site_name']?></a> &gt; <a>�ҵ���Ϣ</a></div>
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
                    <dd class="nav_link" id="myscore"><a href="<?=SITE_URL?>?user/score.html">�ҵĻ���</a></dd>
                    <dd class="nav_link" id="myask"><a href="<?=SITE_URL?>?user/ask.html">��������</a></dd>
                    <dd class="nav_link" id="myask"><a href="<?=SITE_URL?>?user/ask.html">�ҵ�����</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/answer.html">�ҵĻش�</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/favorite.html">�ҵ��ղ�</a></dd>
                    <dd class="hover" id="mymsg"><a href="<?=SITE_URL?>?message/new.html">�ҵ���Ϣ</a></dd>
                </dl>
            </div>
            <!--��� end -->
            <!--�������-->
            <div id="newMessage" class="user_info" ></div>
            <!--�������--></div>
        <!--��� end -->

        <!--�ұ� begin -->
        <!-- ���� �ش�-->
        <div class="ps_contentr">
            <div class="userCenter">
                <div class="box_userCenter clearfix">
                    <div class="box_msg">
                        <div class="topNav_msg clearfix">
                            <div class="tab_msg_bk">
                                <? if('outbox'==$type) { ?>                                    <span class="backmsg"><a  href="<?=SITE_URL?>?message/new.html">�ռ���</a></span>
                                    <H1>������</H1>
                                <? } else { ?>                                    <h1>�ռ���</h1>
                                    <span class="backmsg"><a href="<?=SITE_URL?>?message/outbox.html">������</a></span>
                                <? } ?>                                <input type="button" onclick="location.href='<?=SITE_URL?>?message/send.html'" value="д����Ϣ" id="wrtmsg">
                            </div>
                        </div>
                        <div class="box_msg_lan">
                            <div class="lanbk">
                                <? if('outbox' == $type) { ?>                                    <strong>�ѷ���Ϣ(<span class="font3"><?=$rownum?></span>)</strong>
                                <? } else { ?>                                    <? if('new'==$type) { ?><strong>δ����Ϣ(<span class="font3"><?=$newnum?></span>)</strong><? } else { ?><a href="<?=SITE_URL?>?message/new.html">δ����Ϣ(<span class="font3"><?=$newnum?></span>)</a><? } ?>|
                                    <? if('personal'==$type) { ?><strong>������Ϣ(<span class="font3"><?=$personalnum?></span>)</strong><? } else { ?><a href="<?=SITE_URL?>?message/personal.html">������Ϣ(<?=$personalnum?>)</a><? } ?>|
                                    <? if('system'==$type) { ?><strong>������Ϣ(<span class="font3"><?=$systemnum?></span>)</strong><? } else { ?><a href="<?=SITE_URL?>?message/system.html">ϵͳ��Ϣ(<?=$systemnum?>)</a><? } ?>                                <? } ?>                            </div>
                            <div id="msgTypeList">
                                <form name="msgform" method="POST">
                                    <input type="hidden" name="type" <? if('outbox'==$type) { ?>value="out"<? } else { ?>value="in"<? } ?> />
                                    <div class="lanT">
                                        <span class="fL"><input type="checkbox" value="all" id="checkall" onclick="checkmsg('mid[]');"></span><span class="delete fL">ɾ��</span>
                                        <span class="fR"><?=$departstr?></span>
                                    </div>
                                    <table cellspacing="0" cellpadding="0" border="0" id="msg_table" class="table_msg002">
                                        <tbody>
                                            <tr>
                                                <th width="30" class="textA_center f6"></th>
                                                <th width="40" class="textA_center f6">״̬</th>
                                                <th width="140" class="f6">������</th>
                                                <th width="340" class="f6">��Ϣ����</th>
                                                <th width="110" class="f6">����</th>
                                            </tr>
                                            
<? if(is_array($messagelist)) { foreach($messagelist as $message) { ?>
                                            <tr>
                                                <th class="trdotted" colspan="5"></th>
                                            </tr>
                                            <tr>
                                                <td class="textA_center"><input type="checkbox" name="mid[]" value="<?=$message['id']?>"></td>
                                                <td><span <? if($message['new']) { ?>class="icon_Check"<? } else { ?>class="icon_unCheck"<? } ?>></span></td>
                                                <td class=""><a target="_blank" href="<?=SITE_URL?>u-<?=$message['fromuid']?>.html"><?=$message['from']?></a></td>
                                                <? $fsubject=cutstr($message['subject'],52) ?>                                                <td class="box_msg_infoTxt "><a href="<?=SITE_URL?>?message/view/<?=$message['id']?>.html" title="<?=$message['subject']?>"><?=$fsubject?></a></td>
                                                <td class="time"><?=$message['time']?></td>
                                            </tr>
                                            
<? } } ?>
                                        </tbody>
                                    </table>
                                    <div class="lanB">
                                        <span class="fL"><a href="javascript:delmsg();">ɾ��</a></span>
                                        <span class="fR"><?=$departstr?></span>
                                    </div>
                                    <div class="zhu">ע����Ϣ̫�࣬���ֶ�ɾ��������Ϣ!</div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--�ұ� end --></div>
    <!--���� end-->
    <div class="clear">
    </div>
</div>
<script type="text/javascript">
    function checkmsg(name) {
        if($("#checkall").attr("checked")==true){
            $("input[name='mid[]']").each(function(){
                this.checked=true;
            });
        }else{
            $("input[name='mid[]']").each(function(){
                this.checked=false;
            });
        }
    }
    function delmsg(){
        document.msgform.action="index.php?message/remove<?=$setting['seo_suffix']?>";
        document.msgform.submit();
    }
</script>
<? include template('footer'); ?>
