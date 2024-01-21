<?php
namespace App\Core;

class Response
{
    //Chuyển hướng
    public function redirect($uri ='') {
        if(preg_match('~^(http|https)~is', $uri)) {
            $url = $uri;
        }else {
            $url = _WEB_ROOT.'/'. $uri;
        }

        header("Location: ".$url);
        exit;
    }
}