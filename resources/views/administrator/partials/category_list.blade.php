@foreach($categories as $sub_category)
    <tr>
        <td>{{$sub_category->id}}</td>
        <td>{{str_repeat('-----' ,$level)}} {{$sub_category->name}}</td>
        <td>

           <span style="float: right;margin-left: 10px">
            <a type="submit" href="{{route('categories.edit',$sub_category->id)}}"
                    class="btn btn-warning">ویرایش</a>
            </span>

            <span style="float: right;margin-left: 10px">
                <form role="form" action="/administrator/categories/{{$sub_category->id}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </span>
            <span style="float: right;margin-left: 10px">
                  <a type="submit" href="{{route('categories.indexSetting',$sub_category->id)}}"
                     class="btn btn-info">تنظیمات</a>
            </span>
        </td>
    </tr>
    @if(count($sub_category->childrenRecursive)>0)
        @include('administrator.partials.category_list' , ['categories'=> $sub_category->childrenRecursive,'level' => $level+1])
    @endif
@endforeach
