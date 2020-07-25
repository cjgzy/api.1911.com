<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{

    /**
     *
     */
    public function rsa1(){
        $data="我爱尼玛";
        $content = file_get_contents(storage_path('keys/pub.key'));
        $pub_key = openssl_get_publickey($content);
        openssl_public_encrypt($data,$enc_data,$pub_key);
        var_dump($enc_data);echo'<hr>';
        //将机密结果到送给对方
        $priv_key = openssl_get_privatekey(file_get_contents(storage_path('keys/priv.key')));
        openssl_private_decrypt($enc_data,$dec_data,$priv_key);
        echo '解密：'.$dec_data;
    }

    public function sign(){
        $data = "I LOVE YOU";
        $key = "1911php";
        $sign_str = md5($data . $key);
        $url = "http://www.1911.com/sign?data=".$data."&sign=".$sign_str;
        echo $url;die;
        $response = file_get_contents($url);
        echo $response;
    }




}
