@extends('administrator.layout.masterpage')

@section('main-content')
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ویرایش دسته بندی {{$category->name}}</h3>
                </div>
                <form role="form" action="/administrator/categories/{{$category->id}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" value="{{$category->name}}" name="name" placeholder="نام دسته بندی">
                        </div>
                        <div class="form-group">
                            <label for="parent_category">دسته والد</label>
                            <select class="form-control" name="parent_category" style="width: 100%;" aria-hidden="true">
                                <option selected="selected" value="">انتخاب کنید</option>
                                @foreach($categories as $category_data)
                                    <option value="{{$category_data->id}}" @if($category->parent_id == $category_data->id)  selected @endif>{{$category_data->name}}</option>
                                    @if(count($category_data->childrenRecursive)>0)
                                        @include('administrator.partials.category' , ['categories'=> $category_data->childrenRecursive,'level'=>1,'category_select'=>$category])
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">عنوان سئو</label>
                            <input type="text" class="form-control" value="{{$category->meta_title}}" name="meta_title" placeholder="عنوان سئو دسته بندی">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">توضیحات سئو</label>
                            <textarea type="text" class="form-control" name="meta_desc"
                                      placeholder="توضیحات سئو دسته بندی"> {{$category->meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords"> کلمات کلیدی سئو</label>
                            <textarea type="te" class="form-control" name="meta_keywords"
                                      placeholder="کلمات کلیدی سئو دسته بندی"> {{$category->meta_keywords}}</textarea>
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
