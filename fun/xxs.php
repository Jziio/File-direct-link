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
$header2[] = 'Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2';
$header2[] = 'Connection:close';
$header2[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/110.0';
// 去官网获取cookie 就可以了 https://kf.quicksdk.com/
$header2[]='Cookie: waf_sc=5889647726; googleplugin=6DGaSjrXC2T3jtiM';
$header2[]='Referer: https://pic.markyuns.cn/';
$header2[] = 'Origin: https://pic.markyuns.cn';
$header2[]='Host:pic.markyuns.cn';
$data = array(
    'file' => new CURLFile($path)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://pic.markyuns.cn/upimg.php');
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
echo $JsonData;
}
