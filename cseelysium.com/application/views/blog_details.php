<?php 
        $bloger_id=$this->session->userdata('bloger_login_name');
        //$obj $bloger_controller() =new bloger_controller();
        //$this->load->file('application/controllers/bloger_controller.php');
        //$obj = new Bloger_controller();
//        if(isset($bloger_id))
//        {
//            echo $bloger_id;
//        }
//                 
//         echo "123 ";      
        
                        //echo $one_blog[0]->details;
	
			//`blog_id`, `login_name`, `title`, `details`, `image_link`, `blog_type`, `date`, `status`SELECT * FROM `user_submited_blog_table` WHERE 1
			echo '<div class="blog_cover">';
                                echo '<div class="bloger_photo floatleft">';
                                    /*if($new_row->image_link=='Upload')
                                    {

                                    }*/
                                //print_r($bloger_image);
                                 foreach ($bloger_image as $each_image_link)
                                 {
                                     $imgsrc=$each_image_link->photo_link;
                                     if($each_image_link->login_name==$one_blog[0]->login_name)
                                         if($imgsrc!="")
                                             echo "<img src=\"$imgsrc\" />";
                                         else 
                                             echo "<img src=\"http://localhost/cseelysium.com/upload/empty.jpg\" />";

                                 }
                                echo '</div>';

                                echo '<div class="blog_cover_sub">';
                                    echo '<div class="blog_cover_sub_sub floatleft">';
					echo '<div class="blog_title">';
						print_r($one_blog[0]->title);
					echo '</div>';
					echo '<div class="blog_writer"><b>';
						print_r($one_blog[0]->login_name);
					echo '</b> Says on </div>';
					echo '<div class="blog_date">';
						print_r($one_blog[0]->date);
					echo '</div>';
					echo '<div class="blog_type">Blog Type:';
						
						print_r($one_blog[0]->blog_type);
					echo '</div>';
                                    echo '</div>';
				echo '</div>';
				echo '<div class="blog_details">';
                                    print_r($one_blog[0]->details);
                                echo '</div>';
                                echo '<div class="blog_actions_cover">';
                                    echo 'Like . Comment . Add To Faborite';
                                    foreach ($this_blog_comments as $eachcomment)
                                    {
                                        if($one_blog[0]->blog_id==$eachcomment->blog_id)
                                        {
                                            echo '<div class="comment_cover">';
                                                
                                                echo '<div class="commenter_photo">';
                                                //if(isset($eachcomment->photo_link))

                                                foreach ($bloger_image as $each_image_link)
                                                {
                                                    $imgsrc=$each_image_link->photo_link;
                                                    if($each_image_link->login_name==$eachcomment->login_name)
                                                    {
                                                        if($imgsrc!="")
                                                            echo "<img src=\"$imgsrc\" />";
                                                        else 
                                                            echo "<img src=\"http://localhost/cseelysium.com/upload/empty.jpg\" />";
                                                        echo '</div>';
                                                        echo '<div class="comment_cover_sub comment_box">';
                                                            echo '<div class="commenter_link_style">'.anchor("#","<b>$each_image_link->display_name</b> ").'</div>';
                                                            print_r($eachcomment->comment);
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }
                                                
                                        }                                        
                                    }
                                    //print_r($comment);
                                    if(isset($bloger_id))
                                    {
                                        $attributes = array('class' => 'comment', 'id' => 'comment_form');
                                        echo form_open('bloger_controller/add_comment/'.$bloger_id.'/'.$one_blog[0]->blog_id, 'Comment', 'class="blog_actions"', $attributes);
                                        //echo form_open('bloger_controller/add_comment/'.$bloger_id.'/'.$new_row->blog_id, 'Comment', 'class="blog_actions"');
                                        $property = array
                                        (
                                            'name'        => 'comment',
                                            'id'          => 'comment',
                                            'placeholder' => 'Write a comment...',
                                            'value'       => '',
                                            //'rows'        => '8',
                                            //'cols'        => '15',
                                            'style'       => 'width:70%',
                                        );
                                    echo form_input($property);
                                    //echo form_error('comment');
                                    /*$property = array
                                    (
                                        'class'=>'blog_actions',
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'Post',
                                        'type' => 'submit',
                                        'content' => 'Add Blog'
                                    );
                                    echo form_submit($property);*/
                                    echo form_close();
                                    }
                                    
				echo '</div>';
			echo '</div>';
                /*$comm=$myClass->getcomments();
                print_r($comm);*/
        
				
?>