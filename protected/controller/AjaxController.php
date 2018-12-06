<?php
class AjaxController extends BaseController
{

    public function actionGeneratePasteBin()
    {
        if ($this->islogin) {
            $OPENID=$_SESSION['OPENID'];
        } else {
            ERR::Catcher(2001);
        }

        $detail=getuserinfo($OPENID);
        $aval_lang=["plaintext","json","bat","coffeescript","c","cpp","csharp","csp","css","dockerfile","fsharp","go","handlebars","html","ini","java","javascript","less","lua","markdown","msdax","mysql","objective-c","pgsql","php","postiats","powerquery","powershell","pug","python","r","razor","redis","redshift","ruby","rust","sb","scss","sol","sql","st","swift","typescript","vb","xml","yaml","scheme","clojure","shell","perl","azcli","apex"];


        if (!is_null(arg("lang")) && !is_null(arg("expire")) && !is_null(arg("content"))) {
            $lang=arg("lang");
            $expire=intval(arg("expire"));
            $content=arg("content");
            $display_author=is_null(arg("display_author"))?$detail["name"]:arg("display_author");

            if(!in_array($lang,$aval_lang)){
                ERR::Catcher(1004);
            }

            if($expire==0){
                $expire_time=null;
            }elseif($expire==1){
                $expire_time=date('Y-m-d', strtotime('+1 days'));
            }elseif($expire==7){
                $expire_time=date('Y-m-d', strtotime('+7 days'));
            }elseif($expire==30){
                $expire_time=date('Y-m-d', strtotime('+30 days'));
            }else{
                ERR::Catcher(1004);
            }

            if(strlen($content)>=102400){
                ERR::Catcher(1006);
            }

            $pastebin=new Model("pastebin");

            $code=generateRandStr(6);
            $ret=$pastebin->find(["code"=>$code]);
            if(empty($ret)){
                $pbid=$pastebin->create([
                    "lang"=>$lang,
                    "expire"=>$expire_time,
                    "uid"=>$detail["uid"],
                    "display_author"=>$display_author,
                    "content"=>$content,
                    "code"=>$code
                ]);
                SUCCESS::Catcher("创建成功",["code"=>$code]);
            }else{
                ERR::Catcher(1000);
            }

        } else {
            ERR::Catcher(1003);
        }
    }
    
}
