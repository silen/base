<?php

namespace Org\Util;
class Tool {
    public function operationLog()
    {

        echo  'operationLog<br />';
    }


    public function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        /*$parArr = parse_url($relate_url);
        parse_str($parArr['query'], $ss);
        if ($ss['code'])unset($ss['code']);
        if ($ss['state'])unset($ss['state']);
        $parArr['query'] = http_build_query($ss);
        $relate_url = $parArr['path'] . ($parArr['query'] ? ( '?' . $parArr['query']) : '');*/
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }

}
//import('Org.Util.Tool');

//rem by peter 2015/11/11
//$tool = new \Tool();
//$tool->operationLog(unserialize($_COOKIE['user']));