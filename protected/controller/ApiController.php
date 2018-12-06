<?php

class ApiController extends BaseController
{
    public function actionVersion()
    {
        $submit_time=date("Y-m-d H:i:s");
        SUCCESS::Catcher("PasteBin General Application Programming Interface", array(
            "name"=>"PGAPI ".$this->version_info["version"],
            "version_info"=>$this->version_info,
            "timestamp"=>$submit_time
        ));
    }

    public function actionTime()
    {
        SUCCESS::Catcher("获取时间成功", array(
            "Y"=>date('Y'),
            "m"=>date('m'),
            "d"=>date('d'),
            "h"=>date('h'),
            "i"=>date('i'),
            "s"=>date('s'),
            "timestamp"=>time()
        ));
    }
}
