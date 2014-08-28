<?php 
	$user_name=$this->session->userdata('bloger_login_name');
?>
<fieldset>
	<legend><b>Blog Edit Window</b></legend>
	<div class="cover">
	  	<div class="part1">
			<?php 
				echo form_open('bloger_controller/update_blog/'.$old_blog[0]->login_name.'/'.$old_blog[0]->blog_id);
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
					'value'       => $old_blog[0]->title,
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
              'value'       => $old_blog[0]->details,
              'rows'   		=> '8',
              'cols'        => '15',
              //'style'       => 'width:70%',
        );
			echo form_textarea($data);?>
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
		echo form_dropdown('blog_type',$options,$old_blog[0]->blog_type);
	?>
	  <div class="er"><?php echo form_error('blog_type'); ?></div>
    </div>
    
  </div>
  	
	<!--captcha start-->
	
		<?php 
				$vals = array(
					'word'	 => '',
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
	  <div class="part1"><?php echo form_label('Type The Word: ', 'captcha', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp";
				?>
				
	  </div>
	  <div class="part2">
		<input type="hidden" name="hidden_captcha" value="<?php echo $cap['word']; ?>" />
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
	<div class="buttton">
	  <?php
	
				//echo form_submit('Submit', 'Submit Info');
				$data = array(
		'name' => 'button',
		'id' => 'button',
		'value' => 'Update',
		'type' => 'submit',
		'content' => 'Update'
	);
	
	echo form_submit($data);
	
			?>
	</div>
</fieldset>