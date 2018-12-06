<?php
class MainController extends BaseController
{
    public function actionIndex()
    {
        $this->url="index";
        $this->title="新建";
    }

    public function actionPb()
    {
        $this->jump("{$this->PB_DOMAIN}/");
    }

    public function actionAccount()
    {
        $this->jump("{$this->PB_DOMAIN}/account/");
    }


    public function actionViewPB()
    {
        $this->url="PasteBin";
        $this->title="详情";

        $pastebin=new Model("pastebin");
        $code=arg("code");
        if(is_null($code)){
            $this->jump("{$this->PB_DOMAIN}/PasteBin/");
        }
        $result=$pastebin->find(["code"=>$code]);
        if(empty($result) || (!is_null($result["expire"]) && strtotime($result["expire"])<strtotime( date("Y-m-d H:i:s")))) {
            $this->jump("{$this->PB_DOMAIN}/PasteBin/");
        }
        $this->result=$result;
    }
}
