<?php 
        $user_name=$this->session->userdata('bloger_login_name');
	
    //$this->view('bloger_header');
        $password_change_status=$this->session->userdata('password_update_status');
	$info_update_msg=$this->session->userdata('info_update_status');
	$add_blog_msg=$this->session->userdata('add_blog_status');
	$blog_update_msg=$this->session->userdata('blog_update_status');
        $blog_delete_msg=$this->session->userdata('blog_delete_status');
	if($info_update_msg!=NULL)
	{
		echo "<div class=\"message_style\">$info_update_msg</div>";
		$this->session->unset_userdata('info_update_status');
	}
	else if($add_blog_msg!=NULL)
	{
		echo "<div class=\"message_style\">$add_blog_msg</div>";
		$this->session->unset_userdata('add_blog_status');
	}
	
	if($blog_update_msg!=NULL)
	{
		echo "<div class=\"message_style\">$blog_update_msg</div>";
		$this->session->unset_userdata('blog_update_status');
	}
        else if ($blog_delete_msg!=NULL)
        {
		echo "<div class=\"message_style\">$blog_delete_msg</div>";
		$this->session->unset_userdata('blog_delete_status');
	}
        else if($password_change_status!=NULL)
	{
		echo "<div class=\"message_style\">$password_change_status</div>";
		$this->session->unset_userdata('password_update_status');
	}
?>
<?php 
	if (isset($myblogs))
        	foreach($myblogs as $new_row)
		{ 	
			echo '<div class="blog_cover">';
				echo '<div class="blog_cover_sub">';
					echo '<div class="blog_title">';
						print_r($new_row->title);
					echo '</div>';
					echo '<div class="blog_writer"><b>You';
						//print_r($new_row->login_name);
					echo '</b> Said on </div>';
					echo '<div class="blog_date">';
						print_r($new_row->date);
					echo '</div>';
					echo '<div class="blog_type">Blog Type:';
						
						print_r($new_row->blog_type);
					echo '</div>';
				echo '</div>';
				echo '<div class="blog_details">';
					
					print_r($new_row->details);
				echo '</div>';
				echo '<div class="blog_actions_cover">';
					echo anchor('bloger_controller/download_my_blog/'.$user_name.'/'.$new_row->blog_id, 'Download', 'class="blog_actions"');
					echo anchor('bloger_controller/draft_my_blog', 'Draft', 'class="blog_actions"');
					echo anchor('bloger_controller/delete_my_blog/'.$user_name.'/'.$new_row->blog_id, 'Delete', 'class="blog_actions"');
					echo anchor('bloger_controller/edit_my_blog/'.$user_name.'/'.$new_row->blog_id, 'Edit', 'class="blog_actions"');
				echo '</div>';
			echo '</div>';
		}
         
?>