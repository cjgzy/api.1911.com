<?php

namespace App\Http\Controllers\A;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function add(){
        $appid="wx0698605a1ca84bf6";
        $appacer="4f806f9e3a01e61d063e175aaa103ee4";
      $a="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret={$appacer}";

        $b=file_get_contents($a);
        echo $b;

}
}
