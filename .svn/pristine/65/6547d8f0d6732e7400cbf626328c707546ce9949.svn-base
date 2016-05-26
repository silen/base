<?php

namespace Org\Util;
class UrlTool {

    private $url = null;
    public function setUrl($url)
    {
        $this->url = $url;
    }


    public function changeParam($key, $val)
    {
        if (!$this->url) {
            import('Org.Util.Tool');
            $tool = new \Tool();
            $this->url = $tool->get_url();
        }
        if (strpos($this->url, '?') === false){
            $this->url = $this->url . '?'.$key . '='. $val;
        } else {
            $this->url = $this->url . '&'.$key . '='. $val;
        }
    }

    public function getNewUrl(){

        return $this->url;
    }

}
