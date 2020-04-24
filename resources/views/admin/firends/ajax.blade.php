@foreach($firendsInfo as $v)

    <tr>
        <td>{{$v->f_id}}</td>
        <td>{{$v->f_name}}</td>
        <td>{{$v->f_url}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->f_img}}" alt="" width="100"></td>
        <td>{{$v->f_status == '1'?'LOGO链接' :'文字链接'}}</td>
        <td>{{$v->f_pre}}</td>
        <td>{{$v->f_intro}}</td>
        <td>{{$v->f_show == '1'?'是' :'否'}}</td>
        <td>
            <a href="javascript:void (0)" id="del" data_id="{{$v->f_id}}" class="btn btn-danger">删除</a>
            <a href="{{url('/firends/edit/'.$v->f_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="9">
        {{$firendsInfo->links()}}
    </td>
</tr>
