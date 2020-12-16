@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد برند جدید</h3>
                </div>
                <form role="form" action="/administrator/coupons" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان کد تخفیف را وارد کنید... ">
                        </div>
                        <div class="form-group">
                            <label for="code">کد تخفیف</label>
                            <input type="text" class="form-control" name="code" placeholder="کد را وارد کنید...">
                        </div>
                        <div class="form-group">
                            <label for="price">قیمت تخفیف</label>
                            <input type="number" class="form-control" name="price" placeholder="قیمت را وارد کنید...">
                        </div>
                        <div class="form-group">
                            <label for="status">وضعیت </label>
                            <div>
                                <input type="radio"  name="status" value="0" checked>
                                <label for="status">منتشر نشده</label>
                                <input type="radio"  name="status" value="1">
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

