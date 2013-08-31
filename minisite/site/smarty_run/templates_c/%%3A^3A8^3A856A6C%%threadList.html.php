<?php /* Smarty version 2.6.27, created on 2013-08-31 06:12:17
         compiled from threadList.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'tplEchoUrl', 'threadList.html', 8, false),array('modifier', 'escape', 'threadList.html', 23, false),array('modifier', 'date_format', 'threadList.html', 27, false),)), $this); ?>
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
" class="">All Forums</a></li>
		  
		  
		  
		  		</ul>
	 </div>
	 <div id="Body">
		<div id="Content">
		  <ul class="DataList Discussions">
		    <?php $_from = $this->_tpl_vars['data']['topics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oMnEtForumTopic']):
?>
<li class="Item">
      <?php if ($this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser->iconUrl->hasSetOriValue()): ?>
      <a title="<?php echo $this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser->getDisplayName(); ?>
" href="#" class="ProfileLink"><img src="<?php echo $this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser->iconUrl->oriValue; ?>
" alt="<?php echo $this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser->getDisplayName(); ?>
" class="ProfilePhotoMedium" /></a>
      <?php endif; ?>
      <div class="ItemContent Discussion">
      <a href="<?php echo smarty_function_tplEchoUrl(array('mainName' => 'MainTopic.php','cmd' => 'getThread','vName' => 'tid','vValue' => $this->_tpl_vars['oMnEtForumTopic']->topicId->oriValue), $this);?>
" class="Title"><?php echo ((is_array($_tmp=$this->_tpl_vars['oMnEtForumTopic']->topicTitle->oriValue)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>            <div class="Meta">
        <?php if ($this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser): ?>
         <span class="Author"><?php echo ((is_array($_tmp=$this->_tpl_vars['oMnEtForumTopic']->oAuthorMnEtUser->userName->oriValue)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
        <?php endif; ?> 
         <span class="Counts"><?php echo $this->_tpl_vars['oMnEtForumTopic']->totalPostNum->oriValue; ?>
</span><span class="LastCommentDate"><?php echo ((is_array($_tmp=$this->_tpl_vars['oMnEtForumTopic']->postTime->oriValue)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
      </div>
   </div>
</li>
		    <?php endforeach; endif; unset($_from); ?>
</ul>
		</div>
<?php echo $this->_tpl_vars['data']['oMnDataPage']->echoPage(); ?>

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