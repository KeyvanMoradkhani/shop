@extends('frontend.layout.masterpage')

@section('content')
    <div class="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="login.html">حساب کاربری</a></li>
                <li><a href="login.html">ورود</a></li>
            </ul>

            @if(session('success-payment'))
                <div class="alert alert-success">{{ session('success-payment') }}</div>
        @endif
        <!-- Breadcrumb End-->
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">حساب کاربری</h3>
                <div class="list-group">
                    <ul class="list-item">
                        <li><a href="login.html">ورود</a></li>
                        <li><a href="register.html">ثبت نام</a></li>
                        <li><a href="#">فراموشی رمز عبور</a></li>
                        <li><a href="#">حساب کاربری</a></li>
                        <li><a href="#">لیست آدرس ها</a></li>
                        <li><a href="wishlist.html">لیست علاقه مندی</a></li>
                        <li><a href="{{route('profile.order',$user->id)}}">تاریخچه سفارشات</a></li>
                        <li><a href="#">دانلود ها</a></li>
                        <li><a href="#">امتیازات خرید</a></li>
                        <li><a href="#">بازگشت</a></li>
                        <li><a href="#">تراکنش ها</a></li>
                        <li><a href="#">خبرنامه</a></li>
                        <li><a href="#">پرداخت های تکرار شونده</a></li>
                    </ul>
                </div>
            </aside>

            <div id="content" class="col-sm-9">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">لیست محصولات سفارش {{ $order->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <td style="text-align: center">عکس محصول محصول</td>
                                    <td style="text-align: center">نام محصول</td>
                                    <td style="text-align: center">تعداد محصول محصول</td>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($order->products as $product)
                                    <tr>
                                        <td style="text-align: center"><img width="18%" src="{{$product->photos[0]->path}}"></td>
                                        <td style="text-align: center">{{$product->title}}</td>
                                        <td style="text-align: center">{{$product->pivot->qty}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table no-margin">
                                <tbody>
                                <tr>
                                    <td>نام خریدار :{{$order->user->name . ' ' . $order->user->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>آدرس خریدار
                                        :{{$order->user->addresses[0]->province->name . '-' . '-'.$order->user->addresses[0]->city->name. '-'. $order->user->addresses[0]->addresses}}</td>
                                </tr>
                                <tr>
                                    <td>کدپستی خریدار :{{$order->user->addresses[0]->post_code}}</td>
                                </tr>
                                <tr>
                                    <td>شماره تماس خریدار :{{$order->user->phone}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

