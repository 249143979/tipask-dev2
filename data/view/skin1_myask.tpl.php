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
                    <dd class="nav_link" id="myscore"><a href="<?=SITE_URL?>?user/score.html">�ҵĻ���</a></dd>
                    <dd class="nav_link" id="myask"><a href="<?=SITE_URL?>?user/profile.html">��������</a></dd>
                    <dd class="hover" id="myask"><a href="<?=SITE_URL?>?user/ask.html">�ҵ�����</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/answer.html">�ҵĻش�</a></dd>
                    <dd class="nav_link" id="myanswer"><a href="<?=SITE_URL?>?user/favorite.html">�ҵ��ղ�</a></dd>
                    <dd class="nav_link" id="mymsg"><a href="<?=SITE_URL?>?message/new.html">�ҵ���Ϣ</a></dd>
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
            <div class="column">
                <div class="column_title2">
                    <ul>
                        <li class="tab_hover"><a>�ҵ�ȫ������</a></li>
                    </ul>
                </div>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td class="zxy_title" align="left" valign="middle" width="400" height="38">���⣨��<?=$questiontotal?>����</td>
                    <td class="zxy_title" align="center" valign="middle" width="50" height="38">״̬</td>
                    <td class="zxy_title" align="center" valign="middle" width="50" height="38">�ش���</td>
                    <td class="zxy_title" align="center" valign="middle" width="50" height="38">���ͷ�</td>
                    <td class="zxy_title" align="center" valign="middle" width="140" height="38">����ʱ��</td>
                </tr>
                <tr>
                    <td colspan="6" align="center" valign="middle" height="37">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
                            <tr>
                                <td class="zxy_biaoge_txt" align="left" valign="middle" width="400" height="38">
                                    <div class="tiw_blue_kuai">
                                        <span class="font_gray">[<a href="<?=SITE_URL?>c-<?=$question['cid']?>.html"><?=$question['category_name']?></a>]</span>
                                        <span class="tiw_blue"><a href="<?=$question['url']?>" target="_blank" title="<?=$question['title']?>"><?=$question['title']?></a></span>
                                    </div>
                                </td>
                                <td class="zxy_biaoge_txt f14 black" align="center" valign="middle" width="50" height="34"><img src="<?=SITE_URL?>css/common/icn_<?=$question['status']?>.gif"></td>
                                <td class="zxy_biaoge_txt f14 black" align="center" valign="middle" width="50" height="34"><?=$question['answers']?></td>
                                <td class="zxy_biaoge_txt f14 black" align="center" valign="middle" width="50" height="34"><?=$question['price']?></td>
                                <td class="zxy_biaoge_txt f14 black" align="center" valign="middle" width="130" height="34"><?=$question['format_time']?></td>
                            </tr>
                            
<? } } ?>
                        </table>
                    </td>
                </tr>
                <tr class="font_gray">
                    <td class="f12" colspan="5" align="right" valign="middle" height="20">
                        <div id="ask_page" style="padding: 5px 0pt;"><span id="pg_right"><?=$departstr?></span></div>
                    </td>
                </tr>
            </table>
        </div>
        <!--�ұ� end --></div>
    <!--���� end-->
    <div class="clear">
    </div>
</div>
<? include template('footer'); ?>