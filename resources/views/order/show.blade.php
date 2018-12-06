@extends('layouts.default')
@section('title','订单详情')

@section('page__hd')
    <div class="page__title">订单详情</div>
@stop

@section('page__bd')
    <div class="weui-panel">
        <div class="weui-panel__hd">订单详情</div>
        <div class="weui-panel__bd">
            <div class="weui-form-preview">
                <div class="weui-form-preview__hd">
                    <div class="weui-form-preview__item">
                        <label class="weui-form-preview__label">
                            @if($order->operator_shopkeeper_id)
                                接单人：{{ $order->operatorShopkeeper()->first()->name }}
                            @else
                                待接单
                            @endif
                        </label>
                    </div>
                </div>
                <div class="weui-form-preview__bd">
                    @foreach($order->goods()->getResults() as $good)
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ $good->name }}</label>
                            <span class="weui-form-preview__value">{{ $good->count }}</span>
                        </div>
                    @endforeach
                    <div class="weui-form-preview__item">
                        <span class="weui-form-preview__value">{{ $order->user_name }}</span>
                    </div>
                    <div class="weui-form-preview__item">
                        <span class="weui-form-preview__value">{{ $order->user_tel }}</span>
                    </div>
                    <div class="weui-form-preview__item">
                        <span class="weui-form-preview__value">{{ $order->user_address }}</span>
                    </div>
                    <div class="weui-form-preview__item">
                        <span class="weui-form-preview__value">下单时间：{{ $order->order_time }}</span>
                    </div>
                    <div class="weui-form-preview__item">
                        <span class="weui-form-preview__value">{{ $order->user_remark }}</span>
                    </div>
                </div>
                @if(!$order->operator_shopkeeper_id)
                    <div class="weui-form-preview__ft">
                        <a href="{{ route('order.operator',$order->id) }}"
                           class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">接单</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop