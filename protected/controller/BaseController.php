<?php

class BaseController extends Controller
{
    public $layout = "layout.html";
    public function init()
    {
        // echo $_SERVER['REQUEST_URI'];
        $this->version_info=array(
            "author"=>"John Zhang",
            "organization"=>"SAST of NJUPT",
            "developer"=>"John Zhang, David Diao",
            "version"=>"1.0.0",
            "subversion"=>"20181207023833",
        );

        $this->title="";
        $this->bg="";
        $this->site="PasteBin";

        // For the convenience of proxy
        $this->PB_DOMAIN=CONFIG::GET("PB_DOMAIN");
        $this->PB_CDN=CONFIG::GET("PB_CDN");
        if (isset($_SERVER["HTTP_PB_DOMAIN"])) {
            $this->PB_DOMAIN=$_SERVER["HTTP_PB_DOMAIN"];
        }
        if (isset($_SERVER["HTTP_PB_STATIC"])) {
            $this->PB_CDN=$_SERVER["HTTP_PB_STATIC"];
        }
        
        if (!session_id()) {
            session_start();
        }

        header("Content-type: text/html; charset=utf-8");
        require(APP_DIR.'/protected/include/functions.php');
        $this->islogin=is_login();
        $this->url="";

        if ($this->islogin) {
            $userinfo=getuserinfo(@$_SESSION['OPENID']);
            if (!is_null($userinfo['real_name']) || $userinfo['real_name']==="null") {
                $display=$userinfo['real_name'];
            } else {
                $display=$userinfo['name'];
            }
            $userinfo['display_name']=$display;
            $this->userinfo=$userinfo;
        }

        $current_hour=date("H");
        if ($current_hour<6) {
            $this->greeting="凌晨了";
        } elseif ($current_hour<11) {
            $this->greeting="早上好";
        } elseif ($current_hour<13) {
            $this->greeting="中午好";
        } elseif ($current_hour<18) {
            $this->greeting="下午好";
        } elseif ($current_hour<22) {
            $this->greeting="晚上好";
        } else {
            $this->greeting="深夜了";
        }
    }

    public function tips($msg, $url)
    {
        $url = "location.href=\"{$url}\";";
        echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");{$url}}</script></head><body onload=\"sptips()\"></body></html>";
        exit;
    }
    public function jump($url, $delay = 0)
    {
        echo "<html><head><meta http-equiv='refresh' content='{$delay};url={$url}'></head><body></body></html>";
        exit;
    }
    
    public static function err404($controller_name, $action_name)
    {
        header("HTTP/1.0 404 Not Found");
        $controlObj = new BaseController;
        $controlObj->display("404/index.html");
        exit;
    }
}
