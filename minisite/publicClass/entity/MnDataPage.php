<?php

MainApp::$oClk->includeClass('MbqDataPage');

/**
 * data page class
 * 
 * @since  2012-8-12
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnDataPage extends MbqDataPage {
    
    /**
     * init by total
     *
     * @param  Integer  $page  page number
     * @param  Integer  $perpage  per page record number
     * @param  Integer  $total  total record number
     */
    public function initByTotal($page, $perpage, $total) {
        $page = (int) $page;
        $perPage = (int) $perPage;
        $total = (int) $total;
        $this->initByPageAndPerPage($page, $perpage);
        $this->totalNum = $total;
        $this->totalPage = ceil($this->totalNum / $this->numPerPage);
    }
    
    /**
     * echo page
     */
    public function echoPage() {
        if ($this->totalPage > 1) {
            $ret = '<div style="width:100%;text-align:right;">';
            if ($this->curPage == 1) {
                $ret .= 'First';
            } else {
                $ret .= '<a href="'.$this->getPageUrl(1).'">First</a>';
            }
            $ret .= ',';
            if ($this->curPage > 1) {
                $ret .= '<a href="'.$this->getPageUrl($this->curPage - 1).'">Pre</a>';
            } else {
                $ret .= 'Pre';
            }
            $ret .= ',';
            if ($this->curPage < $this->totalPage) {
                $ret .= '<a href="'.$this->getPageUrl($this->curPage + 1).'">Next</a>';
            } else {
                $ret .= 'Next';
            }
            $ret .= ',';
            if ($this->curPage == $this->totalPage) {
                $ret .= 'Last';
            } else {
                $ret .= '<a href="'.$this->getPageUrl($this->totalPage).'">Last</a>';
            }
            $ret .= ',';
            $ret .= "Total $this->totalNum,Page $this->curPage/$this->totalPage";
            $ret .= '</div>';
            echo $ret;
        }
    }
    
    /**
     * 返回指定页面的url
     *
     * @param  Integer  $pg  页码
     */
    public function getPageUrl($pg) {
        $fileName = basename($_SERVER['SCRIPT_NAME']);
        $fileName = ($fileName == 'index.php') ? '' : $fileName;
        return MainApp::$oCf->makeUrl(MPF_C_APPNAME, $fileName, MainApp::$cmd, $this->makePageParamArr(MainApp::$oCf->cv($pg)));
    }
    
    /**
     * 构造分页链接需要的参数数组
     *
     * @param  Integer  $pg  页码
     * @return  返回对应的参数数组
     */
    private function makePageParamArr($pg) {
        $ret = array('page' => $pg);
        foreach ($_GET as $key => $value) {
            if ($key != 'page' && $key != 'cmd') {
                $ret[$key] = $value;
            }
        }
        return $ret;
    }
  
}

?>