@extends('frontend.layout.masterpage')
@section('content')
    <div class="container">
        <!-- Breadcrumb Start-->
        @if(session('warning-order'))
            <div class="alert alert-warning">{{ session('warning-order') }}</div>
        @elseif(session('danger-payment'))
            <div class="alert alert-danger">{{ session('danger-payment') }}</div>
        @endif

        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="cart.html">سبد خرید</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">سبد خرید</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center">تصویر</td>
                            <td class="text-left">نام محصول</td>
                            <td class="text-left">کد محصول</td>
                            <td class="text-left">تعداد</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">کل</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if($cart)
                            @foreach($cart->items as $product)
                                <tr>
                                    <td class="text-center" width="9%"><a href="#"><img
                                                src="{{$product['item']->photos[0]->path}}"
                                                class="img-thumbnail"/></a></td>
                                    <td class="text-left"><a href="#">{{$product['item']->title}}</a><br/>
                                    <td class="text-left">{{$product['item']->sku}}</td>
                                    <td class="text-left">
                                        <div class="input-group btn-block quantity">
                                            <input type="text" name="quantity" value="{{$product['qty']}}" size="1"
                                                   class="form-control"/>
                                            <span class="input-group-btn">
                                            <a type="submit"
                                               href="{{route('add.cart' ,['id' => $product['item']->id])}}"
                                               data-toggle="tooltip" title="اضافه کردن" class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <button type="button" data-toggle="tooltip" title="کم کردن"
                                                    class="btn btn-danger" onclick="event.preventDefault();
                                                document.getElementById('remove_item_{{$product['item']->id}}' ).submit();">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                            <form id="remove_item_{{$product['item']->id}}"
                                                  action="{{ route('remove.cart',['id' => $product['item']->id]) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-right">{{$product['item']->discount_price ? $product['item']->discount_price : $product['item']->price}}
                                        تومان
                                    </td>
                                    <td class="text-right">{{$product['price']}} تومان</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">استفاده از کوپن تخفیف</h4>
                            </div>
                            <div id="collapse-coupon" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form action="{{ route('add.coupon') }}" method="POST">
                                        @csrf
                                        <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در
                                            اینجا
                                            وارد کنید</label>
                                        <div class="input-group">
                                            <input type="text" name="code" value=""
                                                   placeholder="کد تخفیف خود را در اینجا وارد کنید" id="input-coupon"
                                                   class="form-control"/>
                                            <span class="input-group-btn">
                                          <input type="submit" value="اعمال کوپن" id="button-coupon"
                                                 data-loading-text="بارگذاری ..."
                                                 class="btn btn-primary"/>
                                        </span>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="text-right"><strong>جمع کل</strong></td>
                            <td class="text-right">{{Session::has('cart') ?Session::get('cart')->totalPurePrice : 0 }}
                                تومان
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>کسر هدیه</strong></td>
                            <td class="text-right">{{Session::has('cart') ?Session::get('cart')->totalDisCountPrice : 0 }}
                                تومان
                            </td>
                        </tr>
                        @if(Auth::check() && Session::get('cart') && Session::get('cart')->coupon)
                            <tr>
                                <td class="text-right">
                                    <strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                <td class="text-right">{{ Session::get('cart')->CouponDisCountPrice }}
                                    تومان
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-right"><strong>قابل پرداخت</strong></td>
                            <td class="text-right">{{Session::has('cart') ?Session::get('cart')->totalPrice : 0 }}
                                تومان
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="buttons">
                <div class="pull-left"><a href="{{ route('index') }}" class="btn btn-default">ادامه خرید</a></div>
                <div class="pull-right"><a href="{{ route('orders.user') }}" class="btn btn-primary">تسویه حساب</a>
                </div>
            </div>
        </div>
        <!--Middle Part End -->
    </div>
    </div>
@endsection
