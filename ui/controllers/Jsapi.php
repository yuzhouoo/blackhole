<?php
class Jsapi extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function mediajs() {
        $arrParams = $this->input->get(NULL, true);
        if(count($arrParams) != 2 
            || !isset($arrParams['appKey'])
            || !isset($arrParams['adslotId'])) {
            return $this->outJson([], ErrCode::ERR_INVALID_PARAMS);
        }
        $strJs = '';
        $strJs .= "(function(){"."\n";
        $strJs .= "var o = document.getElementsByTagName(\"script\");"."\n";
        $strJs .= "var c = o[o.length-1].parentNode;"."\n";
        $strJs .= "var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;"."\n";
        $strJs .= "ta.src = '//yun.lvehaisen.com/h5/media/media-3.2.1.min.js';"."\n";
        $strJs .= "ta.onload = function() {"."\n";
        $strJs .= "new TuiaMedia({"."\n";
        $strJs .= "container: c,"."\n";
        $strJs .= "appKey: '".$arrParams['appKey']."',"."\n";
        $strJs .= "adslotId: '".$arrParams['adslotId']."'"."\n";
        $strJs .= "});"."\n";
        $strJs .= "};"."\n";
        $strJs .= "var s = document.querySelector('head'); s.appendChild(ta);"."\n";
        $strJs .= "})();"."\n";
        echo $strJs;

    }
}
