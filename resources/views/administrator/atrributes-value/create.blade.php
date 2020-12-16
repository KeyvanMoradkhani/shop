@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد مقدار ویژگی جدید</h3>
                </div>
                <form role="form" action="/administrator/atrributes-value" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان مقدار ویژگی">
                        </div>
                        <div class="form-group">
                            <label for="atrributesValue_type">نوع ویژگی</label>
                            <select class="form-control" name="atrributesValue_type" style="width: 100%;" aria-hidden="true">
                                <option   value="">انتخاب ویژگی</option>
                                @foreach($atrributesGroup as $atrributeGroup)
                                    <option   value="{{$atrributeGroup->id}}">{{$atrributeGroup->title}}</option>
                                @endforeach
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
