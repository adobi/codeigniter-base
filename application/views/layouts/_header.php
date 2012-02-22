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
      
      <link rel = "stylesheet" href="<?= base_url() ?>css/bootstrap.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>css/bootstrap-responsive.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>css/bootstrap.custom.min.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>css/aristo.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>css/page.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/file-upload/jquery.fileupload-ui.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/colorpicker/farbtastic.css" media="all" />
      <link rel = "stylesheet" href="<?php echo base_url() ?>scripts/plugins/redactor/js/redactor/css/redactor.css" />        
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/fancybox/jquery.fancybox.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/chosen/chosen.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/lionbars/lionbars.css" media="all" />
      <link rel = "stylesheet" href="<?= base_url() ?>scripts/plugins/google-code-prettify/prettify.css" media="all" />
      <!-- 
      <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
       -->
    </head>
    
    <body>    
        	
        <?php if ($this->session->userdata('logged_in')): ?>

            <div class="navbar navbar-fixed-top">
              <div class="navbar-inner" style="height:60px">
                <div class="container-fluid">
                  <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a href="#" class="span1 brand" style="margin-top:10px; margin-right:3px;">
                    <i class="home-icon"></i>
                    <?php //echo SITE_TITLE ?>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
                    </ul>
                    <div class="pull-right">
                        <form action="" class="navbar-search pull-left" style="margin:15px 10px 0 0;">
                          <!-- <input type="text" placeholder="Search" class="search-query span3"> -->
                          <select name="" id="" class="chosen span4">
                            <option>Some item</option>
                            <option>Some item</option>
                            <option>Some item</option>
                            <option>Some item</option>
                          </select>
                        </form>                        
                        <ul class="nav">
                            <li class="divider-vertical"></li>
                            <li><a href="<?php echo base_url() ?>auth/logout" style="font-weight:bold"><i class="power-icon"></i>Logout</a></li>
                        </ul>
                    </div>
    
                  </div><!--/.nav-collapse -->
                </div>
              </div>
            </div>               
        <?php endif ?>    
        <div class="container-fluid" id="container" style="padding-left:0px;">
        	<div class="content row-fluid" style="margin-top:60px;">
        	  <?php if ($this->session->userdata('logged_in')): ?>
          	  <div class="span1 sidebar-navigation-wrapper-left">
          	    <div class="sidebar-nav">
          	      <ul class="nav nav-list left-side-nav">
                    <li class="active"><a href="<?php echo base_url() ?>dashboard"><i class="dashboard-icon"></i>Dashboard</a></li>
          	      </ul>
          	    </div>
          	  </div>
        	  <?php endif ?>
        	  <div class="span8 content-wrapper">
        	    <div class="well">
                
                
