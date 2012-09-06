<?php

require_once('mobiquoCommon.php');

MbqMain::init();  /* frame init */
MbqMain::input();     /* handle input data */
MbqMain::initAppEnv();    /* application environment init */
@ ob_start();
MbqMain::action();    /* main program handle */
MbqMain::beforeOutput();  /* do something before output */
MbqMain::output();    /* handle output data */

?>