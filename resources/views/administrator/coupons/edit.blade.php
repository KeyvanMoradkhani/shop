@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش کد تخفیف {{$coupon->title}}</h3>
                </div>
                <form role="form" action="/administrator/coupons/{{$coupon->id}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">عنوان</label>
                            <input type="text" class="form-control" value="{{$coupon->title}}" name="title" placeholder="عنوان کد تخفیف را وارد کنید...">
                        </div>

                        <div class="form-group">
                            <label for="description">کد تخفیف</label>
                            <input type="text" class="form-control" value="{{$coupon->code}}" name="code" placeholder="کد تخفیف را وارد کنید...">
                        </div>

                        <div class="form-group">
                            <label for="price">قیمت تخفیف</label>
                            <input type="number" class="form-control" value="{{$coupon->price}}" name="price" placeholder="قیمت را وارد کنید...">
                        </div>
                        <div class="form-group">
                            <label for="status">وضعیت</label>
                            <div>
                                <input type="radio"  name="status" value="0" @if($coupon->status === 0) checked @endif>
                                <label for="status">منتشر نشده</label>
                                <input type="radio"  name="status" value="1" @if($coupon->status === 1) checked @endif>
                                <label for="status">منتشر شده</label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
