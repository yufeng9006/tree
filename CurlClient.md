## curl 
curl 为链接通讯各种服务器，各种协议的工具。php中单独整合了libcurl 库封装对象 curl。提供使用。<br>
curl 支持http ftp 等协议。<br>
curl_init 为初始化对话，其中支持设置个各参数 通过 curl_setopt 方法。<br>
curl_setopt 第一个为会话资源变量，第二个参数为需要设置的参数，第三个为值<br>
其中最常用的值为：<br>
    1，CURLOPT_URL， 访问的请求地址，需要正常加上http或者https 字符串，例如：http://curlsss.xxx.com<br>
    2, CURLOPT_POST  是否是http请求信息，如果是get 直接设置好 CURLOPT_URL的值为完整的请求值。<br>
    3, curl 请求的时候因为浏览器测试访问时，默认转义了http中的特殊字符，当我们没有转义特殊字符，会导致服务器请求失败，而且nginx会导致400错误。400 请求无效。<br>
    4, http_build_query 使用转义方法转义防止数据请求错误,同时也需要对 get 中url 进行转义，且开发人员需要留意get中是否包含#字符，会导致数据被截断，特别是传递token时候，如果密文中包含\# 建议post方式交互，且post更安全。<br>
    5, 设置请求时间参数 CURLOPT_TIMEOUT 如果不设置会导致，执行脚本进程僵死，可通过ps aux 命令查看异常进程。<br>
    6, 请求设置后需要执行 curl_exec 执行抓单，释放资源，curl_close. CURLOPT_RETURNTRANSFER true时候说明数据不打印，直接赋值变量<br>
    7, 其中 http 特殊字符 ：（+，空格，/ ? %# & ）不论使用工具进行补单。<br>
`<?php

class CurlClient
{
	public function sendHttpRequest($url,$post=[])
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, http_build_query($url));
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if( !empty($post) ) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);// 平台仅仅支持 30s
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        $output = $data;
        
        return $output;
    }
}
`
