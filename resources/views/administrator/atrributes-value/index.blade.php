@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">مقدار ویژگی ها</h3>

                <a class="btn btn-app pull-left" href="{{route('atrributes-value.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('update_atrributesValue'))
                <div class="alert alert-success">{{ session('update_atrributesValue') }}</div>
                @elseif(session('delete_atrributesValue'))
                <div class="alert alert-danger">{{ session('delete_atrributesValue') }}</div>
        @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>ویژگی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($atrributesValue as $atrributevalue)
                            <tr>
                                <td>{{$atrributevalue->id}}</td>
                                <td>{{$atrributevalue->title}}</td>
                                <td>{{$atrributevalue->atrributeGroup->title}}</td>
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('atrributes-value.edit',$atrributevalue->id)}}" class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span>
                                        <form role="form" action="/administrator/atrributes-value/{{$atrributevalue->id}}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@endsection
