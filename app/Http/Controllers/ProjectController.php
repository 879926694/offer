<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class ProjectController extends Controller {

    /**
     * 项目总结
     */
    public function zongjie() {
        /*
        git
        mysql
        redis
        lumen,laravel框架
        城乡智能购物车(对接城乡的erp系统) : 会员信息,积分信息,销售信息,促销信息,积分写入,订单写入,使用oracle数据库需要安装扩展,调用封装好的存储过程,对接微信支付宝的卡券(商家券,代金券,支付有礼)
        银行卡刷卡支付,需要使用socket拼接8583报文
        支付渠道(对接商户提供的接口,进件,支付),查日志
        做系统(苹果,windows),换固态
        微信支付(v3版本的服务商模式支付,运营工具中的代金券和商家券,v2的参数使用xml格式,v3使用的是json格式),支付宝支付(使用的是ali的sdk)
        oracle,sqlserver
        go语言(支付结果的轮询)
        GD库画小票
        gitlab使用 ：服务器必须达到2G内存，否则会报502


        问题 : 苹果电脑还是windows电脑,框架,语言
         * */
    }

}