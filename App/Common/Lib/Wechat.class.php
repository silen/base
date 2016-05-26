<?php
namespace Wechat\Lib;
class Wechat {

    static public function wxConfig()
    {
        $wx['appid'] = C('appid');
        $wx['appsecret'] = C('appsecret');
        $wx['encodingaeskey'] = C('encodingaeskey');
        $wx['token'] = C('token');
        $wx['mch_id'] = C('PAY_MCHID');
        $wx['mch_key'] = C('PAY_KEY');
        return $wx;
    }

    /**
     * 微信helper
     * @return \Org\Wechat\Wechat
     */
    static public function wxObject()
    {

        import('Org.Wechat.wechat');
        return new \Org\Wechat\Wechat(self::wxConfig());
    }

    static function online()
    {
        if ($openid = session('openid'))return self::createMemberRelation($openid);
        $userinfo = self::wxObject()->getOauthAccessToken();
        $openid = $userinfo['openid'];
        return self::createMemberRelation($openid);
    }

    static function createEvent($data)
    {
       
        $data['addtime'] = time();
        M("event")->add($data);
    }

    //建立用户上下级关系
    static function createMemberRelation($openid, $storeid = 0, $accessToken = null)
    {
        if (!$openid) return false;

        //数据库中检查openid的用户数据
        $DBMember = M('member')->where(array('openid' => $openid))->find();

        //存在用户数据
        if ($DBMember) {
            return $DBMember;
        } //不存在用户数据
        else {

            $wxHelper = self::wxObject();
            //从微信服务器获取用户数据
            if ($_GET['isN'] != 1) {
                $serverMember = $wxHelper->getUserInfo($openid);
            } else {
                $serverMember = $wxHelper->getOauthUserinfo($accessToken, $openid);
            }

            if (!$serverMember['nickname']) {
                $url = $wxHelper->getOauthRedirect(C('site_url') . "index.php?m=wechat&c=Index&a=doLogin&isN=1");
                redirect($url);
            }

            $serverMember['addtime'] =  time();
            $serverMember['storeid'] = $storeid;
            //$serverMember['nickname'] = preg_replace_callback('/[\xf0-\xf7].{3}/', function($r) { return '';}, $serverMember['nickname']);
            //$serverMember['nickname'] = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $serverMember['nickname']);

            //用户数据写入服务器
            $id = M('member')->add($serverMember);

            return $serverMember;
        }
    }
}