@foreach($goodsInfo as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->goods_no}}</td>
        <td>{{$v->goods_num}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" alt="" width="100"></td>
        <td>
            @if($v->goods_imgs)
                @php $goods_imgs = explode('|',$v->goods_imgs) @endphp
                @foreach($goods_imgs as $vv)
                    <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="100" alt="">
                @endforeach
            @endif
        </td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->cate_name}}</td>
        <td>{{$v->is_show == '1' ?'是':'否'}}</td>
        <td>{{$v->is_new == '1' ?'是':'否'}}</td>
        <td>{{$v->is_best == '1' ?'是':'否'}}</td>
        <td>{{$v->goods_intro}}</td>
        <td>
            <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="11">
        {{ $goodsInfo->appends($query)->links() }}
    </td>
</tr>
