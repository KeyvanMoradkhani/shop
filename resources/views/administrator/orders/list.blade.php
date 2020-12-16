@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">لیست محصولات سفارش {{ $order->id }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <td style="text-align: center">عکس محصول محصول</td>
                                <td style="text-align: center">نام محصول</td>
                                <td style="text-align: center">تعداد محصول محصول</td>
                            </tr>
                        </thead>
                        <tbody >
                        @foreach($order->products as $product)
                            <tr>
                                <td style="text-align: center"><img width="18%" src="{{$product->photos[0]->path}}"></td>
                                <td style="text-align: center">{{$product->title}}</td>
                                <td style="text-align: center">{{$product->pivot->qty}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table no-margin">
                        <tbody>
                        <tr>
                            <td>نام خریدار :{{$order->user->name . ' ' . $order->user->last_name}}</td>
                        </tr>
                        <tr>
                            <td>آدرس خریدار
                                :{{$order->user->addresses[0]->province->name . '-' . '-'.$order->user->addresses[0]->city->name. '-'. $order->user->addresses[0]->addresses}}</td>
                        </tr>
                        <tr>
                            <td>کدپستی خریدار :{{$order->user->addresses[0]->post_code}}</td>
                        </tr>
                        <tr>
                            <td>شماره تماس خریدار :{{$order->user->phone}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@endsection
