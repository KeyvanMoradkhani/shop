@extends('administrator.layout.masterpage')

@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.css">
@endsection
@section('main-content')
    <div class="content" id="app" style="min-height: 1500px !important;">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد محصول جدید</h3>
                </div>
                <form role="form" action="/administrator/products" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان محصول ">
                        </div>
                        <div class="form-group">
                            <label for="slug">نام مستعار محصول</label>
                            <input type="text" class="form-control" name="slug" placeholder="نام مستعار محصول ">
                        </div>
                        <div class="form-group">
                            <label for="status">وضعیت محصول</label>
                            <div>
                                <input type="radio"  name="status" value="0" checked>
                                <label for="status">منتشر نشده</label>
                                <input type="radio"  name="status" value="1">
                                <label for="status">منتشر شده</label>
                            </div>
                        </div>
                        <attribute-component :brands="{{$brands}}"></attribute-component>
                        <div class="form-group">
                            <label for="price">قیمت محصول</label>
                            <input type="number" class="form-control" name="price" placeholder="قیمت محصول ">
                        </div>
                        <div class="form-group">
                            <label for="discount_price">قیمت ویژه محصول</label>
                            <input type="number" class="form-control" name="discount_price" placeholder="قیمت ویژه محصول ">
                        </div>
                        <div class="form-group">
                            <label for="description">توضیحات محصول</label>
                            <textarea id="textAreaDescription" type="text" class="ckeditor form-control" name="description" placeholder="توضیحات محصول"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="photo_id">گالری تصاویر</label>
                            <input type="hidden" name="photo_id[]" id="product-photo">
                            <div class="dropzone" id="dropfile"></div>
                        </div>

                        <div class="form-group">
                            <label for="meta_title">عنوان سئو</label>
                            <input type="text" class="form-control" name="meta_title" placeholder="عنوان سئو محصول">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">توضیحات سئو</label>
                            <textarea type="text" class="form-control" name="meta_desc" placeholder="توضیحات سئو محصول"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords"> کلمات کلیدی سئو</label>
                            <textarea type="te" class="form-control" name="meta_keywords"
                                      placeholder="کلمات کلیدی سئو محصول"></textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" onclick="onClickGallery()" class="btn btn-primary pull-left">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
@section('scripts')
    <script src="/admin/dist/js/dropzone.js" type="text/javascript"></script>
    <script src="/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script>
        Dropzone.autoDiscover =  false;
        var photoGallery =[];
        var myDropzone = new Dropzone("div#dropfile", {
            url: "{{route('photos.upload')}}",
            addRemoveLinks:true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            sending:function (file,xhr,formData) {
                formData.append('_token' , '{{ csrf_token() }}')
            },
            success:function (file,response) {
                photoGallery.push(response.photo_id);
            }
        });

        onClickGallery = function(){
            document.getElementById('product-photo').value=photoGallery;
        }

        CKEDITOR.replace( 'textAreaDescription' );
    </script>
@endsection

