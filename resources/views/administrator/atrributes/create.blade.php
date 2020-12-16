@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد ویژگی جدید</h3>
                </div>
                <form role="form" action="/administrator/atrributes" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">نام</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان ویزگی">
                        </div>
                        <div class="form-group">
                            <label for="atrributes_type">نوع ویژگی</label>
                            <select class="form-control" name="atrributes_type" style="width: 100%;" aria-hidden="true">
{{--                                <option  @if($atrributes->type == 'select') selected @endif value="select">لیست تکی</option>--}}
{{--                                <option  @if($atrributes->type == 'multiple') selected @endif value="multiple">لیست چندتایی</option>--}}
                                <option   value="select">لیست تکی</option>
                                <option   value="multiple">لیست چندتایی</option>
                            </select>
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
