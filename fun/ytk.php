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
$header2[]='Cookie: tpv__uid=1676970903; checkStr=ces.9ku.cc%2C4348f6b5bf96d77760fb; PHPSESSID=a0d0vqjmc7n2i65phas511qfn1; topview_admin_id=lXy0nQnWn_p9; topview_admin_user=D7WCA%2FrmE6S6CfqhBnFl; topview_admin_pass=UahsW9HVriE6DUXcc9OUoUz75LZ8_tryjhbo1xtgZJWc62RQRGznDQ; topview_admin_login=uIXklE%2Fj5suCv63Ki2ik4_zZ5oLr0Y5_qQ4nd1o8hmdsHpUudIBz2Q';
$header2[] = 'Referer: http://kf.quicksdk.com/form/formConfig/id/54';
$header2[] = 'Origin: http://kf.quicksdk.com';

$data = array(
    'imgFile' => new CURLFile($path)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ces.9ku.cc/admin.php/upload/editor?dir=video');
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
echo 'http://ces.9ku.cc/'.$JsonData['url'];
}
