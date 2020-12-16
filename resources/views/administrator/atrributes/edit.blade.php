@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش ویژگی {{$atrribute->title}}</h3>
                </div>
                <form role="form" action="/administrator/atrributes/{{$atrribute->id}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان ویژگی</label>
                            <input type="text" class="form-control" value="{{$atrribute->title}}" name="title" placeholder="نام دسته بندی">
                        </div>
                        <div class="form-group">
                            <label for="atrributes_type">دسته والد</label>
                            <select class="form-control" name="atrributes_type" style="width: 100%;" aria-hidden="true">
                                <option  @if($atrribute->type == 'select') selected @endif value="select">لیست تکی</option>
                                <option  @if($atrribute->type == 'multiple') selected @endif value="multiple">لیست چندتایی</option>
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
