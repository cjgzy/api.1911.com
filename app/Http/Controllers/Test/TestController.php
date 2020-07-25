<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Token;
use App\Model\User;
use Illuminate\Support\Str;
class TestController extends Controller
{
    //注册
    public function create(Request $request){
        $user_name=$request->post('user_name');
        $user_email=$request->post('user_email');
        $pass1=$request->post('pass1');
        $pass2=$request->post('pass2');

        $pass=password_hash($pass1,PASSWORD_BCRYPT);


        $user_info=[
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'password'=>$pass,
            'user_time'=>time()
        ];
       $uid= User::insertGetId($user_info);
        $response=[
            'error'=>0,
            'msg'=>'ok'
        ];
        return $response;
    }
    //登录
    public function login(Request $request){
        $user_name=$request->post('user_name');
        $pass=$request->post('pass');

        //验证登录信息
       $u= User::where(['user_name'=>$user_name])->first();
       // dd($u);
       // dd($u);
        if($u){
           if(password_verify($pass,$u->password)){
               $token=Str::random(32);
               $expirer_seconds=7200;
               $data=[
                   "token"=>$token,
                   "uid"=>$u->user_id,
                   "expirer_at"=>time()
               ];
               $user_id =  Token::insertGetId($data);
               $response = [
                   "error" => "0",
                   "msg" => "登陆成功",
                   "data"=>[
                       "token"=>$token,
                       "exprier_in" =>$expirer_seconds
                   ]
               ];
          }else{
               $response=[
                   'error'=>500001,
                   'msg'=>'密码错误'
               ];
           }
        }else{
            $response=[
                'error'=>400001,
                'msg'=>'用户不存在'
            ];
        }
        return $response;
    }
    public function center(Request $request)
    {
        $token = $request->get("token");
        if (empty($token)) {
            $response = [
                "errno" => "40003",
                "msg" => "未授权"
            ];
            return $response;
        }
        $t = Token::where(["token"=>$token])->first();
        if(empty($t)){
            $response = [
                "errno" => "40003",
                "msg" => "token无效"
            ];
            return $response;
        }
        $user_info = User::find($t->uid);
        $response = [
            "errno" => 0,
            "msg" => "ok",
            "data"=>[
                "user_info"=> $user_info
            ]
        ];
        return $response;
    }

}
