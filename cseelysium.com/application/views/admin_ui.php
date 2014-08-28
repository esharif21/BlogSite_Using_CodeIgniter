<?php 
        $blog_update_status_msg=$this->session->userdata('blog_update_status_msg');
	if($blog_update_status_msg!="")
	{
		echo "<div class=\"message_style\">$blog_update_status_msg</div>";
		$this->session->unset_userdata('blog_update_status_msg');
	}
        $bloger_update_status_msg=$this->session->userdata('bloger_update_status_msg');
	if($bloger_update_status_msg!="")
	{
		echo "<div class=\"message_style\">$bloger_update_status_msg</div>";
		$this->session->unset_userdata('bloger_update_status_msg');
	}
?>
<fieldset>
    <legend>admin ui</legend>
    how are u boss!
    
    
       <div class="tabs">
	<ul>
		<li><a href="#tabs-1">Manage Blog</a></li>
		<li><a href="#tabs-2">Manage Bloger</a></li>
		<li><a href="#tabs-3">Manage Poll</a></li>
	</ul>
	<div id="tabs-1">
            <table border="1px">
                <th>Blog Id</th><th>Login Name</th><th>Title</th><th>Image Link</th><th>Blog Type</th><th>Date</th><th>Update Date</th><th>Read Count</th><th>DETAILS</th><th>DELETE</th><th>HIDE</th>
            <?php //print_r($all_blogs); 
            foreach($all_blogs as $new_row)
                        { 	
                                echo '<tr>';
                                        echo '<td>';
                                                print_r($new_row->blog_id);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->login_name);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->title);
                                        echo '</td>';
        //				echo '<td>';
        //					print_r($new_row->details);
        //				echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->image_link);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->blog_type);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->date);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->last_update_date);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($new_row->read_count);
                                        echo '</td>';
                                        echo '<td><center>'; 
                                                echo anchor('bloger_controller/view_blog_details/'.$new_row->blog_id,'Details');
                                        echo '</center></td>';
                                        echo '<td><center>'; 
                                                echo anchor('bloger_controller/parmanently_delete/'.$new_row->blog_id,'Delete');
                                        echo '</center></td>';
                                        echo '<td><center>'; 
                                                if($new_row->status==1)
                                                    echo anchor('bloger_controller/hide_show_blog/'.$new_row->blog_id.'/'.$new_row->status,'Hide');
                                                else if($new_row->status==0)
                                                    echo anchor('bloger_controller/hide_show_blog/'.$new_row->blog_id.'/'.$new_row->status,'Show');
                                        echo '</center></td>';
                                echo '</tr>';
                        }


            ?>
            </table>

        </div>
           <div id="tabs-2">
               <table border="1px">
                <th>Login Name</th><th>Display Name</th><th>Mobile</th><th>Email</th><th>Total Blogs</th><th>DETAILS</th><th>HIDE</th><th>BLOCK</th>
            <?php //print_r($all_blogs); 
            //`login_name`, `display_name`, `photo_link`, `mobile`, `email`, `password`, `status`SELECT * FROM `bloger_registration_table` WHERE 1
            foreach($all_blogers as $each_bloger)
                        { 	
                                echo '<tr>';
                                        echo '<td>';
                                                print_r($each_bloger->login_name);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($each_bloger->display_name);
                                        echo '</td>';
        //				echo '<td>';
        //					print_r($new_row->details);
        //				echo '</td>';
                                        echo '<td>';
                                                print_r($each_bloger->mobile);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r($each_bloger->email);
                                        echo '</td>';
                                        echo '<td>';
                                                print_r(0);
                                        echo '</td>';
                                        echo '<td><center>'; 
                                                echo anchor('bloger_controller/view_bloger_profile/'.$each_bloger->login_name,'Details');
                                        echo '</center></td>';
                                        echo '<td><center>'; 
                                                if($each_bloger->status==1)
                                                    echo anchor('bloger_controller/hide_show_bloger/'.$each_bloger->login_name.'/'.$each_bloger->status,'Hide');
                                                else if($each_bloger->status==0)
                                                    echo anchor('bloger_controller/hide_show_bloger/'.$each_bloger->login_name.'/'.$each_bloger->status,'Show');
                                        echo '</center></td>';
                                        echo '<td><center>'; 
                                                echo anchor('bloger_controller/delete_bloger/'.$each_bloger->login_name,'Block');
                                        echo '</center></td>';
                                echo '</tr>';
                        }


            ?>
            </table>

               <?php 
           $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('bloger_controller/view_admin_ui', 'Click Me!', $atts);

           ?></div>
	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>

    
                            
</fieldset>