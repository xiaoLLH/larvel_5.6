<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qiniu\Auth;

class QiniuController extends Controller
{
        public function index(){
            $upload_name = "1.jpg";
            $expires = 3600;
            // 用于签名的公钥和私钥
            $accessKey = '9iLorBJtMoPen_eSeFY5_imWQplQJvEUxplGRy_g';
            $secretKey = 'NWqzP5IYFJ2lTh4y03bp9KC7Rjtsh04';
            $bucket = "novel-api";
            $policy = array(
                "scope"=>"{$bucket}:{$upload_name}",
                "deadline"=>time() + $expires,
            );
            // 初始化签权对象
            $auth = new Auth($accessKey, $secretKey);
            $upToken = $auth->uploadToken($bucket, $upload_name, $expires, $policy, true);
            var_dump($upToken);exit;
        }
}
