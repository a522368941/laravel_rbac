<?php 
if (! function_exists('__get_ip')) {
    function __get_ip()
    {
        static $realip = NULL;

        if ($realip !== NULL) {
            return $realip;
        }
        if (getenv("HTTP_X_REAL_IP") && strcasecmp(getenv("HTTP_X_REAL_IP"), "unknown")) {
            $realip = getenv("HTTP_X_REAL_IP");
        } else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $realip = getenv("REMOTE_ADDR");
        } else if (isset ($_SERVER ['REMOTE_ADDR']) && $_SERVER ['REMOTE_ADDR'] && strcasecmp($_SERVER ['REMOTE_ADDR'], "unknown")) {
            $realip = $_SERVER ['REMOTE_ADDR'];
        } else {
            $realip = "";
        }
        $realip = !empty ($realip) ? $realip : '0.0.0.0';

        return $realip;
    }
}





 ?>