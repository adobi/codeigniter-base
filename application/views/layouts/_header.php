<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" style="overflow: hidden_">
    <head>
    	<title><?php echo SITE_TITLE ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->        
        
        <link rel = "stylesheet" href="<?= base_url() ?>css/bootstrap2.min.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>css/aristo.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>css/page.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/file-upload/jquery.fileupload-ui.css" media="all" />
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/colorpicker/farbtastic.css" media="all" />
        
        <script src = "http://code.jquery.com/jquery-1.7.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.js"></script>

        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-dropdown.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-tab.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-transition.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-alert.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-modal.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-twipsy.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-popover.js"></script>
        <script src = "<?php echo base_url() ?>scripts/plugins/bootstrap-alert.js"></script>
        
    	<script src="<?php echo base_url() ?>scripts/plugins/redactor/js/redactor/redactor.js"></script>
    	<link rel="stylesheet" href="<?php echo base_url() ?>scripts/plugins/redactor/js/redactor/css/redactor.css" />        
    
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/fancybox/jquery.fancybox.css" media="all" />
    	<script src="<?php echo base_url() ?>scripts/plugins/fancybox/jquery.fancybox.pack.js"></script>
    	
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/chosen/chosen.css" media="all" />
    	<script src="<?php echo base_url() ?>scripts/plugins/chosen/chosen.jquery.min.js"></script>
        
        <script src = "http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
        <script src="<?php echo base_url(); ?>scripts/plugins/file-upload/jquery.iframe-transport.js"></script>
        <script src="<?php echo base_url(); ?>scripts/plugins/file-upload/jquery.fileupload.js"></script>
        <script src="<?php echo base_url(); ?>scripts/plugins/file-upload/jquery.fileupload-ui.js"></script>    	    
        <script src="<?php echo base_url(); ?>scripts/plugins/scroll/jquery.scrollTo-min.js"></script>  
    
        <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/google-code-prettify/prettify.css" media="all" />
    	<script src="<?php echo base_url() ?>scripts/plugins/google-code-prettify/prettify.js"></script>    	
    	
    	<script src="<?php echo base_url() ?>scripts/plugins/charcounter/jquery.charcounter.js"></script>    	
    	
    </head>
    
    <body>    
        
    <div id="fb-root"></div>	
    
    <?php if ($this->session->userdata('logged_in')): ?>
        <div class="navbar navbar-fixed">
          <div class="navbar-inner">
            <div class="container">
              <a href="<?php echo  base_url() ?>" class="brand"><?php echo SITE_TITLE ?></a>
              <ul class="nav">
                  <li class="active"><a href="#">Dashboard</a></li>
              </ul>
              <div class="pull-right">
                  <ul class="nav">
                      <li><a href="<?php echo base_url() ?>auth/logout" style="font-weight:bold"><i class="w off-w"></i>Logout</a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>    
    <?php endif ?>    
    <div class="container" id="top">
    	<div class="content" style="margin-top:70px;">

                
