@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">دسته بندی ها</h3>

                <a class="btn btn-app pull-left" href="{{route('brands.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('add_brand'))
                <div class="alert alert-success">{{ session('add_brand') }}</div>
                @elseif(session('delete_brand'))
                <div class="alert alert-danger">{{ session('delete_brand') }}</div>
            @elseif(session('update_brand'))
                <div class="alert alert-success">{{ session('update_brand') }}</div>
        @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عکس</th>
                            <th>عنوان</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td><img src="{{$brand->photo->path}}" width="150px" height="80px"></td>
                                <td>{{$brand->title}}</td>
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('brands.edit',$brand->id)}}"
                                                  class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span>
                                        <form role="form" action="/administrator/brands/{{$brand->id}}"
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
