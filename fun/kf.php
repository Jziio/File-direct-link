<?php
upload();
function upload(){
$cookie=$_POST['cookie'];
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$newname=time().'.'.$extension;
$abc=$newname;
move_uploaded_file($_FILES["file"]["tmp_name"], $newname);

$path = $newname;
// $ext = pathinfo($path)['extension'];

$header2[] = 'Accept: */*';
$header2[] = 'Accept-Encoding: gzip, deflate, br';
$header2[] = 'Accept-Language: zh-CN,zh;q=0.9';
$header2[] = 'Access-Control-Allow-Origin-Type *';
$header2[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Mobile Safari/537.36';
$header2[] = 'authorization: TWNvQq5ItvoCE997jg2wupyi/d5pPXdlYiZzPTEwMDAwJnU9MTEwNDgxNzI2NTcwMDQxMDk1NjEmYT02NTUzNjA3NjgmZj01MDMzMTY0OCZwPTI3MTAwMzAwOGU5ZiZvPWxlY3I5aGxobGhnd2YwQDI3MTAuMjcxMDAzMDAmdD0xNjc2OTQ3NzE5Jm49NDE5MDcyMjMyJmU9NDMyMDA=';

$data = array(
    'file' => new CURLFile($path)

);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://vos.v5kf.com/public/upload/');
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
$re = @json_decode($re, true);
echo $re['url'].$extension;
if ($re == null) exit('error');
}
