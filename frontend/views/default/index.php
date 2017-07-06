<?php
use frontend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/main.css');
AppAsset::addScript($this,'@web/js/thirdLib/requirejs/require.js');

?>
<!-- S==banner -->
<div class="top_list">
    <div class="fullSlide">
        <div class="bd">
            <ul>
                <li style="background:url(imgs/index_bg1.png) center 0 no-repeat;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
                </li>
                <li style="background:url(imgs/index_bg2.png) center 0 no-repeat;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
                </li>
                <li style="background:url(imgs/index_bg3.png) center 0 no-repeat;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
                </li>
            </ul>
        </div>
        <div class="hd"><ul></ul></div>
        <span class="prev"></span>
        <span class="next"></span>
    </div>
</div>
<!-- E==banner -->

<!-- S==大数据 -->
<div class="numer_info">
    <ul>
        <li>
            <div class="number_info1"></div>
            <p>
                <label>13</label><span>亿</span><label>2866</label><span>万</span></br>
                <span>累计成交（元）</span>
            </p>
        </li>
        <li>
            <div class="number_info2"></div>
            <p>
                <label>160</label><span>亿</span><label>206</label><span>万</span></br>
                <span>累计注册人数（人）</span>
            </p>
        </li><li>
            <div class="number_info2"></div>
            <p>
                <label>812</label></br>
                <span>运营天数（天）</span>
            </p>
        </li>
    </ul>
</div>
<!-- E==大数据 -->
<!-- S==滚动公告 -->
<div class="message_wrap">
    <div class="message_info">
        <div class="message_announce"></div>
        <div class="note">
            <ul class="top_navList1">
                <li class="first"><a href="#">中商行“艺术宝”产品收益调整公告 2017-04-10</a></li>
                <li><a href="html/message_list.html">关于厦门银行存管系统升级维护的... 2017-04-11</a></li>
                <li><a href="html/message_list.html">P2P网络借贷，门槛低，收益高 2017-03-13</a></li>
                <li class="first"><a href="html/message_list.html">中商行“艺术宝”产品收益调整公告 2017-04-10</a></li>
                <li><a href="html/message_list.html">关于厦门银行存管系统升级维护的... 2017-04-11</a></li>
                <li><a href="html/message_list.html">P2P网络借贷，门槛低，收益高 2017-03-13</a></li>
                <li class="first"><a href="html/message_list.html">中商行“艺术宝”产品收益调整公告 2017-04-10</a></li>
                <li><a href="html/message_list.html">关于厦门银行存管系统升级维护的... 2017-04-11</a></li>
                <li><a href="html/message_list.html">P2P网络借贷，门槛低，收益高 2017-03-13</a></li>
            </ul>

        </div>
        <span class="message_more"><a href="html/message_dynamic.html"> 查看全部  ></a></span>

    </div>
</div>
<!-- E==滚动公告 -->
<!-- S==新手专享标 -->
<div class="mian_container">
    <div class="content_tittle">
        <span class="content_name">新手专享标</span>
        <span class="content_more">收益稳健 期限短</span>
    </div>
    <div class="boxL floor_produce">
        <p>
            <span class="floor_tittle">新手</span>
            <span class="floor_info">立即领取优惠红包劵</span>
        </p>
        <a href="html/invest.html">查看更多</a>
    </div>
    <div class="boxR">
        <div class="boxR_itemL">
            <div class="boxR_name">新手专享标</div>
            <div class="yield">
                <span class="min">10.00</span>
                <span class="line">-</span>
                <span class="max">14.00<label>%</label></span>
            </div>
            <div class="tag">
                <i class="text_tag">期限1个月 </i>
                <i class="text_tag" title="本项目每人累计购买的最大金额为10000.00元;">限额</i>
            </div>
            <div class="progress">
                <div class="sum">
                    <div class="current" style="width:60%;"></div>
                </div>
                <div class="highly">96%</div>
            </div>
            <div class="extend">
                <a href="html/art_treasure.html" class="extend_button" target="_blank">立即购买</a>
            </div>
        </div>
        <div class="boxR_itemR">
            <div class="boxR_name">新手专享标</div>
            <div class="yield">
                <span class="max">14.00<label>%</label></span>
            </div>
            <div class="tag">
                <i class="text_tag">期限3个月 </i>
                <i class="text_tag" title="持有1个月后可转让">可转</i>
            </div>
            <div class="progress">
                <div class="sum">
                    <div class="current" style="width:60%;"></div>
                </div>
                <div class="highly">96%</div>
            </div>
            <div class="extend">
                <a href="html/art_treasure.html" class="extend_button" target="_blank">立即购买</a>
            </div>
        </div>
        <div class="flow">
            <dl>
                <dt>1. 注册</dt>
                <dd>即送588元红包</dd>
                <dd class="point"><i class="icon icon_registered"></i></dd>
                <dd class="arrow"><i class="icon icon_arrow_right_9_15"></i></dd>
            </dl>
            <dl>
                <dt>2. 投资</dt>
                <dd>即送8888元理财金</dd>
                <dd class="point"><i class="icon icon_recharge"></i></dd>
                <dd class="arrow"><i class="icon icon_arrow_right_9_15"></i></dd>
            </dl>
            <dl class="last">
                <dt>3. 收益</dt>
                <dd>即可使用红包券</dd>
                <dd class="point"><i class="icon icon_earnings"></i></dd>
            </dl>
        </div>
    </div>
