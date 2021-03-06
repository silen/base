<?php

return array(

    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'base',          // 数据库名
    'DB_USER'               =>  '',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  'app_',    // 数据库表前缀

    'URL_MODEL'          => '0', //URL模式



    'USER_ADMINISTRATOR' => array(1), //管理员用户ID


    'WAP_TITLE' => '网站标题',
    //'WAP_LOGO' => __ROOT__ . '/static/images/logo.jpg',
    'power' => array(
        '1' => '超级管理员',
        '2' => '普通管理员',
    ),
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/static/',
        '__IMG__'    => __ROOT__ . '/static/images/',
        '__CSS__'    => __ROOT__ . '/static/css/',
        '__JS__'     => __ROOT__ . '/static/js/',
        '__FOOTER__'     =>  './../App/'.MODULE_NAME.'/View/footer.html',
        '__HEADER__'     =>  './../App/'.MODULE_NAME.'/View/hearder.html',
    ),

    //不生成目录
    'CHECK_APP_DIR' => false,

    'MODULE_DENY_LIST'      =>  array('Common','Runtime'),
    'DEFAULT_FILTER'        =>  'strip_tags,stripslashes',




    'COOKIE_EXPIRE'         =>  0,    // Cookie有效期
    'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'COOKIE_PREFIX'         =>  '',      // Cookie前缀 避免冲突
    'COOKIE_HTTPONLY'       =>  '',     // Cookie的httponly属性



    'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            =>  '', // 错误定向页面
    'SHOW_ERROR_MSG'        =>  false,    // 显示错误信息
    'TRACE_MAX_RECORD'      =>  100,    // 每个级别的错误信息 最大记录数

    'TMPL_CONTENT_TYPE'     =>  'text/html', // 默认模板输出类型
    'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件

    'DATA_CACHE_TYPE' => 'redis',
    'DATA_CACHE_PREFIX' => 'common:',
    'REDIS_HOST' => '127.0.0.1',
    'REDIS_PORT' => 6379,

    'REDIS_PORT' => 6480,
    'REDIS_HOST' => '192.168.31.12',
    'DB_USER' => 'root',
    'DB_PWD' => '',
);
