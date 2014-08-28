<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>eBlogBD.com | Rocking Blogs</title>
        <!--<style type="text/css">
                copied to layout_style.css	
        </style>-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default/default.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bar/bar.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dark/dark.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/light/light.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/nivo-slider.css" type="text/css" media="screen" />

        <script type="text/javascript" src="<?php echo base_url(); ?>js/all/jquery-1.9.0.min.js"></script><!--for all -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/tab/jquery-ui-1.9.2.custom.js"></script><!--for tab-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/my_js_code.js"></script>

        <link href="<?php echo base_url(); ?>css/layout_style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/menu_style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/sidebar_content.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/form_controls.css" type="text/css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>css/jquery-ui-1.9.2.custom.css" type="text/css" rel="stylesheet" /><!--for jQuery Tab-->
        <script>
                $(function() {
                    $("#tab").tabs();
                });
        </script>
    </head>

    <body>
        <div id="main">
            <div id="header">		
            </div>
            <div id="menubar">
                <div class="menu">             
                    <ul>                 
                        <li><?php echo anchor('', 'Home'); ?></li>                 
                        <li><?php echo anchor('bloger_controller/get_all_blogs', 'Blog'); ?></li>                 
                        <li><?php echo anchor('project_controller/index', 'Projects'); ?></li> 
                        <li><?php echo anchor('bloger_controller/downloads', 'Downloads'); ?></li>
                        <li><?php echo anchor('bloger_controller/about', 'About Me'); ?></li>             
                    </ul> 
                </div>
            </div>
            <div id="content_cover">
                <div id="content">
                    <?php
                    if (isset($slider))
                        echo $slider;
                    elseif (isset($my_projects_ui)) {
                        echo $my_projects_ui;
                    }
                    if (isset($pinned_post)) {
                        echo "<img src=\"http://localhost/cseelysium.com/images/pin.jpg\" /><br />";
                        echo $pinned_post;
                        //print_r($pinned_post);
                    }
                    ?>
                    <?php
                    if (isset($register))
                        echo $register;
                    else if (isset($bloger_ui)) {
                        echo $bloger_headerr;
                        echo $bloger_ui;
                    } else if (isset($view_all_blogs)) {
                        //show all blogs and commetns
                        echo $view_all_blogs;
                    } else if (isset($bloger_profile)) {
                        echo $bloger_headerr;
                        echo $bloger_profile;
                    } else if (isset($blog_ui)) {
                        echo $bloger_headerr;
                        echo $blog_ui;
                    } else if (isset($this_blog)) {
                        echo $bloger_headerr;
                        echo $this_blog;
                    } elseif (isset($about_page)) {
                        echo $about_page;
                    } elseif (isset($blog_details)) {
                        echo $blog_details;
                    } elseif (isset($adminui))
                        echo $adminui;
                    elseif (isset($edit_password)) {
                        echo $bloger_headerr;
                        echo $edit_password;
                    }
                    ?>
                </div>
                <div id="sidebar">
                    <?php
                    $loginname = $this->session->userdata('bloger_login_name');
                    //echo $loginname."here";
                    if ($loginname != "") {
                        $this->view('logout_ui');
                        echo anchor('bloger_controller/my_blogs/' . $this->session->userdata('bloger_login_name'), 'View Deshboard');
                        echo br(1);
                    } else {
                        $this->view('login_ui');
                    }
                    if ($loginname != "") {
                        if ($loginname == "Sharif")
                            echo anchor('bloger_controller/view_admin_ui/' . $this->session->userdata('bloger_login_name'), 'View Admin Pannel');
                    }
                    
                    
                    
                    
                    //most viewed and comment blogs ui showing
                    $this->view('most_viewed_n_comment_tab');
                    ?>
                    
                    <div class="side_boxes">
                        <fieldset>
                            <legend>Recent Comments</legend>
                                memoranda
                        </fieldset>
                    </div>
                    <div class="side_boxes">
                        <fieldset>
                            <legend>Get Blogs By Category</legend>
                                Select Category
                        </fieldset>
                    </div>
                    <div class="side_boxes">
                        <fieldset>
                            <legend>Search Bloger</legend>
                                Enter Bloger Name
                        </fieldset>
                    </div>
<?php
if (isset($archival_tree))
    echo $archival_tree;
?>
                </div>

            </div>
            <div id="footerdiv">
                <br />&copy; copyright 2014 : Md. Shariful Islam
            </div>
        </div>
    </body>
</html>