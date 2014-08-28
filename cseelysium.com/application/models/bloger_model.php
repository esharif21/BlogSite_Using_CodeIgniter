<?php

	class Bloger_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function insertdt($inputdata)
	{
		$this->db->insert('bloger_registration_table', $inputdata); 
	}
	
	function insertblog($inputdata)
	{
		if($this->db->insert('user_submited_blog_table', $inputdata))
		{
                    //`like_id`, `login_name`, `blog_id`, `like_date`, `status`SELECT * FROM `like_table` WHERE 1
                    $like['login_name'] = '';
                    $like['blog_id']=$this->db->insert_id();;
                    $like['like_date']= date('Y-m-d H:i:s');
                    $like['like_count']= 0;
  
                   // $this->generate_like_id_4_each_blog($like);//echo $insert_id;
                    return TRUE;
                }
                else
			return FALSE;
	}
        function bloglikeadd($blog_id,$row)
	{
            //print_r($inputdata);
		$this->db->insert('like_table', $row);
	}
        
        function insertcomment($inputdata,$blog_id)
	{
            //print_r($inputdata);
                $this->db->select('comment_count');
		$this->db->from('user_submited_blog_table');
                $this->db->where('blog_id',$blog_id);
		$query = $this->db->get();
		$result = $query->result();
                $row=array();
                $row['comment_count']=$result[0]->comment_count+1;
                $this->db->where('blog_id',$blog_id);
                $this->db->update('user_submited_blog_table', $row);
		if($this->db->insert('comment_table', $inputdata))
			return TRUE;
		else
			return FALSE;
	}
        
	function login_check($arr)
	{
		$this->db->select();
		$this->db->from('bloger_registration_table');
		$this->db->where($arr);
		$query = $this->db->get();
		$result = $query->result();
		//print_r($result);
		if($result)
			return TRUE;
		else
			return FALSE;
	}	
	
