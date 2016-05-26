<?php
return array(
	//'配置项'=>'配置值'
    'LOGIN_URL' => ROOT_HOST . 'index.php?m=mt&c=login',



    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/static/Mt',
        '__IMG__'    => __ROOT__ . '/static/Mt/images',
        '__CSS__'    => __ROOT__ . '/static/Mt/css',
        '__JS__'     => __ROOT__ . '/static/Mt/js',
        '__FOOTER__'     =>  './../App/'.MODULE_NAME.'/View/footer.html',
        '__HEADER__'     =>  './../App/'.MODULE_NAME.'/View/hearder.html',
    ),
);