<?php 

    // var_dump();

    // convert
    $str="123.9abc";   
    $num2=(int)$str;
    $int=intval($str);     //转换后数值：123   
    $float=floatval($str); //转换后数值：123.9   
    $str=strval($float);   //转换后字符串："123.9"  

    // json

    json_encode();
    

    $mobile = $_GET["mobile"];
    $mobiles = $_POST["mobiles"];

    $requestTime = date("YmdHis",time());
    $sign = md5("string");

    $ip    = get_ipaddress();
    $appSource = getDeviceOS();

    // http get
    $url  = "http://open.shanlinbao.com/openservice/registersms";
    list($return_code, $return_content) = http_get($url); 

    // http post and response json data
    $url  = "http://open.shanlinbao.com/openservice/registersms";  
    $data = json_encode(array(
        "mobile"      => $mobile,
        "utid"        => $utid,
        "channelNo"   => $channelNo,
        "requestTime" => $requestTime,
        "sign"        => $sign
    ));
    list($return_code, $return_content) = http_post($url, $data, "json"); 


    // ip address
    function get_ipaddress()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }else{
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        return $ip;
    }

    /**
     * 获取设备操作系统
     * @return string
     */
    function getDeviceOS()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(strpos($agent, 'windows nt')) {
            $platform = 'windows';
        } elseif(strpos($agent, 'macintosh')) {
            $platform = 'mac';
        } elseif(strpos($agent, 'ipod')) {
            $platform = 'ipod';
        } elseif(strpos($agent, 'ipad')) {
            $platform = 'ipad';
        } elseif(strpos($agent, 'iphone')) {
            $platform = 'iphone';
        } elseif (strpos($agent, 'android')) {
            $platform = 'android';
        } elseif(strpos($agent, 'unix')) {
            $platform = 'unix';
        } elseif(strpos($agent, 'linux')) {
            $platform = 'linux';
        } else {
            $platform = 'other';
        }

        return $platform;
    }

    /**
      * curl post请求 
      *
      * @param string $url  请求的url
      * @param string $post_data  请求的数据
      * @param string $data_tyoe 数据类型("json")
      * @return mixed
      */
    function http_post($url, $post_data, $data_type) {  
      
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        if($data_type == "json")
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
                'Content-Type: application/json; charset=utf-8',  
                'Content-Length: ' . strlen($post_data))  
            );
        }else
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
                'Content-Type: application/x-www-form-urlencoded; charset=utf-8',  
                'Content-Length: ' . strlen($post_data))  
            );
        }

        $return_content = curl_exec($ch);  
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

        return array($return_code, $return_content);  
    }

    /**
      * curl get请求 
      *
      * @param string $url  请求的url
      * @return mixed
      */
    function http_get($url)
    {
        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        $return_content = curl_exec($ch);  
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

        return array($return_code, $return_content);  
    }

 ?>