</div>
<!-- E==新手专享标 -->
<!-- S==投资有道 -->
<div class="mian_container">
    <div class="content_tittle">
        <span class="content_name">投资有道</span>
        <span class="content_more"><a href="html/invest.html">进入高端投资频道 ></a></span>
    </div>
    <div class="boxL floor_produce2">
        <p>
            <span class="floor_tittle">理财</span>
            <span class="floor_info">优质项目  任你选择</span>
        </p>
        <a href="html/invest.html">查看更多</a>
    </div>
    <div class="boxR produce2_items">
        <div class="product_panel">
            <span class="product_tittle">虫草酒-藏虫草股份</span>
            <span class="product_company">深圳前海中商行互联网金融服务有限公司</span>
            <span class="product_info">投资期限短，收益高，稳健无忧，投资理财首选！</span>
            <ul class="info_num">
                <li>
                    <label class="num_em">5.5</label><span class="num_unit">万</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>债权总价值</em>

                </li>
                <li class="info_li">
                    <label class="num_em">80</label><span class="num_unit">%</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>折让率</em>
                </li>
                <li>
                    <label class="num_em">8</label><span class="num_unit">%</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>年收化率</em>
                </li>
            </ul>
            <div class="product_progress">
                <div class="progress">
                    <div class="sum">
                        <div class="current" style="width:50%;"></div>
                    </div>
                    <div class="highly">50%</div>
                </div>
                <span class="progress_info">335，226.4元可投</span>
                <!-- <span class="progress_num">30%</span> -->
            </div>
            <div class="button_wrap">
                <span class="button_infos">剩余期限1个月</span>
                <a class="product_buttons" target="_blank" href="html/art_treasure.html">立即购买</a>
            </div>
        </div>
        <div class="pannel_items">
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="over_btn">
                            <a href="javascript:void(0)">已投满</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="details_btn">
                            <a href="html/art_treasure.html" target="_bank">查看详情</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- E==投资有道 -->
<!-- S==债权转让 -->
<div class="mian_container">
    <div class="content_tittle">
        <span class="content_name">债权转让</span>
        <span class="content_more"><a href="html/creditor.html">进入债权转让频道 ></a></span>
    </div>
    <div class="boxL floor_produce3">
        <p>
            <span class="floor_tittle">转让</span>
            <span class="floor_info">灵活理财 转让无忧</span>
        </p>
        <a href="html/creditor.html">查看更多</a>
    </div>
    <div class="boxR produce3_items">
        <div class="product_panel">
            <span class="product_tittle">虫草酒-藏虫草股份</span>
            <span class="product_company">深圳前海中商行互联网金融服务有限公司</span>
            <span class="product_info">投资期限短，收益高，稳健无忧，投资理财首选！</span>
            <ul class="info_num">
                <li>
                    <label class="num_em">5.5</label><span class="num_unit">万</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>项目规模</em>

                </li>
                <li class="info_li">
                    <label class="num_em">1000</label><span class="num_unit">元</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>起投资金</em>
                </li>
                <li>
                    <label class="num_em">8</label><span class="num_unit">%</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>年收化率</em>
                </li>
            </ul>
            <div class="product_progress">
                <div class="progress">
                    <div class="sum">
                        <div class="current" style="width:60%;"></div>
                    </div>
                    <div class="highly">60%</div>
                </div>
                <span class="progress_info">335，226.4元可投</span>
                <!-- <span class="progress_num">30%</span> -->
            </div>
            <div class="button_wrap">
                <span class="button_infos">剩余期限1个月</span>
                <a class="product_buttons" target="_blank" href="html/creditor_detials.html">立即购买</a>
            </div>


        </div>
        <div class="pannel_items">
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="over_btn">
                            <a href="javascript:void(0)">已投满</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="details_btn">
                            <a href="html/creditor_detials.html" target="_bank">查看详情</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- E==债权转让 -->
