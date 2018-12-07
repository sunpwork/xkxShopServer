<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopkeeperController extends Controller
{

    /**
     * ShopkeeperController constructor.
     */
    public function __construct()
    {
        $this->middleware('wechat.oauth');
    }

    public function getWxUserInfo()
    {
        dd(session('wechat.oauth_user.default')->getId());
    }
}
