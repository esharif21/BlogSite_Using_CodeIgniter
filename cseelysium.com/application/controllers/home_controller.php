<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends CI_Controller {
        public function __construct() 
        {
                parent::__construct();
                $this->load->library('../controllers/bloger_controller');
                /* it can be used any other controller
                 * $dat=$this->bloger_controller->hide_blog(51);
                 *echo $dat;
                */
        }
	public function index()
	{
		$this->load->helper(array('url','html','form'));
		$this->load->library(array('form_validation','session'));
                $data=array();
		$data['slider']=$this->load->view('slider-contents','',true);
                $data['login_ui']=$this->load->view('login_ui','',true);
                $this->load->model('bloger_model');
                $max_read_blog_id=$this->bloger_model->get_max_read_blog();
                $data['pinned_post']=  $this->pinned_post($max_read_blog_id);
                //$this->load->controller('bloger_controller');
                //$this->bloger_controller->view_blog_details($max_read_blog_id);
                //$all_blogs['all_blogs']=$this->bloger_model->getallblogs()->result();
                //$data['archival_tree']=$this->load->view('archival_tree',$all_blogs,true);
                
                $this->load->view('home',$data);
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

        public function get_blogs_for_archival_links()
	{
		$this->load->model('bloger_model');
		$this->load->helper('url');
		$all_blogs['blogs']=$this->bloger_model->getallblogs()->result();
                $archival_tree_ui['archival_tree']=$this->load->view($all_blogs);
                $this->load->view('home',$archival_tree_ui);                
	}
        
        public function get_max_read_blog()
        {
            $this->load->helper(array('html','captcha','form','url'));
            $this->load->library(array('form_validation','session'));
            
            $this->load->model('bloger_model');
            $max_read=$this->bloger_model->get_max_read_blog();
        }
        
	public function view_registration_form()
	{
		$this->load->helper(array('url','html','form','captcha'));
		$data=array();
		$data['register']=$this->load->view('registration_form','',true);
		$this->load->view('home',$data);
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */