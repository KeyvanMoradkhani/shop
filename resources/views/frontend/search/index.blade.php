@extends('frontend.layout.masterpage')
@section('content')
    <div class="container" id="app">
{{--        <div class="row products-category">--}}
{{--            نتیجه جستجو:  {{$searchtext}}--}}

{{--        @foreach($products as $product)--}}
{{--                <div class="product-layout product-list col-xs-12">--}}
{{--                    <div class="product-thumb clearfix">--}}
{{--                        <div class="image">--}}
{{--                            <a href="{{ route('single.product' , ['slug' => $product->slug]) }}">--}}
{{--                                <img width="50%"--}}
{{--                                     src="{{$product->photos[0]->path}}" alt="تی شرت کتان مردانه"--}}
{{--                                     title="{{$product->title}}" class="img-responsive"/>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="caption">--}}
{{--                            <h4><a>{{$product->title}}</a></h4>--}}
{{--                            <p>--}}
{{--                                {!! $product->description !!}--}}
{{--                            </p>--}}
{{--                            <p class="price">--}}
{{--                                @if($product->discount_price)--}}
{{--                                    <span class="price-new">{{$product->discount_price}} تومان</span>--}}
{{--                                    <span class="price-old">{{$product->price}} تومان</span>--}}
{{--                                    <span class="saving">{{round(($product->price-$product->discount_price)/$product->price *100)}}%</span>--}}
{{--                                @else--}}
{{--                                    <span class="price-new">{{$product->price}} تومان</span>--}}
{{--                                @endif--}}

{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="button-group">--}}
{{--                            <a class="btn-primary" type="button"--}}
{{--                               href="{{route('add.cart' ,['id' => $product->id])}}"><span>افزودن به سبد</span>--}}
{{--                            </a>--}}
{{--                            <div class="add-to-links">--}}
{{--                                <button type="button" data-toggle="tooltip" title="" onclick=""--}}
{{--                                        data-original-title="افزودن به علاقه مندی ها"><i class="fa fa-heart"></i> <span>افزودن به علاقه مندی ها</span>--}}
{{--                                </button>--}}
{{--                                <button type="button" data-toggle="tooltip" title="" onclick=""--}}
{{--                                        data-original-title="مقایسه این محصول"><i class="fa fa-exchange"></i> <span>مقایسه این محصول</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
        <search-component v-bind:search = "'{{ $search }}'" ></search-component>
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
