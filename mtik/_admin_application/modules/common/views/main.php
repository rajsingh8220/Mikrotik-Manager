
<!DOCTYPE html>
<html lang="en">
<head>
       
        <title>Websurfer MikroTik</title>
       
        <link id="bs-css" href="<?php echo base_url();?>css/my.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
         
          body {
                padding-bottom: 40px;
          }
          .sidebar-nav {
                padding: 9px 0;
          }
          .menu2 {
}

.menu2 ul {
	list-style-type:none;
	margin:0;
	padding:0;
	background:#F3F3F5;
    border-bottom: 1px solid #dddddd;

	
}

.menu2 ul li {
	float:left;
	padding:10px 0px;
	background:;
    border-right: 1px solid #dddddd;
}

.menu2 ul li.first {

}

.menu2 ul li a {

	font-size:13px;
	padding:11px 20px;
	text-decoration: none;
	
}



.menu2 ul li:hover {
	background:#DDDDDD;
}
        </style>
          
        <link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>css/charisma-app.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>css/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" type="text/css" />
        <link href='<?php echo base_url();?>css/chosen.css' rel='stylesheet' type="text/css" />
        <link href='<?php echo base_url();?>css/uniform.default.css' rel='stylesheet' type="text/css" />
        <link href='<?php echo base_url();?>css/colorbox.css' rel='stylesheet' type="text/css" />
        <link href='<?php echo base_url();?>css/opa-icons.css' rel='stylesheet' type="text/css" />
        <link href='<?php echo base_url();?>css/jquery.iphone.toggle.css' rel='stylesheet' />
        
        
        <script src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>        
        <script src="<?php echo base_url();?>js/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-transition.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-alert.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-modal.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-dropdown.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap-button.js"></script>
        <script src="<?php echo base_url();?>js/timepicker.js"></script>
        <script src='<?php echo base_url();?>js/jquery.dataTables.js'></script>
       
        
        <script src="<?php echo base_url();?>js/jquery.chosen.min.js"></script>
        <script src="<?php echo base_url();?>js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>js/jquery.watermarkinput.js"></script>
        <script src="<?php echo base_url();?>js/jquery.iphone.toggle.js"></script>
        <script src="<?php echo base_url();?>js/charisma.js"></script>
        
         
        
            <script src="<?php echo base_url();?>assets/treeview/jquery.cookie.js"></script>
           
            
            
            
        <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.gif" />

</head>

	

<body onload="load()" style="background: url('<?php echo base_url(); ?>images/background.png') repeat; font-size: 12px;">

      <center>
      <div style="text-align: left; width: 1100px; border: 1px #D7D7D7 solid; background: white;">       <!-- topbar starts -->
        <div class="navbar">
                <div class="navbar-inner">
                        <div class="container-fluid">
                                <a  class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </a>
                                <a style="width: 300px; margin-left: -40px;" class="brand" href="<?php echo base_url(); ?>"> 
                                    <!--
                                    <img alt="Charisma Logo" src="images/logo.png" />
                                    -->
                                     <span style="">Bandwidth Manager</span>
                                </a>

                                <!-- theme selector starts -->
                                <!--
<a style="float: right; position: relative; top:8px; cursor: pointer; left: 15px;" id="toggle-fullscreen" class="visible-desktop" data-toggle="button"><img src="<?php echo base_url(); ?>images/expand.png" /></a>
-->
                                <div class="btn-group pull-right theme-container" >
                                        
                                                                           
                                        <!--
<a class="btn "  href="#" style="width: 250px; margin: 0px; margin-right: -25px; text-align: left; margin-left: 0px;">
                                                <i class="icon-tint"></i> <span id="flash_msg" class="hidden-phone"><?php echo " ".ucwords(substr($fls_msg,0,35)); ?></span>
                                        </a>
-->
                                        <!--
                                        <ul class="dropdown-menu" id="themes">
                                                <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                                                <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                                                <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                                                <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                                        </ul>
                                        -->
                                </div>
                                 
                                <!-- theme selector ends -->

                                <!-- user dropdown starts -->
                                <div class="btn-group pull-right" >
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="icon-user"></i><span class="hidden-phone"> <?php echo ucwords($this->session->userdata('login_name'));?></span>
                                                <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                                <li><a href="">Home</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                                        </ul>
                                </div>
                                <!-- user dropdown ends -->

                                <div class="top-nav nav-collapse">
                                        <ul class="nav">
                                              
                                                <!--
<li style="border-left: 1px solid #DB610F;">
                                                        <form class="navbar-search pull-left" action="http://www.google.com/search" method="get" target="_blank">
                                                                
                                                                <input placeholder="Google Search" class="search-query span2" id="search_key" name="query" type="text" />
                                                        </form>
                                                </li>
-->
                                        </ul>
                                </div><!--/.nav-collapse -->
                        </div>
                </div>
        </div>
        <!-- topbar ends -->
                <div style="width: 1055px; margin-top: -5px;" class="container-fluid">
                <div style="width: 1055px;" class="row-fluid">

                        <!-- left menu starts -->
                        <?php $this->load->view('left_menu');?>
                        <!-- left menu ends -->

                        
                        
                        
                        
                        
                        

                        <div id="content" class="span10">
                        <!-- content starts -->

                                <h4 style="margin-left: -10px;"><?php echo $title; ?></h4>
                                <div class="row-fluid" style="width: 890px; margin-left: -10px; min-height: 220px;" id="before_search">
                                      <div class="box span12">
                                                    <div class="menu2">
                                                    <?php $this->load->view($submenu);?>
                                                    </div>
                                            <div class="box-content" style="min-height: 300px;">
                                                
                                            <?php $this->load->view($template);?>
                                            </div>
                                    </div>
                                </div>
                                
                                
                               
                                            
                                
                        <!-- content ends -->
                        </div><!--/#content.span10-->
                        
                        
                        
                </div><!--/fluid-row-->
                
                <hr />
                <?php $this->load->view('footer');?>
                

        </div>
</div>   
</center>

        
</body>

</html>