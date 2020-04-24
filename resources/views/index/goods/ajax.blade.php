@foreach($goodsInfo as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->goods_no}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" alt="" width="100"></td>
        <td>{{$v->is_show == '1' ?'是':'否'}}</td>
        <td>sh</td>
    </tr>
@endforeach
<tr>
    <td colspan="7">
        {{ $goodsInfo->links() }}
    </td>
</tr>
