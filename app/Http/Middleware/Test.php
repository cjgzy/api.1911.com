<?php

namespace App\Http\Middleware;

use Closure;

class Test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断用户传过来的token是否为空
        $token=$request->input('token');
        if (empty($token)){
            $data=[
                'error' => 50001,
                'msg' => '未授权'
            ];
        }else{
            $data=[
                'error' => 0,
                'msg' => 'ok'
            ];
        }
        //判断用户穿过来的token跟数据库里面是否匹配
//        $s= TokenModel::where(['token'=>$token])->find();


        if ($s){
            //如果匹配的话
            session_start();
            $log = 'log.txt';
            if(!$handle = fopen($log,"a+")){ echo '日志文件打开失败'; exit(); }
            if(!fwrite($handle,session_id().chr(13))){ echo '数据写入失败'; exit(); }
            fclose($handle);
            $file = file_get_contents($log);
            $content = explode(chr(13),$file);
            echo "本页被访问次数： <b>".(count($content)-1)." </b>";
        }

    }

}
