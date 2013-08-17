<?php if (!defined('APPLICATION')) exit();
 
$PluginInfo['TapatalkMiniSiteDemo'] = array(
   'Name' => 'TapatalkMiniSiteDemo',
   'Description' => 'TapatalkMiniSiteDemo for Vanilla 2',
   'Version' => '0.0.1',
   'Author' => "Tapatalk",
   'AuthorEmail' => 'admin@tapatalk.com',
   'AuthorUrl' => 'http://tapatalk.com',
   'MobileFriendly' => true
);

class TapatalkMiniSiteDemoPlugin extends Gdn_Plugin {
    
    public function Base_Render_Before($Sender) {
        if (defined('MBQ_IN_IT')) return;   //filter mobiquo folder
        if (($_REQUEST['p'] && strpos($_REQUEST['p'], '/dashboard') === 0) || $Sender->MasterView == 'admin') { //filter the backend page
            return;
        }
        $isSsl = false;
        if($_SERVER['HTTPS'] === 1){  //Apache
            $isSsl = true;
        }elseif($_SERVER['HTTPS'] === 'on'){ //IIS
            $isSsl = true;
        }elseif($_SERVER['SERVER_PORT'] == 443){ //other
            $isSsl = true;
        }
        $protocol = $isSsl ? 'https' : 'http';
        $phpSelf = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $base = $protocol.'://'.$_SERVER['SERVER_NAME'].preg_replace('/index\.php.*/i', '', $phpSelf);
        if (IsMobile()) {
            $url = $base.'miniSite/site/';
            $controllerName = strtolower(property_exists($Sender, 'ControllerName') ? $Sender->ControllerName : '');
            $methodName = property_exists($Sender, 'RequestMethod') ? $Sender->RequestMethod : '';
            $params = property_exists($Sender, 'RequestArgs') ? $Sender->RequestArgs : array();
            if ($controllerName == 'discussionscontroller' && $methodName == 'index') { //all discussions,backend home page setting
                $url .= "MainForum.php";
            } elseif ($controllerName == 'categoriescontroller' && $methodName == 'all') {   //all categories,backend home page setting
                $url .= "MainForum.php";
            } elseif ($controllerName == 'categoriescontroller' && $methodName == 'discussions') {   //categories & discussions,backend home page setting
                $url .= "MainForum.php";
            } elseif ($controllerName == 'activitycontroller' && $methodName == 'index') {   //activity,backend home page setting
                $url .= "MainForum.php";
            } elseif ($controllerName == 'discussionscontroller' && $methodName == 'Index' && property_exists($Sender, 'CategoryID') && $Sender->CategoryID && property_exists($Sender, 'Category') && $Sender->Category) {   //get discussions of a category
                $url .= "MainTopic.php?cmd=threadList&fid=$Sender->CategoryID";
            } elseif ($controllerName == 'discussioncontroller' && $methodName == 'Index' && property_exists($Sender, 'DiscussionID') && $Sender->DiscussionID && property_exists($Sender, 'Discussion') && $Sender->Discussion) {   //get thread
                $url .= "MainTopic.php?cmd=getThread&tid=$Sender->DiscussionID";
            } else {
                $url = '';
            }
            if ($url) {
                header( "HTTP/1.1 301 Moved Permanently" ) ;
                header("Location:$url");
            }
        }
    }

	public function Setup() {
	}
	
}

?>