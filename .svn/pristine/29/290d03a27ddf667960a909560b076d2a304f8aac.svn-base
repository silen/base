<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Org\Util;
class Setting {

    public function getSystemRule()
    {
        $setting = S('system_rule', '', array('type'=>'file') );
        return $setting ? $setting : $this->doSystemRuleCache();
    }
    public function doSystemRuleCache()
    {
        $table = M('system_rule');

        $setting = $table->find();
        return $this->updateSystemRule($setting);
    }

    public function updateSystemRule($setting)
    {
        S('system_rule',$setting, array('type'=>'file'));
        return $setting;
    }
}