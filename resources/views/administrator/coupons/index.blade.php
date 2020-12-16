@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">کد تخفیف ها</h3>

                <a class="btn btn-app pull-left" href="{{route('coupons.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>
            @if(session('add_coupon'))
                <div class="alert alert-success">{{ session('add_coupon') }}</div>
            @elseif(session('delete_coupon'))
                <div class="alert alert-danger">{{ session('delete_coupon') }}</div>
            @elseif(session('update_coupon'))
                <div class="alert alert-success">{{ session('update_coupon') }}</div>
        @endif
        <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>کد تخفیف</th>
                            <th>قیمت تخفیف</th>
                            <th>وضعیف</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->title}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->price}}</td>
                                @if($coupon->status === 0)
                                    <td><a class="btn btn-danger">غیر فعال </a></td>
                                @else
                                    <td><a class="btn btn-success"> فعال </a></td>
                                @endif
                                <td>
                                    <span style="float: right;margin-left: 10px">
                                          <a type="submit" href="{{route('coupons.edit',$coupon->id)}}"
                                             class="btn btn-warning">ویرایش</a>
                                    </span>

                                    <span>
                                        <form role="form" action="/administrator/coupons/{{$coupon->id}}"
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
