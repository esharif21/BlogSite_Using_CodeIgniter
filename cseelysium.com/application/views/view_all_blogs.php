<?php 
        $bloger_id=$this->session->userdata('bloger_login_name');
        echo "<h2>Recent Blogs</h2>";
	foreach($data as $new_row)
		{ 	
			echo '<div class="blog_cover">';
                                echo '<div class="bloger_photo floatleft">';
                                    /*if($new_row->image_link=='Upload')
                                    {

                                    }*/
                                //print_r($bloger_image);
                                 foreach ($bloger_image as $each_image_link)
                                 {
                                     $imgsrc=$each_image_link->photo_link;
                                     if($each_image_link->login_name==$new_row->login_name)
                                         if($imgsrc!="")
                                             echo "<img src=\"$imgsrc\" />";
                                         else 
                                             echo "<img src=\"http://localhost/cseelysium.com/upload/empty.jpg\" />";

                                 }
                                echo '</div>';

                                echo '<div class="blog_cover_sub">';
                                        echo '<div class="blog_cover_sub_sub floatleft">';
                                            echo '<div class="blog_title_and_update_time_cover">';
                                                echo '<div class="blog_title floatleft">';
                                                        echo anchor('bloger_controller/view_blog_details/'.$new_row->blog_id,$new_row->title,'title="Read Details"');
                                                echo '</div>';
                                                echo '<div class="blog_last_update_time">';
                                                        if($new_row->date!=$new_row->last_update_date)
                                                        {
                                                            $time = $unix = mysql_to_unix($new_row->last_update_date);
                                                            //echo ; 
                                                            echo "  (Edited on: ".unix_to_human($time, TRUE, 'us').")";
                                                        }
                                                echo '</div>';
                                        echo '</div>';        
					echo '<div class="blog_writer"><b>';
						print_r($new_row->login_name);
					echo '</b> Said: </div>';
					echo '<div class="blog_date">';
                                                $time = time();
                                                $mysql = $new_row->date;
                                                $unix = mysql_to_unix($mysql);
                                                echo timespan($unix,$time)." ago.";
					echo '</div>';
					echo '<div class="blog_type">Blog Type:';
						
						print_r($new_row->blog_type);
					echo '</div>';
                                    echo '</div>';
				echo '</div>';
				echo '<div class="blog_details">';
					
                                
                                
                                
                                
                                
                                    //print_r($new_row->details);
                                    $str1=$new_row->details;
                                    $countt=strlen($str1);
                                    //echo $countt;
                                    //echo substr($str1,0,200);
                                    
                                    if($countt>=200)
                                    {
                                        echo substr($str1,0,200);
                                        echo "...".anchor('bloger_controller/view_blog_details/'.$new_row->blog_id,'Read Details');
                                    }
                                    else
                                        echo $str1;
                                    echo '</div>';
                                echo '<div class="blog_actions_cover">';
                                    $no_of_like=0;
                                    foreach ($likes as $like)
                                    {
                                        if($new_row->blog_id==$like->blog_id) 
                                            $no_of_like=$no_of_like+1;
                                    }
                                    if($bloger_id!="")
                                        echo anchor('bloger_controller/blog_like_add/'.$new_row->blog_id.'/'.$bloger_id,"Like($no_of_like)");
                                    else
                                        echo "Like($no_of_like)";
                                    $total_comment_for_this_blog=0;
                                    foreach ($comment as $eachcomment)
                                    {                                       
                                        if($new_row->blog_id==$eachcomment->blog_id)
                                            $total_comment_for_this_blog++;

                                    }
                                    echo " . Comments($total_comment_for_this_blog) . Has Been Read($new_row->read_count) times ";
                                    //print_r($comment);
				echo '</div>';
			echo '</div>';
		}
                /*$comm=$myClass->getcomments();
                print_r($comm);*/
                echo "<div class=\"pagination\">";
                    echo $this->pagination->create_links();
                echo "</div>";
?>