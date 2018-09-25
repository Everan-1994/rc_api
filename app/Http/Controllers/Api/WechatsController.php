<?php

namespace App\Http\Controllers\Api;

class WechatsController extends Controller
{
    public function serve()
    {
        $wechat = \EasyWeChat::officialAccount();

        $response = $wechat->server->serve();

        return $response;
    }

    public function wxConfig()
    {
        $wechat = \EasyWeChat::officialAccount();

        $config = $wechat->jssdk->buildConfig(["updateAppMessageShareData","updateTimelineShareData"], false);

        return $config;
    }

}
