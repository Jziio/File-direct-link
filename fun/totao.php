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

$header2[] = 'Referer: http://kf.quicksdk.com/form/formConfig/id/54';
$header2[] = 'Origin: http://kf.quicksdk.com';

$data = array(
    'file' => new CURLFile($path)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://bx-openapi.ynzy-tobacco.com/front/api/v1/common/upload');
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
echo $JsonData['data'];
}
