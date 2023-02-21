<?php
upload();
function upload(){
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$newname=time().'.'.$extension;
move_uploaded_file($_FILES["file"]["tmp_name"], $newname);

$path = $newname;
// $ext = pathinfo($path)['extension'];

$header2[] = 'Accept: */*';
$header2[] = 'Accept-Encoding: gzip, deflate, br';
$header2[] = 'Accept-Language: zh-CN,zh;q=0.9';
$header2[] = 'Access-Control-Allow-Origin-Type *';
$header2[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Mobile Safari/537.36';
// 去官网获取cookie 就可以了 https://kf.quicksdk.com/
$header2[] = 'Cookie:usid=0e2d854f1b349da3d6acee91f0af71c2; __guid=089dbfd0-88f7-11ed-9666-6c92bf398206; lf=1; sensorsdata2015jssdkcross=%7B%22distinct_id%22%3A%224066386%22%2C%22first_id%22%3A%2218567c184fc50d-0b90f618dcd02c-26021151-2073600-18567c184fddb3%22%2C%22props%22%3A%7B%22%24latest_traffic_source_type%22%3A%22%E7%9B%B4%E6%8E%A5%E6%B5%81%E9%87%8F%22%2C%22%24latest_search_keyword%22%3A%22%E6%9C%AA%E5%8F%96%E5%88%B0%E5%80%BC_%E7%9B%B4%E6%8E%A5%E6%89%93%E5%BC%80%22%2C%22%24latest_referrer%22%3A%22%22%7D%2C%22%24device_id%22%3A%2218567c184fc50d-0b90f618dcd02c-26021151-2073600-18567c184fddb3%22%7D; __DC_gid=196757375.927226092.1672483013996.1672483063298.3; z_api_request_time=0.0032250881195068; __gid=108660102.121499980.1672483064044.1676950426467.30';
$header2[] = 'Referer: http://kf.quicksdk.com/form/formConfig/id/54';
$header2[] = 'Origin: http://kf.quicksdk.com';

$data = array(
    'file' => new CURLFile($path)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://user.btime.com/uploadHead');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header2);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$re = curl_exec($ch);
curl_close($ch);
unlink($newname);
$JsonData= @json_decode($re, true);
echo $JsonData['data']['img_arr']['img'];
}
