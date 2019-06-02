<?php
function encode64($str='', $pwdStr = 'csff'){
    $strArr = str_split($str);
    $strNew = '';
    foreach($strArr as $k=>$v){
        if(strlen($pwdStr) == $k){
            $strNew .= $v.$pwdStr;
        }else{
            $strNew .= $v;
        }
    }
    $encode_str = str_replace(['+','/','='],['&','%','('],base64_encode($strNew));
    return $encode_str;
}

echo $encodeStr = encode64('gaojun');
echo "\n\r";
echo decode64($encodeStr);
function decode64($str='', $pwdStr = 'csff'){
    $encode_str = str_replace(['&','%','('],['+','/','='],$str);
    $encode_str = base64_decode($encode_str);
    $encode_str = str_replace($pwdStr,'',$encode_str,strlen($pwdStr));
    return $encode_str;
}
