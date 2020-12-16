@extends('frontend.layout.masterpage')

@section('content')
    <div class="container">
        @if(session('add_user'))
            <div class="alert alert-danger">{{ session('add_user') }}</div>
        @endif
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a><i class="fa fa-home"></i></a></li>
                <li><a>حساب کاربری</a></li>
                <li><a>ورود</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <h1 class="title">حساب کاربری ورود</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="subtitle">مشتری جدید</h2>
                            <p><strong>ثبت نام حساب کاربری</strong></p>
                            <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی
                                سفارشات خود را مشاهده کنید.</p>
                            <a href="{{route('register')}}" class="btn btn-primary">ادامه</a></div>
                        <div class="col-sm-6">
                            <h2 class="subtitle">مشتری قبلی</h2>
                            <p><strong>من از قبل مشتری شما هستم</strong></p>
                            <form method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label" for="input-email">آدرس ایمیل</label>
                                    <input type="text" name="email" value="" placeholder="آدرس ایمیل" id="input-email"
                                           class="form-control"/>

                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-password">رمز عبور</label>
                                    <input type="password" name="password" value="" placeholder="رمز عبور"
                                           id="input-password" class="form-control"/>

                                    @if($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <br/>
                                </div>
                                <input type="submit" value="ورود" class="btn btn-primary"/>
                            </form>

                        </div>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection
