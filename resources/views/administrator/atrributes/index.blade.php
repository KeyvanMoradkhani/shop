@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">ویژگی ها</h3>

                <a class="btn btn-app pull-left" href="{{route('atrributes.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('update_atrributes'))
                <div class="alert alert-success">{{ session('update_atrributes') }}</div>
                @elseif(session('delete_atrributes'))
                <div class="alert alert-danger">{{ session('delete_atrributes') }}</div>
        @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>نوع</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($atrributes as $atrribute)
                            <tr>
                                <td>{{$atrribute->id}}</td>
                                <td>{{$atrribute->title}}</td>
                                <td>{{$atrribute->type}}</td>
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('atrributes.edit',$atrribute->id)}}" class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span>
                                        <form role="form" action="/administrator/atrributes/{{$atrribute->id}}"
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
