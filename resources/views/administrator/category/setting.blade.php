@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویژگی های دسته بندی {{$category->name}}</h3>
                </div>
                <form role="form" action="/administrator/categories/{{$category->id}}/setting" method="post">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="parent_category">ویژگی</label>
                            <select class="form-control" name="atrributesGroup[]" style="width: 100%;" aria-hidden="true" multiple>
                                @foreach($atrributesGroup as $atrributeGroup)
                                    <option value="{{$atrributeGroup->id}}" @if(in_array($atrributeGroup->id ,$category->atrributesGroup->pluck('id')->toArray())) selected  @endif >{{$atrributeGroup->title}}</option>
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
