<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$row = $this->Csz_admin_model->load_config();
/**
 * Main file for Template.
 * Don't change the file name
 */
?>
<?php echo doctype('html5') ?>
<html lang="<?php echo $row->admin_lang ?>">
    <head>
        <meta http-equiv="refresh" content="3660"/>
        <?php echo $meta_tags ?>
        <?php echo link_tag('templates/admin/favicon.ico', 'shortcut icon', 'image/ico'); ?>
        <title><?php echo $title ?></title>
        <!-- Bootstrap Core CSS -->
        <?php echo $core_css ?>
        <!-- Theme style -->
        <?php echo link_tag('templates/admin/css/AdminLTE.min.css') ?>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <?php echo link_tag('templates/admin/css/skins/_all-skins.min.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php if($this->session->userdata('user_admin_id') && $this->session->userdata('admin_email') && $this->session->userdata('admin_logged_in')){ ?>
            <?php $users = $this->Csz_admin_model->getUser($this->session->userdata('user_admin_id')); /* Get admin user information */
            ($users->picture) ? $user_img = base_url() . 'photo/profile/' . $users->picture : $user_img = base_url() . 'photo/no_image.png'; ?>
            <div class="wrapper">
                <!-- Start topbar -->
                <header class="main-header">
                    <!-- Logo -->
                    <a class="logo" href="<?php echo $this->Csz_model->base_link().'/admin'; ?>">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>AU</b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b><?php echo $this->lang->line('backend_system'); ?></b></span>                        
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->
                                <?php $unread = $this->Csz_auth_model->count_unread_pms(); ?>
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo $user_img; ?>" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?php echo $users->name; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="<?php echo $user_img; ?>" class="img-circle" alt="User Image">
                                            <p>
                                                <b><?php echo $users->name; ?></b>
                                                <?php $user_group = $this->Csz_auth_model->get_groups_fromuser($users->user_admin_id); ?>
                                                <small><em><?php echo $this->lang->line('user_group_txt'); ?>: <?php echo ($user_group !== FALSE) ? ucfirst($user_group->name) : '-'; ?></em></small>
                                            </p>
                                        </li>
                                        <!-- Menu Body -->
                                        <!--<li class="user-body">
                                            <div class="row">
                                                <div class="col-xs-12 text-center"></div>
                                            </div>
                                        </li>-->
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo $this->Csz_model->base_link(); ?>/admin/users/edit/<?php echo $this->session->userdata('user_admin_id'); ?>" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> <?php echo $this->lang->line('user_edit_header'); ?></a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo $this->Csz_model->base_link(); ?>/admin/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out text-red"></i> <?php echo $this->lang->line('nav_logout'); ?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- End topbar -->               
                <!-- Start Left side menu -->
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">
                        <!-- Sidebar user panel -->
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="<?php echo $user_img; ?>" class="img-circle" alt="User Image">
                            </div>
                            <div class="pull-left info">
                                <p><b><?php echo $users->name; ?></b></p>
                                <a href="<?php echo $this->Csz_model->base_link(); ?>/admin/users/edit/<?php echo $this->session->userdata('user_admin_id'); ?>"><i class="fa fa-edit"></i> <b><?php echo $this->lang->line('user_edit_header'); ?></b></a>
                            </div>
                        </div>
                        <!-- sidebar menu: : style can be found in sidebar.less -->
                        <ul class="sidebar-menu">
                            <li class="header"><?php echo str_replace('Backend System | ', '', $title); ?></li>
                            <?php echo  $this->Headfoot_html->admin_leftmenu($cur_page) ?>
                        <li><a href="<?php echo $this->Csz_model->base_link(); ?>/admin/banner"><i class="fa fa-arrow-circle-o-right"></i> <span>Banner</span></a></li>
			</ul>
                    </section>
                    <!-- /.sidebar -->
                </aside>
                <!-- End Left side menu -->
                
                <!-- Start Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <div class="container-fluid test">
                        <?php if($this->session->flashdata('error_message') != ''){ ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- Main content -->
                        <?php echo $content; ?>
                        <!-- /.content -->
                        <br><br>
                    </div>
                </div>
                <!-- End Content Wrapper. Contains page content -->

                <!-- Start Footer -->
                <?php echo  $this->Headfoot_html->admin_footer() ?>
                <!-- End Footer -->
                
                <div class="footer" style="position:absolute;bottom:0;right:2%;transform:translateY(-100%);">
                    <div class="row col-md-12 text-center">
                        <a href="#top" title="To Top" style="text-decoration:none;">
                            <span class="h2"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </a>
                    </div>
                </div>
                
                <!-- Start Control Sidebar For Theme Settings -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Create the tabs -->
                    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-copyright"></i></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <!-- Settings tab content -->
                        <div class="tab-pane" id="control-sidebar-home-tab">
                            <h2 class="control-sidebar-heading">AdminLTE Template 2.3.7</h2>
                            <p>
                                <b>MIT License</b><br>
                                <em>Copyright &copy; 2014-<?php echo date('Y') ?> <a href="http://almsaeedstudio.com" target="_blank" rel="nofollow external">Almsaeed Studio</a>. All rights reserved.</em>
                            </p>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </aside>
                <!-- End Control Sidebar For Theme Settings -->
                
                <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
                <div class="control-sidebar-bg"></div>
            </div>
            <!-- ./wrapper -->
        <?php }else{ ?>
            <!-- Start For Content -->
            <?php echo $content; ?>
            <!-- End For Content -->
            <br><br><br>
            <?php echo $this->Headfoot_html->admin_footer() ?>
        <?php } ?>
		<style>
		.main-footer{
			position: relative;
			width: 100%;
			bottom: 0;
			margin: 0;
		}
		.main-footer .row{
		    text-align: center;
			margin: 0 auto;
			display: table;
		}
		.div-copyright{
			width:auto;
		}
		</style>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo $core_js ?>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>templates/admin/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>templates/admin/js/demo.js"></script>
        <!-- Custom Plugin JavaScript -->
        <script src="<?php echo base_url() ?>templates/admin/js/script.js"></script>  
        <script type="text/javascript">
            $(function(){tinymce.init({selector:".body-tinymce",height:"500px",content_css:["<?php echo base_url(); ?>assets/css/bootstrap.min.css","<?php echo base_url(); ?>templates/<?php echo $row->themes_config; ?>/css/<?php echo $row->themes_config; ?>.min.css","<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css"],remove_trailing_brs:!1,convert_urls:!1,plugins:"advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code codesample fullscreen insertdatetime media nonbreaking table contextmenu directionality emoticons paste textcolor colorpicker imagetools glyphicons b_button jumbotron row_cols boots_panels boot_alert form_insert fontawesome cszfile",external_filemanager_path:"<?php echo $this->Csz_model->base_link(); ?>/admin/",relative_urls:!1,toolbar1:"insertfile undo redo | styleselect fontselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage codesample",toolbar2:"forecolor backcolor emoticons glyphicons fontawesome | b_button jumbotron row_cols boots_panels boot_alert form_insert",image_advtab:!0,image_class_list:[{title:"None",value:""},{title:"Responsive",value:"img-responsive"},{title:"Rounded & Responsive",value:"img-responsive img-rounded"},{title:"Circle & Responsive",value:"img-responsive img-circle"},{title:"Thumbnail & Responsive",value:"img-responsive img-thumbnail"}],style_formats:[{title:"Text",items:[{title:"Muted text",inline:"span",classes:"text-muted"},{title:"Primary text",inline:"span",classes:"text-primary"},{title:"Success text",inline:"span",classes:"text-success"},{title:"Info text",inline:"span",classes:"text-info"},{title:"Warning text",inline:"span",classes:"text-warning"},{title:"Danger text",inline:"span",classes:"text-danger"},{title:"Badges",inline:"span",classes:"badge"}]},{title:"Label",items:[{title:"Default Label",inline:"span",classes:"label label-default"},{title:"Primary Label",inline:"span",classes:"label label-primary"},{title:"Success Label",inline:"span",classes:"label label-success"},{title:"Info Label",inline:"span",classes:"label label-info"},{title:"Warning Label",inline:"span",classes:"label label-warning"},{title:"Danger Label",inline:"span",classes:"label label-danger"}]},{title:"Headers",items:[{title:"h1",block:"h1"},{title:"h2",block:"h2"},{title:"h3",block:"h3"},{title:"h4",block:"h4"},{title:"h5",block:"h5"},{title:"h6",block:"h6"}]},{title:"Blocks",items:[{title:"p",block:"p"},{title:"div",block:"div"},{title:"pre",block:"pre"}]},{title:"Containers",items:[{title:"section",block:"section",wrapper:!0,merge_siblings:!1},{title:"article",block:"article",wrapper:!0,merge_siblings:!1},{title:"blockquote",block:"blockquote",wrapper:!0},{title:"hgroup",block:"hgroup",wrapper:!0},{title:"aside",block:"aside",wrapper:!0},{title:"figure",block:"figure",wrapper:!0}]}]})});
        </script>
        <!-- Load Extra JavaScript -->
        <?php if(!empty($extra_js)){ 
        echo $extra_js;
        } ?>
    </body>
</html>
