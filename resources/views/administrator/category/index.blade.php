@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">دسته بندی ها</h3>

                <a class="btn btn-app pull-left" href="{{route('categories.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('delete_error_category'))
                <div class="alert alert-danger">{{ session('delete_error_category') }}</div>
                @elseif(session('delete_category'))
                <div class="alert alert-success">{{ session('delete_category') }}</div>
            @elseif(session('update_category'))
                <div class="alert alert-success">{{ session('update_category') }}</div>
        @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('categories.edit',$category->id)}}"
                                                  class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span style="float: right;margin-left: 10px">
                                        <form role="form" action="/administrator/categories/{{$category->id}}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </span>

                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('categories.indexSetting',$category->id)}}"
                                             class="btn btn-info">تنظیمات</a>
                                    </span>
                                </td>
                            </tr>
                            @if(count($category->childrenRecursive)>0)
                                @include('administrator.partials.category_list' , ['categories'=> $category->childrenRecursive,'level'=>1])
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@endsection
