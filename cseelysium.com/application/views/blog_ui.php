<?php 
	$user_name=$this->session->userdata('bloger_login_name');
	$msg=$this->session->userdata('info_update_status');
	if(isset($msg))
	{
		echo "<h2>$msg</h2>";
		$this->session->unset_userdata('info_update_status');
	}
?>
<fieldset>
	<legend><b>Blog Window</b></legend>
	<div class="cover">
	  	<div class="part1">
			<?php 
				echo form_open('bloger_controller/add_your_blog/');
				$attributes = array(
					'class' => 'mycustomclass',
					'style' => 'color: #000;',
				);
				echo form_label('Blog Title: ', 'title', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp";
			?>
		</div>
	  	<div class="part2">
			<?php
				$data = array(
					'name'        => 'title',
					'id'          => 'title',
					'value'       => '',
					'size'        => '50',
				);
			?>
			<?php echo form_input($data); ?>
			<div class="er"><?php echo form_error('title'); ?></div>
	  	</div>
	</div>
	
	
	<div class="textarea_cover">
    <div class="part1">
      <?php 
			echo form_label('Write Story: ', 'details', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";
		?>
    </div>
    <div class="part2">
      <?php 
			$data = array(
              'name'        => 'details',
              'id'          => 'details',
              'value'       => '',
              'rows'   		=> '8',
              'cols'        => '15',
              //'style'       => 'width:70%',
        );
			echo form_textarea($data);
                        
                        
                        echo display_ckeditor($editor['ckeditor']);
                        
                        
                        ?>
      <div class="er"><?php echo form_error('details'); ?></div>
    </div>
  </div>
  
	<div class="cover">
    <div class="part1">
      <!--		hobby field-->
      <?php echo form_label('Blog Type: ', 'blog_type', $attributes);	echo "&nbsp&nbsp&nbsp&nbsp"; ?> </div>
    <div class="part2">
        <?php
		$options = array(
			''=>'--Select--',
			'Computer'=>'Computer',
			'Apps'=>'Apps',
			'Others'=> 'Others',
		);
		echo form_dropdown('blog_type',$options);
	?>
        <div class="er"><?php echo form_error('blog_type'); ?></div>
    </div>
    
  </div>
  	
	<!--captcha start-->
	 <a id="refresh" href="#">bb</a>

<script>
    $(function() {
      $("#randomdiv").click(function(evt) {
        location.reload();
         evt.preventDefault();
      });
    });
</script>
<div id="randomdiv">
    <a id="refresh" href="#">click</a>
		<?php 
                                $time4captcha=  date('s m s');
				$vals = array(
					'word'	 => $time4captcha,
                                        //'word'          =>'',
					'img_path'	 => './captcha/',
					'img_url'	 => 'http://localhost/cseelysium.com/captcha/',
					'font_path'	 => 'http://localhost/cseelysium.com/fonts/impact.ttf',
					'img_width'	 => '200',
					'img_height' => 45,
					'expiration' => 7200
					);		
				$cap = create_captcha($vals);
	
			?>
       

		<div id="captha_cover"><div id="captcha_image"><?php echo $cap['image']; echo "can't read?->reload"; ?></div>
	  
	 
		<input type="hidden" name="hidden_captcha" value="<?php echo $cap['word']; ?>" />
		
	  </div>
	</div>
    
<div id="captha_cover">
	  <div class="part1"><?php echo form_label('Type The Word: ', 'captcha', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp";
				?>
				
	  </div>
	  <div class="part2">
	
		<?php 			
				$data = array(
				  'name'        => 'captcha',
				  'id'          => 'captcha',
				  'value'       => '',
				  'maxlength'   => '100',
				  'size'        => '50',
		   );
				echo form_input($data);
				
		  ?>
		
		<div class="er"><?php echo form_error('captcha'); ?></div>
	  </div>
	</div>
	<!--captcha end-->
	<div class="login_button">
	  <?php
	
				//echo form_submit('Submit', 'Submit Info');
				$data = array(
		'name' => 'button',
		'id' => 'button',
		'value' => 'Add Blog',
		'type' => 'submit',
		'content' => 'Add Blog'
	);
	
	echo form_submit($data);
	
			?>
	</div>
</fieldset>