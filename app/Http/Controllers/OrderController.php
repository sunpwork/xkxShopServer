<?php

namespace App\Http\Controllers;

use App\Models\Shopkeeper;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Shop;
use Webpatser\Uuid\Uuid;

class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('wechat.oauth',[
            'except' => ['store']
        ]);
    }

    public function store(Request $request)
    {
        try {
            $shop = Shop::where('brand_id', $request->json('brand_id'))->firstOrFail();
        } catch (\Exception $exception) {
            return ['errorCode' => -1, 'errorMsg' => 'no shop'];
        }
        $shopOrders = $shop->orders();
        $order = $shopOrders->create([
            'id' => Uuid::generate(),
            'shop_id' => $shop->id,
            'platform_id' => $request->json('platform_id'),
            'order_time' => $request->json('order_time'),
            'user_name' => $request->json('user_name'),
            'user_tel' => $request->json('user_tel'),
            'user_address' => $request->json('user_address'),
            'user_remark' => $request->json('user_remark')
        ]);
        $orderGoods = $order->goods();
        foreach ($request->json('goodsList') as $good) {
            $orderGoods->create([
                'id' => UUID::generate(),
                'name' => $good['name'],
                'price' => $good['price'],
                'count' => $good['count']
            ]);
        }
    }

    public function index(int $brand_id)
    {
        $user = session('wechat.oauth_user.default');

        Shopkeeper::where('openid',$user->getId())->firstOrFail();

        dd($user->getName());
    }
}
