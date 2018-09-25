<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class WechatsController extends Controller
{
    public function serve()
    {
        $wechat = \EasyWeChat::officialAccount();

        $response = $wechat->server->serve();

        return $response;
    }

    public function wxConfig(Request $request)
    {
        $wechat = \EasyWeChat::officialAccount();

        $wechat->jssdk->setUrl(urlencode($request->url));

        $config = $wechat->jssdk->buildConfig(["onMenuShareTimeline","onMenuShareAppMessage"], false);

        return $config;
    }

}
