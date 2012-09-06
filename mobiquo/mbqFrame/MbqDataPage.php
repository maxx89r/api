<?php

defined('MBQ_IN_IT') or exit;

/**
 * data page class
 * 
 * @since  2012-8-8
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqDataPage {
    
    public $totalNum;   /* total data num */
    public $totalUnreadNum;     /* total unread num */
    public $numPerPage; /* data number per page */
    public $totalPage;  /* total page num */
    public $curPage;    /* current page num */
    public $datas;      /* data array */
    
    public $startNum;
    public $lastNum;
    
    public function __construct() {
        $this->datas = array();
    }
    
    /**
     * init by $curPage and $numPerPage
     *
     * @param  Integer  $curPage
     * @param  Integer  $numPerPage
     */
    public function init($curPage, $numPerPage) {
        $curPage = $curPage ? 1 : $curPage;
        $numPerPage = $numPerPage ? 1 : $numPerPage;
        $startNum = ($curPage - 1) * $numPerPage;
        $lastNum = $curPage * $numPerPage - 1;
        $this->initByStartAndLast($startNum, $lastNum);
    }
    
    /**
     * init by start num and last num
     *
     * @param  Integer  $startNum
     * @param  Integer  $lastNum
     */
    public function initByStartAndLast($startNum, $lastNum) {
        $this->startNum = $startNum;
        $this->lastNum = $lastNum;
        $start = intval($this->startNum);
        $end = intval($this->lastNum);
        $start = empty($start) ? 0 : max($start, 0);
        $end = (empty($end) || $end < $start) ? ($start + 19) : max($end, $start);
        if ($end - $start >= 50) {
            $end = $start + 49;
        }
        $limit = $end - $start + 1;
        $page = intval($start/$limit) + 1;
        $this->startNum = $start;
        $this->numPerPage = $limit;
        $this->curPage = $page;
    }
  
}

?>