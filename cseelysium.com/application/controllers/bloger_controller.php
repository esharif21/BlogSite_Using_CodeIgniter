<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bloger_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE) {
            $this->load->helper('url');
            $this->session->set_userdata('last_page', current_url());
            $urll = $this->session->userdata('last_page');
            $urlll = substr($urll, 41);
        }
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ck_editor',
            'path' => 'js/ckeditor',
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '200px', //Setting a custom height
            ),
        );
        $this->data1['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ck_editor1',
            'path' => 'js/ckeditor',
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '200px', //Setting a custom height
            ),
        );
        $this->load->library('pagination');
        $data['blogs_order_by_read']=$this->get_most_read_blog();
        $data['blogs_order_by_comment']=  $this->get_most_comment_blog();
        $this->load->view('most_viewed_n_comment_tab',$data,TRUE);
    }
    public function get_most_read_blog()
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'bloger_controller/get_most_read_blog/';
        $config['total_rows'] = $this->db->count_all('user_submited_blog_table');
        $config['per_page'] = '15';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';

        $this->pagination->initialize($config);
        return $this->bloger_model->get_most_read_blogs($config['per_page'], $this->uri->segment(3));
    }
    public function get_most_comment_blog()
    {
        $this->load->library('pagination');
        $conf['base_url'] = base_url() . 'bloger_controller/get_most_comment_blog/';
        $conf['total_rows'] = $this->db->count_all('user_submited_blog_table');
        $conf['per_page'] = '15';
        $conf['full_tag_open'] = '<p>';
        $conf['full_tag_close'] = '</p>';

        $this->pagination->initialize($conf);
        return $this->bloger_model->get_most_comment_blogs($conf['per_page'], $this->uri->segment(3));
    }

    public function index() {
        $this->get_all_blogs();
    }

    public function get_all_blogs() {
        $all_dt = array();
        $this->load->model('bloger_model');
        $this->load->helper('url', 'date');

        $this->load->library('pagination');

        
        $data['slider']=$this->load->view('slider-contents','',true);
                $data['login_ui']=$this->load->view('login_ui','',true);
                $this->load->model('bloger_model');
                $max_read_blog_id=$this->bloger_model->get_max_read_blog();
                $data['pinned_post']=  $this->pinned_post($max_read_blog_id);
                
        
        
        $config['base_url'] = base_url() . 'bloger_controller/get_all_blogs/';
        $config['total_rows'] = $this->db->count_all('user_submited_blog_table');
        $config['per_page'] = '3';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';

        $this->pagination->initialize($config);

        $all_data = $this->bloger_model->getallblogs($config['per_page'], $this->uri->segment(3));
        $all_dt['data'] = $all_data->result();
        $dt = $this->bloger_model->getimagelink();
        $all_dt['bloger_image'] = $dt->result();
        $all_comm = $this->bloger_model->getcomments();
        $all_dt['comment'] = $all_comm->result();
        $all_dt['likes'] = $this->bloger_model->get_all_likes();
        $data['view_all_blogs'] = $this->load->view('view_all_blogs', $all_dt, true);
        
        $this->load->view('home', $data);
        //$this->view_home_and_blogs($all_dt);
    }
        public function pinned_post($blog_id)
        {
            $this->load->model('bloger_model');
            $this->load->helper(array('url','html','form','captcha','string','text'));
            $this->load->library('form_validation');
            //$oneblog=$this->bloger_model->getoneblog($blog_id);
            $one_blog=array();
            $one_blog['one_blog']=$this->bloger_model->getoneblog($blog_id);
            $one_blog['this_blog_comments']=$this->bloger_model->commentsofthisblog($blog_id);
            $one_blog['bloger_image']=$this->bloger_model->getimagelink()->result();
            
            $data=$this->load->view('blog_details',$one_blog,true);
            return $data;
        }


    public function my_blogs($login_name) {
        $this->load->model('bloger_model');
        $this->load->helper('url');
        $all_dt = array();
        $all_data = $this->bloger_model->getmyblogs($login_name);
        $all_dt['myblogs'] = $all_data->result();
        $all_dt['bloger_headerr'] = $this->view_bloger_header($login_name);
        $this->view_bloger_ui($all_dt);
    }

    public function view_bloger_header($login_name) {
        $this->load->model('bloger_model');
        $this->load->helper('url');
        $bloger_statistics = array();
        $statistic = $this->bloger_model->get_bloger_statistics($login_name);
        $bloger_statistics['profile_photo_link'] = $statistic['profile_photo_link'];
        $bloger_statistics['member_since'] = $statistic['member_since'];
        $bloger_statistics['total_posts'] = $statistic['total_posts'];
        $bloger_statistics['total_comments_given'] = $statistic['total_comments_given'];
        $bloger_statistics['total_comments_got'] = 22;
        $bloger_statistics['total_likes_given'] = $statistic['total_likes_given'];
        $bloger_statistics['total_likes_got'] = 45;
        $all_dt = $this->load->view('bloger_header', $bloger_statistics, TRUE);
        return $all_dt;
    }

    public function view_blog_ui($login_name) {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $data = array();

        $data['blog_ui'] = $this->load->view('blog_ui', $login_name, true);
        $data['bloger_headerr'] = $this->view_bloger_header($login_name);

        $this->load->view('home', $data);
    }

    public function view_bloger_ui($allblogs) {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $data = array();
        $data['bloger_headerr'] = $allblogs['bloger_headerr'];
        $allblogs['bloger_headerr'] = "";
        $data['bloger_ui'] = $this->load->view('bloger_ui', $allblogs, true);
        $this->load->view('home', $data);
    }

    public function view_bloger_profile($login_name) {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('bloger_model');
        $result['old_data'] = $this->bloger_model->get_one_dt($login_name);
        $data = array();
        $data['bloger_profile'] = $this->load->view('edit_profile', $result, true);
        $data['bloger_headerr'] = $this->view_bloger_header($login_name);
        $this->load->view('home', $data);
    }

    public function update_data($login_name) {
        /* this function does not make update 'login_name'. it remain unchanged forever after the user get registered */
        $this->load->library(array('javascript', 'session', 'form_validation'));
        //$this->load->helper(array('form','url','html');
        $this->load->helper('url');
        $this->load->model('bloger_model');

        //$this->form_validation->set_rules('login_name', 'Login Name', 'trim|required');
        $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        //echo $login_name;
        if ($this->form_validation->run() == FALSE)
            $this->view_bloger_profile($login_name);
        else {
            $new_data['display_name'] = $this->input->post('display_name');
            $new_data['email'] = $this->input->post('email');
            //print_r($new_data);
            if ($this->bloger_model->update_bloger_info($new_data, $login_name)) {
                $info_update_msg['info_update_status'] = 'Your Information Updated Successfully!';
                $this->session->set_userdata($info_update_msg);
                $this->my_blogs($login_name);
            }
            else
                $this->view_bloger_profile($login_name);
        }
    }

    public function view_bloger_password_ui($login_name) {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('bloger_model');
        //echo $id;
        $result['old_info'] = $this->bloger_model->get_one_dt($login_name); //here all info is present

        $data = array();
        $data['edit_password'] = $this->load->view('edit_password', $result, true);
        $data['bloger_headerr'] = $this->view_bloger_header($login_name);
        $this->load->view('home', $data);
    }

    public function change_bloger_password($login_name) {
        /* this function does not make update 'login_name'. it remain unchanged forever after the user get registered */
        $this->load->library(array('javascript', 'session', 'form_validation'));
        //$this->load->helper(array('form','url','html');
        $this->load->helper('url');
        $this->load->model('bloger_model');

        //$this->form_validation->set_rules('login_name', 'Login Name', 'trim|required');
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|md5|required');
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|md5');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[current_password]');

        //echo $login_name;
        if ($this->form_validation->run() == FALSE)
            $this->view_bloger_password_ui($login_name);
        else {
            $name = $login_name;
            $pass = md5($this->input->post('old_password'));
            $whr = array('login_name' => $name, 'password' => $pass, 'status' => 1);
            if ($this->bloger_model->login_check($whr) == TRUE) {
                $new_data = array();
                $new_data['login_name'] = $login_name;
                $new_data['password'] = md5($this->input->post('current_password'));
                //print_r($new_data);
                if ($this->bloger_model->update_bloger_info($new_data, $login_name) == TRUE) {
                    $pass_update_msg['password_update_status'] = 'Your Password Changed Successfully!';
                    $this->session->set_userdata($pass_update_msg);
                    $this->my_blogs($login_name);
                } else {
                    $pass_update_msg['password_update_status'] = 'Error! perhapes db error occour.';
                    $this->session->set_userdata($pass_update_msg);
                    $this->my_blogs($login_name);
                }
            } else {
                $pass_update_msg['password_update_status'] = 'Sorry! Your Old Password is Wrong, Try Again.';
                $this->session->set_userdata($pass_update_msg);
                $this->view_bloger_password_ui($login_name);
            }
        }
    }

    public function view_home_and_blogs($all_dt) {
        $this->load->helper(array('url', 'html', 'form', 'captcha', 'string', 'text'));
        $data = array();
        //$dt = $this->getimagelink(); //for using methods in view page
        //print_r($all_dt['bloger_image']);
        $data['view_all_blogs'] = $this->load->view('view_all_blogs', $all_dt, true);
        $data['login_ui'] = true;
        $this->load->view('home', $data);
    }

    public function bloger_login_check() {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('bloger_model');
        $this->form_validation->set_rules('bloger_name', 'Login Name', 'trim|required');
        $this->form_validation->set_rules('bloger_pass', 'Password', 'required|md5');

        if ($this->form_validation->run() == FALSE) 
        {
            /* $data=array();
              $data['maincontent']=$this->load->view('registration_form','',true); */
            $data['login_ui'] = true;
            $this->load->view('home', $data);
        }
        else 
            {
            $this->load->model('bloger_model');
            $name = $this->input->post('bloger_name');
            $pass = md5($this->input->post('bloger_pass'));
            //echo $name;
            $whr = array('login_name' => $name, 'password' => $pass, 'status' => 1);
            //print_r($array);
            //print_r($whr);
            if ($this->bloger_model->login_check($whr) == TRUE) {
                $bloger_name['bloger_login_name'] = $name;
                $this->session->set_userdata($bloger_name);
                if ($name == "Sharif") {
                    $this->view_admin_ui();
                }
                else
                    $this->my_blogs($name); //view_bloger_ui(NULL);
            }
            else {
                $urlll = substr($this->session->userdata('last_page'), 41);
                //echo $urlll;
                redirect($urlll);
                //echo "no";
            }
        }
    }

    public function view_admin_ui() {
        $all_dt = array();
        $this->load->model('bloger_model');
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'bloger_controller/get_all_blogs/';
        $config['total_rows'] = $this->db->count_all('user_submited_blog_table');
        $config['per_page'] = '5';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';

        $this->pagination->initialize($config);

        $all_data = $this->bloger_model->getallblogs($config['per_page'], $this->uri->segment(3));
        $all_dt['all_blogs'] = $all_data->result();
        $all_dt['all_blogers'] = $this->bloger_model->getallblogers();
        $data = array();
        $data['adminui'] = $this->load->view('admin_ui', $all_dt, true);
        $this->load->view('home', $data);
    }

    public function logout() {
        $this->load->helper(array('html', 'captcha', 'form', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $array_items = array('bloger_login_name' => '');
        $this->session->unset_userdata($array_items);
        $this->get_all_blogs();
    }

    public function add_your_blog() {
        $this->load->helper(array('html', 'captcha', 'form', 'url'));
        $this->load->library(array('form_validation', 'session'));

        $this->form_validation->set_rules('title', 'Blog Title', 'trim|required');
        $this->form_validation->set_rules('details', 'Blog Story', 'trim|required');
        $this->form_validation->set_rules('blog_type', 'Blog Type', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['blog_ui'] = $this->load->view('blog_ui', '', true);
            $this->load->view('home', $data);
        } else {
            //echo "success";
            //$data['blog_submit_message']="<h1>Your Blog Submitted Successfully</h1>";
            //foreach($this->input->post('hobbies') as $hhh)
            //`bloger_id`, `login_name`, `display_name`, `mobile`, `email`, `password`, `status`
            $this->load->model('bloger_model');

            $inputdata['login_name'] = $this->session->userdata('bloger_login_name');
            $inputdata['title'] = $this->input->post('title');
            $inputdata['details'] = $this->input->post('details');
            $inputdata['image_link'] = "upload";
            $inputdata['blog_type'] = $this->input->post('blog_type');
            $dateTime = date('Y-m-d H:i:s');
            $inputdata['date'] = $dateTime;
            $inputdata['last_update_date'] = $dateTime;
            $inputdata['read_count'] = 0;

            //print_r($inputdata);
            if ($this->bloger_model->insertblog($inputdata)) {
                $msg['add_blog_status'] = 'Your Blog Added Successfully';
                $this->session->set_userdata($msg);
                $this->my_blogs($inputdata['login_name']);
            }
            /* else
              {
              $msg['add_blog_status']="Your Bloge Added Successfully";
              $this->my_blogs($inputdata['login_name']);
              } */
            //$this->load->view('suc');
            //$this->get_data();
        }
    }

    public function edit_my_blog($login_name, $blog_id) {
        $this->edit_blog_ui($login_name, $blog_id);
    }

    public function edit_blog_ui($login_name, $blog_id) {
        $this->load->helper(array('url', 'html', 'form', 'captcha'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('bloger_model');
        //echo $id;
        $result['old_blog'] = $this->bloger_model->get_one_blog($login_name, $blog_id);

        $data = array();
        $data['this_blog'] = $this->load->view('edit_blog_ui', $result, true);
        $data['bloger_headerr'] = $this->view_bloger_header($login_name);
        $this->load->view('home', $data);
    }

    public function update_blog($login_name, $blog_id) {
        /* this function does not make update 'login_name'. it remain unchanged forever after the user get registered */
        $this->load->library(array('javascript', 'session', 'form_validation'));
        //$this->load->helper(array('form','url','html');
        $this->load->helper('url');

        //$this->form_validation->set_rules('login_name', 'Login Name', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('details', 'Write Story', 'required');
        $this->form_validation->set_rules('blog_type', 'Blog Type', 'required');
        $this->form_validation->set_rules('captcha', 'Type The Word', 'trim|required');
        //echo $login_name;
        if ($this->form_validation->run() == FALSE)
            $this->edit_blog_ui($login_name, $blog_id);
        else {
            $this->load->model('bloger_model');
            $new_blog['blog_id'] = $blog_id;
            $new_blog['login_name'] = $login_name;
            $new_blog['title'] = $this->input->post('title');
            $new_blog['details'] = $this->input->post('details');
            $new_blog['image_link'] = "Upload";
            $new_blog['blog_type'] = $this->input->post('blog_type');
            $new_blog['last_update_date'] = date('Y-m-d H:i:s');
            //print_r($new_blog);
            if ($this->bloger_model->update_blog($new_blog)) {
                $blog_update_msg['blog_update_status'] = 'Your Blog Updated Successfully!';
                $this->session->set_userdata($blog_update_msg);
                $this->my_blogs($login_name);
            }
            else
                $this->edit_blog_ui($login_name, $blog_id);
        }
    }

    public function delete_my_blog($login_name, $blog_id) {
        $this->load->model('bloger_model');
        $this->load->helper('url');
        //$wh['id'] = $id;
        if ($this->bloger_model->delete_one_blog_parmanently($blog_id)) {
            $blog_delete_msg['blog_delete_status'] = 'A blog has been deleted';
            $this->session->set_userdata($blog_delete_msg);
        }
        $this->my_blogs($login_name);
    }

    public function add_comment($login_name, $blog_id) 
    {
        $this->load->model('bloger_model');
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library(array('form_validation'));
        //echo $login_name;
        $this->form_validation->set_rules('comment', 'comment', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->get_all_blogs();
        } else {
            //echo "success";
            //$data['blog_submit_message']="<h1>Your Blog Submitted Successfully</h1>";

            $this->load->model('bloger_model');
            //`comment_id`, `bloger_id`, `blog_id`, `image_link`, `comment_date`, `comment`, `status`
            $inputdata['login_name'] = $login_name;
            $inputdata['blog_id'] = $blog_id;
            $inputdata['image_link'] = "upload";
            $inputdata['comment_date'] = date('Y-m-d H:i:s');
            $inputdata['comment'] = $this->input->post('comment');
            //print_r($inputdata);
            if ($this->bloger_model->insertcomment($inputdata,$blog_id)) {
                $this->get_all_blogs();
            } else {
                echo "<h1>Unpredictable ERROR Occour! To redirect, go back please.</h1>";
            }
            //$this->load->view('suc');
            //$this->get_data();
        }
    }

    public function getcomments() {
        $this->load->model('bloger_model');
        $this->load->helper('url', 'html');
        $all_data = $this->bloger_model->getcomments();
        return $all_comments['comments'] = $all_data->result();
        //print_r($all_dt);
        //$this->view_bloger_ui($all_comments);
    }

    public function add_bloger() {
        $this->load->helper(array('html', 'captcha', 'form', 'url'));
        $this->load->library('form_validation');

        /* $this->form_validation->set_rules('login_name', 'Login_Name', 'trim|required');
          $this->form_validation->set_rules('display_name', 'Display Name', 'trim|required');
          $this->form_validation->set_rules('mobile', 'Mobile', 'numeric|required');
          $this->form_validation->set_rules('email', 'Email', 'valid_email|required'); */
        $this->form_validation->set_rules('bloger_password', 'Password', 'required|md5');
        /* $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[bloger_password]');
          $this->form_validation->set_rules('captcha', 'The Captcha', 'trim|required|matches[hidden_captcha]'); */
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['register'] = $this->load->view('registration_form', '', true);
            $this->load->view('home', $data);
        } else {
            //foreach($this->input->post('hobbies') as $hhh)
            //`bloger_id`, `login_name`, `display_name`, `mobile`, `email`, `password`, `status`
            //echo $_FILES["file"]["name"]; //here ok
            //echo $_FILES["file"]["name"]='myfile.jpg';
            $login_id = $this->input->post('login_name');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            $_FILES["file"]["name"] = $login_id . '.' . $extension;
            $file_name = "http://localhost/cseelysium.com/upload/" . $_FILES["file"]["name"];
            $image_ok = $this->insert_photo($_FILES["file"]);
            if ($image_ok == FALSE) {
                //echo "<br />Sorry! Image not inserted.<br />"; //javascript message to be printed
                //echo header('Location: ../home_controller/view_registration_form');
                $file_name = "http://localhost/cseelysium.com/upload/empty.jpg";
            }
            $this->load->model('bloger_model');
            $inputdata['login_name'] = $this->input->post('login_name');
            $inputdata['display_name'] = $this->input->post('display_name');
            $inputdata['photo_link'] = $file_name;
            $inputdata['mobile'] = $this->input->post('mobile');
            $inputdata['email'] = $this->input->post('email');
            $inputdata['password'] = md5($this->input->post('bloger_password'));
            $inputdata['registration_date'] = date('Y-m-d');
            //print_r($inputdata);
            $this->bloger_model->insertdt($inputdata);
            echo "Submitted successfully!";
            $this->get_all_blogs();
            //$this->get_data();
        }
    }

    public function insert_photo() {
        $this->load->helper(array('html', 'captcha', 'form', 'url'));
        $this->load->library('form_validation');

        $allowedExts = array("gif", "jpeg", "jpg", "JPG", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png"))
                /* && ($_FILES["file"]["size"] < 20000) */ && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                return FALSE;
            } else {
                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
                //$_FILES["file"]["name"]='myfile.jpg';
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                $fileLocation = "upload/" . $_FILES["file"]["name"];
                echo "Location " . $fileLocation . "<br />";
                echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                return TRUE;
            }
        } else {
            //echo "Invalid file";
            return FALSE;
        }
    }

    public function getimagelink() {
        $this->load->model('bloger_model');
        return $this->bloger_model->getimagelink()->result();
    }

    public function view_blog_details($blog_id) {
        $this->load->model('bloger_model');
        $this->load->helper(array('url', 'html', 'form', 'captcha', 'string', 'text'));
        $this->load->library('form_validation');
        //$oneblog=$this->bloger_model->getoneblog($blog_id);
        $one_blog = array();
        $one_blog['one_blog'] = $this->bloger_model->getoneblog($blog_id);
        $one_blog['this_blog_comments'] = $this->bloger_model->commentsofthisblog($blog_id);
        $one_blog['bloger_image'] = $this->getimagelink();


        //print_r($one_blog);
        //$this->view_bloger_ui($one_blog);
        /* //$comments_of_this_blog=$this->bloger_model->commentsofthisblog($blog_id);
          $this_blog_comments['this_blog_comments']=$this->bloger_model->commentsofthisblog($blog_id);
         */
        //$this->view_bloger_ui($all_comments);
        //$data=array();
        //$dt = $this->getimagelink(); //for using methods in view page
        //print_r($all_dt['bloger_image']);
        $data['blog_details'] = $this->load->view('blog_details', $one_blog, true);
        //$data['login_ui']=true;
        $this->load->view('home', $data);
    }

    public function blog_like_add($blog_id, $bloger_id) {
        $this->load->helper(array('html', 'captcha', 'form', 'url'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('bloger_model');
        $row['login_name'] = $bloger_id;
        $row['blog_id'] = $blog_id;
        $row['like_date'] = date('Y-m-d H:i:s');

        $this->bloger_model->bloglikeadd($blog_id, $row);
        $this->get_all_blogs();
    }

    public function downloads() {
        echo "<h1>under construction</h1>";
    }

    public function about() {
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library(array('form_validation', 'session'));
        $data = array();
        $data['about_page'] = $this->load->view('about', '', true);
        $this->load->view('home', $data);
    }

    //dom adding for pdf save
    public function download_my_blog($login_name, $blog_id) {

        //$this->load->helper(array('dompdf','file'));
        //$this->load->helper(array('url','html','form','captcha'));
        //$this->load->library(array('form_validation','session'));

        $this->load->model('bloger_model');
        //echo $id;
        $result['one_blog_for_pdf'] = $this->bloger_model->get_one_blog($login_name, $blog_id);

        $pdf_body = $this->load->view('pdf_formating', $result, true);

        $print_pdf = pdf_create($pdf_body, 'blog_download');
        echo $print_pdf;
    }
    public function parmanently_delete($blog_id)
    {
        $this->load->model('bloger_model');
        $this->bloger_model->delete_one_blog_parmanently($blog_id);
        $this->view_admin_ui();
    }
    public function hide_show_blog($blog_id,$status)
    {
        $this->load->model('bloger_model');
        if($status==1)
        {
            $data['status']=0;
            if($this->bloger_model->update_blog_status($blog_id,$data)==TRUE)
            {
                $blog_update_status_msg['blog_update_status_msg'] = 'The Blog Has Been Hidden Successfully!';
            }
        }
        else if($status==0)
        {
            $data['status']=1;
            if($this->bloger_model->update_blog_status($blog_id,$data)==TRUE)
            {
                $blog_update_status_msg['blog_update_status_msg'] = 'The Blog Has Been Shown Successfully!';
            }
        }
        else 
        {
            $blog_update_status_msg['blog_update_status_msg'] = 'Unpredictable Error!';
        }
        $this->session->set_userdata($blog_update_status_msg);
        $this->view_admin_ui();
    }
    
    public function hide_show_bloger($bloger_id,$status)
    {
        $this->load->model('bloger_model');
        if($status==1)
            $data['status']=0;
        else if($status==0)
            $data['status']=1;
        $this->bloger_model->update_bloger_status($bloger_id,$data);
        $this->load->model('bloger_model');
        if($status==1)
        {
            $data['status']=0;
            if($this->bloger_model->update_bloger_status($bloger_id,$data)==TRUE)
            {
                $bloger_update_status_msg['bloger_update_status_msg'] = 'The Bloger Has Been Hidden Successfully!';
            }
        }
        else if($status==0)
        {
            $data['status']=1;
            if($this->bloger_model->update_bloger_status($bloger_id,$data)==TRUE)
            {
                $bloger_update_status_msg['bloger_update_status_msg'] = 'The Bloger Has Been Shown Successfully!';
            }
        }
        else 
        {
            $bloger_update_status_msg['bloger_update_status_msg'] = 'Unpredictable Error!';
        }
        $this->session->set_userdata($bloger_update_status_msg);
        $this->view_admin_ui();
    }
    public function delete_bloger($bloger_id)
    {
        $this->load->model('bloger_model');
        
        $this->bloger_model->delete_one_bloger_parmanently($bloger_id);
        
        $this->view_admin_ui();
    }
    

}