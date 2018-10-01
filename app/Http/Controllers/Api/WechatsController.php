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

        $wechat->jssdk->setUrl($request->url);

        $config = $wechat->jssdk->buildConfig(["updateAppMessageShareData","updateTimelineShareData"], false);

        return $config;
    }

}
