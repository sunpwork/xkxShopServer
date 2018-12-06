@extends('layouts.default')
@section('title','订单列表')

@section('page__hd')
    <div class="page__title">订单列表</div>
@stop

@section('page__bd')
    <div class="weui-panel">
        <div class="weui-panel__hd">{{ $shop->name }}</div>
        <div class="weui-panel__bd">
            @if($orders->count())
                @foreach($orders as $order)
                    @include('order._order')
                @endforeach
            @else
                <div class="weui-loadmore weui-loadmore_line">
                    <span class="weui-loadmore__tips">暂无数据</span>
                </div>
            @endif
        </div>
    </div>
    {!! $orders->render() !!}
@stop