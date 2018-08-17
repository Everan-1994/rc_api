<?php

namespace App\Http\Controllers\Api;

class WechatsController extends Controller
{
    public function serve()
    {
        $wechat = \EasyWeChat::officialAccount();

        $response = $wechat->server->serve();
        dd($response);
        return $response;
    }

    public function wxConfig()
    {
        $wechat = \EasyWeChat::officialAccount();

        $config = $wechat->jssdk->buildConfig(["onMenuShareTimeline","onMenuShareAppMessage"], true);

        return $config;
    }

}
