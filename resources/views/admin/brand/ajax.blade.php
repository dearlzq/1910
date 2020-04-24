@foreach($brandList as $v)
    <tr>
        <td>{{$v->b_id}}</td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->b_url}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->b_logo}}" alt="" width="100"></td>
        <td>{{$v->b_intro}}</td>
        <td>
            <a href="{{url('/brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/brand/edit/'.$v->b_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6">
        {{ $brandList->appends(['b_name' => $b_name])->links() }}
    </td>
</tr>
