@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content" id="app">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">سفارشات</h3>
            </div>
            <!-- /.box-header -->
            {{--            <order-component></order-component>--}}
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>قیمت</th>
                            <th>وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><a href="{{route('orders.list' , $order->id)}}">{{$order->id}}</a></td>
                                <td>{{$order->amount}}</td>
                                @if($order->status == 1)
                                    <td><span class="label label-success ">فعال</span></td>
                                @else
                                    <td><span class="label label-danger ">غیر فعال</span></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}" type="text/javascript"></script>
@endsection
