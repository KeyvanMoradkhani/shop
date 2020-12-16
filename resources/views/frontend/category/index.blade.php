@extends('frontend.layout.masterpage')
@section('content')
    <div class="container" id="app">
        <product-component :category = "{{$category}}" ></product-component>
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
