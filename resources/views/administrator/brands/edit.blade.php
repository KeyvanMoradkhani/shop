@extends('administrator.layout.masterpage')

@section('styles')
    <link rel="stylesheet" href="/admin/dist/css/dropzone.css">
@endsection

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش برند {{$brand->title}}</h3>
                </div>
                <form role="form" action="/administrator/brands/{{$brand->id}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">تصویر</label>
                            <img src="{{$brand->photo->path}}" width="150px" height="80px">                        </div>
                        <div class="form-group">
                            <label for="name">عنوان</label>
                            <input type="text" class="form-control" value="{{$brand->title}}" name="title" placeholder="نام برند">
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات برند</label>
                            <textarea type="text" class="form-control" name="description" placeholder="توضیحات برند">{{$brand->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">تصویر برند</label>
                            <input type="hidden" name="photo_id" id="brand-photo" value="{{$brand->photo_id}}">
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
