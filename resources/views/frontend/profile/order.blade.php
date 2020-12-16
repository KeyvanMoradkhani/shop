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
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>قیمت</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{route('profile.order.list' , $order->id)}}">{{$order->id}}</a></td>
                                    <td>{{$order->amount}}</td>
                                    @if($order->status == 1)
                                        <td><span class="label label-success ">پرداخت شده</span></td>
                                    @else
                                        <td><span class="label label-danger ">پرداخت نشده</span></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>

        </div>
    </div>
@endsection
