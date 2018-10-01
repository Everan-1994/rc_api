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

        $config = $wechat->jssdk->buildConfig(["onMenuShareAppMessage","onMenuShareTimeline"], false);

        return $config;
    }

    public function createMenu()
    {
        $wechat = \EasyWeChat::officialAccount();

        $buttons = [
            [
                "url" => "https://rc-api.lzdu.com/wap",
                "name" => "仁才后台",
                "type" => 'view'
            ]
        ];

        return $wechat->menu->create($buttons);
    }

}
