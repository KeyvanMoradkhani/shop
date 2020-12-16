@extends('administrator.layout.masterpage')

@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.css">
@endsection
@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد برند جدید</h3>
                </div>
                <form role="form" action="/administrator/brands" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" name="title" placeholder="عنوان برند ">
                        </div>
                        <div class="form-group">
                            <label for="description">توضیحات برند</label>
                            <textarea type="text" class="form-control" name="description" placeholder="توضیحات برند"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">تصویر برند</label>
                            <input type="hidden" name="photo_id" id="brand-photo">
                            <div class="dropzone" id="dropfile"></div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/admin/dist/js/dropzone.js" type="text/javascript"></script>

    <script>
        var myDropzone = new Dropzone("div#dropfile", {
            url: "{{route('photos.upload')}}",
            addRemoveLinks:true,

            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            sending:function (file,xhr,formData) {
                formData.append('_token' , '{{ csrf_token() }}')
            },
            success:function (file,response) {
                document.getElementById('brand-photo').value=response.photo_id;
            }
        });
    </script>
@endsection
