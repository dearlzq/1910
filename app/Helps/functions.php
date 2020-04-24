<?php
//无限极分类
function GetcateInfor($res , $pid = 0 , $level = 1)
{
    //使用静态数组，避免递归调用时，多次调用导致覆盖，
    static $infor = [];
    //第一次遍历，找到父节点为根节点的id ，也就是pid 等于0 的节点
    foreach($res as $k=>$v){
        if($v['pid'] == $pid) {
            //父级为根节点的id ，级别为0 ，也就是第一级的，
            $v['level'] = $level;
            //把数组放到infor 中
            $infor[] = $v;
            //开始递归，查找父id 为该节点的id,级别为原级别加1
            GetcateInfor($res , $v['cate_id'] , $v['level'] + 1);
        }
    }
    //返回最后内容并输出
    return $infor;
}
//文件上传
function upload($filename)
{
    //上传过程是否有错，
    if (request()->file($filename)->isValid()){
        //接收上传
        $file = request()->$filename;
        //实现上传
        $path =$file->store('uploads');
        return $path;

    }
    exit('文件上传出错');

}
//多文件上传
function moreupload($filename)
{
    $file = request()->$filename;
    if(!is_array($file)) {
        return;
    }
    foreach ($file as $k=>$v) {
        //实现上传
        $path[$k] = $v->store('uploads');
    }
    return $path;
    exit('上传文件出错');
}
//封装调用
function showMsg($code,$msg) {
$data = [
    'code' =>$code,
    'msg' =>$msg
];
echo json_encode($data);die;
}


