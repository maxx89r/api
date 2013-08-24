<?php /* Smarty version 2.6.27, created on 2013-08-24 20:53:05
         compiled from forumList.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'tplEchoUrl', 'forumList.html', 8, false),array('modifier', 'escape', 'forumList.html', 21, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body id="vanilla_discussions_index" class="Vanilla Discussions index">
<div id="Frame">
    <div class="Banner">
		<ul>
		  <li><a href="<?php echo smarty_function_tplEchoUrl(array('mainName' => 'MainForum.php','cmd' => 'forumList'), $this);?>
" class="">Forum List</a></li>
		  
		  
		  
		  
		  		</ul>
	 </div>
	 <div id="Body">
		<div id="Content">
		  <ul class="DataList Discussions">
<li class="Item">
      <div class="ItemContent Discussion">
        <?php $_from = $this->_tpl_vars['objsMnEtForum']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oMnEtForum']):
?>
        <div><a href="<?php echo smarty_function_tplEchoUrl(array('mainName' => 'MainTopic.php','cmd' => 'threadList','vName' => 'fid','vValue' => $this->_tpl_vars['oMnEtForum']->forumId->oriValue), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['oMnEtForum']->forumName->oriValue)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></div>
            <?php $_from = $this->_tpl_vars['oMnEtForum']->objsSubMnEtForum; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oSubMnEtForum']):
?>
            <div>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo smarty_function_tplEchoUrl(array('mainName' => 'MainTopic.php','cmd' => 'threadList','vName' => 'fid','vValue' => $this->_tpl_vars['oSubMnEtForum']->forumId->oriValue), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['oSubMnEtForum']->forumName->oriValue)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></div>
            <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?>
   </div>
</li>
</ul>

		</div>
	 </div>
	 <div id="Foot">
		<div class="FootMenu">
        <span><a href="<?php echo $this->_tpl_vars['tapatalkPluginApiConfig']['nativeSitePcModeUrl']; ?>
" class="">Full Site</a></span>
		</div>
		<div>
		  <a href="http://tapatalk.com/"><span>Powered by Tapatalk</span></a>
		</div>
	 </div>
  </div>


</body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "public_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>