<a href="/order/show/{{ $order->id }}">
    <div class="weui-media-box weui-media-box_text">
        <h4 class="weui-media-box__title">

            @if($order->operator_shopkeeper_id)
                接单人：{{ $order->operatorShopkeeper()->first()->name }}
            @else
                待接单
            @endif

        </h4>

        @foreach($order->goods()->getResults() as $good)
            <p class="weui-media-box__desc">{{ $good->name }} {{ $good->count }}</p>
        @endforeach

        <ul class="weui-media-box__info">
            <li class="weui-media-box__info__meta">{{ $order->user_name }}</li>
            <li class="weui-media-box__info__meta">{{ $order->user_address }}</li>
            <li class="weui-media-box__info__meta">下单时间：{{ $order->order_time }}</li>
            <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">{{ $order->user_remark }}</li>
        </ul>
    </div>
</a>