<!-- S==私募股权 -->
<div class="mian_container">
    <div class="content_tittle">
        <span class="content_name">私募股权</span>
        <span class="content_more"><a href="html/private_stock.html">进入私募股权频道 ></a></span>
    </div>
    <div class="boxL floor_produce4">
        <p>
            <span class="floor_tittle">私募</span>
            <span class="floor_info">甄选私募 为您定制</span>
        </p>
        <a href="html/private_stock.html">查看更多</a>
    </div>
    <div class="boxR produce4_items">
        <div class="product_panel">
            <span class="product_tittle">虫草酒-藏虫草股份</span>
            <span class="product_company">深圳前海中商行互联网金融服务有限公司</span>
            <span class="product_info">投资期限短，收益高，稳健无忧，投资理财首选！</span>
            <ul class="info_num">
                <li>
                    <label class="num_em">3</label><span class="num_unit">年</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>期限（年）</em>

                </li>
                <li class="info_li">
                    <label class="num_em">医疗健康产业</label><span class="num_unit"></span>
                    <em class="unit_info"><i class="icon unit_bg"></i>投资方向</em>
                </li>
                <li>
                    <label class="num_em">100</label><span class="num_unit">万</span>
                    <em class="unit_info"><i class="icon unit_bg"></i>起投金额</em>
                </li>
            </ul>
            <div class="product_progress">
                <div class="progress">
                    <div class="sum">
                        <div class="current" style="width:80%;"></div>
                    </div>
                    <div class="highly">80%</div>
                </div>
                <span class="progress_info">335，226.4元可投</span>
                <!-- <span class="progress_num">30%</span> -->
            </div>
            <div class="button_wrap">
                <span class="button_infos">剩余期限1个月</span>
                <a class="product_buttons" target="_blank" href="html/private_product.html">立即购买</a>
            </div>
        </div>
        <div class="pannel_items">
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="over_btn">
                            <a href="javascript:void(0)">已投满</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pannel_item">
                <span class="items_tittle">医疗健康产业</span>
                <div class="items_pannel">
                    <div class="attrs">
                        <div class="attr">
                            <span class="subject">投资方向：</span>
                            <span class="content"><span class="text_highlight">12%-14%</span></span>
                        </div>
                        <div class="attr">
                                <span class="subject">剩余期限：1个月 折让率：100%
                                </span>
                        </div>
                        <div class="attr">
                            <span class="subject">债权剩余价值：</span>
                            <span class="content"><span class="text_highlight">60000</span></span>
                        </div>
                    </div>
                    <div class="attrs_bottom">
                        <div class="attr">
                            <span class="subject">中商行与知名金融服务机构联合推出的创新互联网金融服务产品。</span>
                        </div>
                        <div class="details_btn">
                            <a href="html/private_product.html" target="_bank">查看详情</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- E==私募股权 -->
<!-- S==实时资讯 -->
<div class="news_container">
    <div class="content_tittle">
        <span class="content_name">实时资讯</span>
        <span class="content_more"><a href="html/message_dynamic.html">进入实时资讯频道 ></a></span>
    </div>
    <div class="news_wraper">
        <div class="news_bg">
            <span class="news_tittle">公司动态</span>
            <div class="news_pic"></div>
        </div>
        <div class="news_list">
            <span class="list_header">中商行2017年1月份活动公告</span>
            <p class="news_details">不知不觉中元旦的钟声依然敲响, 2017年的车轮伴随着冬日里温暖的阳光如约而至。在...</p>
            <span class="news_items">P2P网络借贷，门槛低，收益高，而P2P网络借贷，门槛低，收益高，而</span>
            <span class="news_items">资金池是P2P行业大忌，监管层已经资金池是P2P行业大忌，资金池是P2P行业大忌，监管层已经资金池是P2P行业大忌，</span>
        </div>
        <div class="company_announce">
            <span class="news_tittle">公司公告</span>
            <div class="announce_wrap">
                <a href=""><span class="announce_lists">1关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">2关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">3关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">4关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">5关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">6关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">7关于厦门银行存管系统升级维护的关于厦门银行存管系统升级维护的</span><span class="announce_dates">2017-03-15</span></a>
                <a href=""><span class="announce_lists">
            </div>
        </div>
    </div>
</div>
<!-- E==实时资讯 -->
<!-- S==合作伙伴 -->
<div class="cooperate_partner">
    <span class="cooperate_tittle">合作伙伴</span>
    <div class="cooperate_link">
        <a href="https://www.baidu.com" target="_blank" class="baiduLink bottom_link"></a>
        <a href="http://www.sina.com.cn/" target="_blank" class="sinaLink bottom_link"></a>
        <a href="http://www.qq.com/" target="_blank" class="QQlink bottom_link"></a>
        <a href="javascript:void(0)" target="_blank" class="guoshiLink bottom_link"></a>
        <a href="http://www.zangchongcao.cn" target="_blank" class="canglink bottom_link"></a>
    </div>
</div>
<!-- E==合作伙伴 -->