//	function getallblogs()
//	{
//		//`id`, ``, ``, ``, `password`, ``, ``, ``, ``, `status`SELECT * FROM `sign_up_table` WHERE 1
//		$this->db->select();
//		$this->db->from('user_submited_blog_table');
//		//$this->db->order_by("name", "asc"); 
//		return $this->db->get();
//	}
        function getallblogs($blogs_per_page,$offset_index_after_click)
	{
		//`id`, ``, ``, ``, `password`, ``, ``, ``, ``, `status`SELECT * FROM `sign_up_table` WHERE 1
		$this->db->select();
		$this->db->from('user_submited_blog_table');
		$this->db->order_by("date", "desc"); 
		$query=$this->db->get('',$blogs_per_page,$offset_index_after_click);
                return $query;
	}
        function get_bloger_statistics($login_name)
	{
		$result1=$this->db->get('bloger_registration_table')->result();
                $bloger_statistics=  array();
                foreach ($result1 as $row)
                {
                    if($row->login_name==$login_name)
                    {
                        $bloger_statistics['profile_photo_link']=$row->photo_link;
                        $bloger_statistics['member_since']=$row->registration_date;
                        break;
                    }    
                }
                $result1="";
                $result1=$this->db->get('user_submited_blog_table')->result();
                $bloger_statistics['total_posts']=0;
                foreach ($result1 as $row)
                {
                    if($row->login_name==$login_name)
                    {
                        $bloger_statistics['total_posts']++;
                    }    
                }
                $result1="";
                $result1=$this->db->get('comment_table')->result();
                $bloger_statistics['total_comments_given']=0;
                foreach ($result1 as $row)
                {
                    if($row->login_name==$login_name)
                    {
                        $bloger_statistics['total_comments_given']++;
                    }
                }
                $result1="";
                $result1=$this->db->get('like_table')->result();
                $bloger_statistics['total_likes_given']=0;
                foreach ($result1 as $row)
                {
                    if($row->login_name==$login_name)
                    {
                        $bloger_statistics['total_likes_given']++;
                    }
                }
               // print_r($bloger_statistics);
		return $bloger_statistics;
	}
        
        function getallblogers()
	{
		//`id`, ``, ``, ``, `password`, ``, ``, ``, ``, `status`SELECT * FROM `sign_up_table` WHERE 1
		$this->db->select();
		$this->db->from('bloger_registration_table');
		//$this->db->order_by("name", "asc"); 
		return $this->db->get()->result();
	}
        
        function get_max_read_blog() //should be optimized
        {
            $this->db->select_max('read_count');
            $this->db->select('blog_id');
            
            $this->db->from('user_submited_blog_table');
            
            //$this->db->order_by("name", "asc"); 
            $mxx=$this->db->get()->result();
            $wh=$mxx[0]->blog_id;
            return $wh;
//            
//            //$this->db->order_by("name", "asc"); 
//            $mxx=$this->db->get()->result();
//            $wh=$mxx[0]->read_count;
//            return $this->getmaxreadblog($wh);
            
        }
        function getmaxreadblog($wh)  //should be reduced
        {
            $this->db->select();
            $this->db->from('user_submited_blog_table');
            $this->db->where('read_count',$wh);
            return $this->db->get()->result();
        }
                
        function getcomments()
        {
                $this->db->select();
		$this->db->from('comment_table');
		//$this->db->order_by("name", "asc"); 
		return $this->db->get();
        }
	function getmyblogs($login_name)
	{
		$this->db->select();
		$this->db->from('user_submited_blog_table');
		$this->db->where('login_name',$login_name);
		$this->db->order_by("date", "desc"); 
		return $this->db->get();
	}
        function getoneblog($blog_id)
        {
            $this->db->select();
            $this->db->from('user_submited_blog_table');
            $this->db->where('blog_id',$blog_id);
            //$this->db->order_by("name", "asc"); 
            $result=$this->db->get()->result();
            $row['read_count']=($result[0]->read_count)+1;
            $this->update_read_count($blog_id,$row);
            return $result;
        }
        function update_read_count($blog_id,$row)
        {
            $this->db->where('blog_id',$blog_id);
            $this->db->update('user_submited_blog_table', $row);
        }
        
        function get_all_likes()
        {
            $this->db->select();
            $this->db->from('like_table');
            //$this->db->order_by("name", "asc"); 
            return $this->db->get()->result();
        }
        
        function update_like_count($blog_id,$row)
        {
            $this->db->where('blog_id',$blog_id);
            $this->db->update('like_table', $row);
        }
        
        function commentsofthisblog($blog_id)
        {
            $this->db->select();
            $this->db->from('comment_table');
            $this->db->where('blog_id',$blog_id);
            return $this->db->get()->result();
            
        }
                
	function update_bloger_info($row,$wh)
	{
		//`id`, ``, ``, ``, `password`, ``, ``, ``, ``, `status`SELECT * FROM `sign_up_table` WHERE 1
		$this->db->where('login_name',$wh);
		if($this->db->update('bloger_registration_table', $row))
			return TRUE;
		else
			return FALSE;
	}
	
	
	function get_one_blog($login_name,$blog_id)
	{
		$this->db->select();
		$this->db->from('user_submited_blog_table');
		$this->db->where(array('login_name'=>$login_name));
		$this->db->where(array('blog_id'=>$blog_id));
		
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
	
	
	function get_one_dt($login_name)
	{
	$this->db->select();
	$this->db->from('bloger_registration_table');
	$this->db->where(array('login_name'=>$login_name));
	
	$query = $this->db->get();
	$result = $query->result();
	
	return $result;
	}
        	
	function update_blog($row)
	{
		$this->db->where('blog_id',$row['blog_id']);
		if($this->db->update('user_submited_blog_table', $row))
			return TRUE;
		else
			return FALSE;
	}
	
	function delete_one_blog_parmanently($wh)
	{
		if($this->db->delete('user_submited_blog_table', array('blog_id' => $wh)))
                    return TRUE;
                else
                    return FALSE;
	}
	
        function getimagelink()
	{
            $this->db->select('login_name,display_name,photo_link');
            $this->db->from('bloger_registration_table');
            $dt=$this->db->get();
            //print_r($dt);
            return $dt;
        }
	
	
	function getdt()
	{
		//`id`, ``, ``, ``, `password`, ``, ``, ``, ``, `status`SELECT * FROM `sign_up_table` WHERE 1
		$this->db->select('id,name,phone,email,sex,hobbies,subs_status,notes,status');
		$this->db->from('sign_up_table');
		$this->db->order_by("name", "asc"); 
		return $this->db->get();
	}
	
	function update_blog_status($blog_id,$data)
	{
                $id['blog_id']=$blog_id;
		$this->db->where('blog_id',$blog_id);
		if($this->db->update('user_submited_blog_table', $data))
			return TRUE;
		else
			return FALSE;
	}
        
	function update_bloger_status($bloger_id,$data)
	{
                $id['login_name']=$bloger_id;
		$this->db->where('login_name',$bloger_id);
		if($this->db->update('bloger_registration_table', $data))
			return TRUE;
		else
			return FALSE;
	}
        
        function delete_one_bloger_parmanently($wh)
	{
		if($this->db->delete('bloger_registration_table', array('login_name' => $wh)))
                    return TRUE;
                else
                    return FALSE;
	}
        
        function get_most_read_blogs($blogs_per_page,$offset_index_after_click)
        {
            $this->db->select('blog_id,title,read_count');
            $this->db->from('user_submited_blog_table');
            $this->db->order_by("read_count", "desc"); 
            $query=$this->db->get('',$blogs_per_page,$offset_index_after_click);//'',$blogs_per_page,$offset_index_after_click);
            return $query->result();
        }
        function get_most_comment_blogs($blogs_per_page,$offset_index_after_click)
        {
            $this->db->select('blog_id,title,comment_count');
            $this->db->from('user_submited_blog_table');
            $this->db->order_by("comment_count", "desc"); 
            $query=$this->db->get('',$blogs_per_page,$offset_index_after_click);//'',$blogs_per_page,$offset_index_after_click);
            return $query->result();
        }
}

?>