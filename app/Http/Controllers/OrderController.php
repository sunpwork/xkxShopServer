<?php

namespace App\Http\Controllers;

use App\Models\Shopkeeper;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Shop;
use Overtrue\LaravelWeChat\ServiceProvider;
use Webpatser\Uuid\Uuid;

class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
//    public function __construct()
//    {
//        $this->middleware('wechat.oauth',[
//            'except' => ['store']
//        ]);
//    }

    public function store(Request $request)
    {
        $shop = Shop::where('brand_id', $request->json('brand_id'))->firstOrFail();

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

        $app = app('wechat.official_account');
        foreach ($shop->shopkeepers()->getResults() as $shopkeeper) {
            $this->sendNewOrderMessageTo($app, $shopkeeper, $order);
        }
    }

    public function index(int $shop_id)
    {
//        $wxUser = session('wechat.oauth_user.default');
//        Shopkeeper::where('openid',$wxUser->getId())->firstOrFail();

        $shop = Shop::findOrFail($shop_id);
        $orders = $shop->orders()->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('order.index', compact('shop', 'orders'));
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    public function operator(Order $order)
    {
        if($order->operatorShopkeeper()->first())
        {
            session()->flash('warning','该订单已被接单！');
        }else {
//            $wxUser = session('wechat.oauth_user.default');
//            $shopkeeper = Shopkeeper::where('openid', $wxUser->getId())->firstOrFail();
            $shopkeeper = Shopkeeper::find(1);
            $order->operator($shopkeeper);
        }
        return redirect()->back();

    }

    private function sendNewOrderMessageTo($app, Shopkeeper $shopkeeper, Order $order)
    {
        $app->template_message->send([
            'touser' => $shopkeeper->openid,
            'template_id' => 'I4CGfveGSpHkFjZDBd6y5iHVvbcAsbdVez--i3JLiPU',
            'url' => 'http://e8966f0d.ngrok.io' . '/order/indexPending/' . $order->shop_id,
            'data' => [
                'first' => '您好，您有一个新订单',
                'keyword1' => $order->platform_id,
                'keyword2' => $order->order_time,
                'keyword3' => $order->user_name,
                'keyword4' => $order->user_address,
                'remark' => '点击查看详情'
            ],
        ]);
    }
}
