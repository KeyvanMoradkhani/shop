@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">محصولات</h3>

                <a class="btn btn-app pull-left" href="{{route('products.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('add_product'))
                <div class="alert alert-success">{{ session('add_product') }}</div>
            @elseif(session('delete_product'))
                <div class="alert alert-danger">{{ session('delete_product') }}</div>
            @elseif(session('update_product'))
                <div class="alert alert-success">{{ session('update_product') }}</div>
            @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>کد محصول</th>
                            {{-- <th>عکس</th> --}}
                            <th>عنوان</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->sku}}</td>
                                {{-- <td><img src="{{$product->photo->path}}" width="150px" height="80px"></td> --}}
                                <td>{{$product->title}}</td>
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('products.edit',$product->id)}}"
                                             class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span>
                                        <form role="form" action="/administrator/products/{{$product->id}}"
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
                    <div class="row" style="text-align: center">
                        {{ $products->links() }}
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@endsection
