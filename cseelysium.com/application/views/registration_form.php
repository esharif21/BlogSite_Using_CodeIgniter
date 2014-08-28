<h1>Sign-Up Form Controls - With Default Options</h1>
<fieldset>
	<legend><b>Registration Form</b></legend>
	<div class="cover">
	  	<div class="part1">
			<?php 
				$attributes = array('class' => 'email', 'enctype' => 'multipart/form-data', 'id' => 'registration_form');
				echo form_open('bloger_controller/add_bloger', $attributes);
				
			//mobile field
				$attributes = array(
					'class' => 'mycustomclass',
					'style' => 'color: #000;',
				);
				echo form_label('Photo: ', 'photo', $attributes);
				?>
	  </div>
	  <div class="part2">
		<?php
				$data = array(
				  'name'        => 'file',
				  'id'          => 'file',
				  'value'       => '',
				  'type'		=> 'file',
				  'maxlength'   => '100',
				  'size'        => '50',
			);
				echo form_input($data);
				?>
		<div class="er"><?php echo form_error('photo'); ?></div>
	  </div>
	</div>
	<div class="cover">
		<div class="part1">
		<?php 			
				//echo form_open('bloger_controller/add_bloger');
				$attributes = array(
					'class' => 'mycustomclass',
					'style' => 'color: #000;',
				);
				echo form_label('Login Name: ', 'login_name', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp";
			?>
		</div>
	  	<div class="part2">
			<?php
				$data = array(
					'name'        => 'login_name',
					'id'          => 'login_name',
					'value'       => '',
					'maxlength'   => '100',
					'size'        => '50',
				);
			?>
			<?php echo form_input($data); ?>
			<div class="er"><?php echo form_error('login_name'); ?></div>
	  	</div>
	</div>
	
	<div class="cover">
	  <div class="part1">
		<?php
			
			//mobile field
				echo form_label('Display Name: ', 'display_name', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp"; ?>
	  </div>
	  <div class="part2">
		<?php
				$data = array(
				  'name'        => 'display_name',
				  'id'          => 'display_name',
				  'value'       => '',
				  'maxlength'   => '100',
				  'size'        => '50',
			);
				echo form_input($data);
				?>
		<div class="er"><?php echo form_error('display_name'); ?></div>
	  </div>
	</div>
	
	<div class="cover">
	  <div class="part1">
		<?php
			
			//mobile field
				echo form_label('Mobile: ', 'mobile', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp"; ?>
	  </div>
	  <div class="part2">
		<?php
				$data = array(
				  'name'        => 'mobile',
				  'id'          => 'mobile',
				  'value'       => '',
				  'maxlength'   => '100',
				  'size'        => '50',
			);
				echo form_input($data);
				?>
		<div class="er"><?php echo form_error('mobile'); ?></div>
	  </div>
	</div>
	
	<div class="cover">
	  <div class="part1">
		<?php
			//email field
			
				echo form_label('Email: ', 'email', $attributes);
				echo "&nbsp&nbsp&nbsp&nbsp";?>
	  </div>
	  <div class="part2">
		<?php 
				$data = array(
				  'name'        => 'email',
				  'id'          => 'email',
				  'value'       => '',
				  'maxlength'   => '100',
				  'size'        => '50',
			);
				echo form_input($data);
			?>
		<div class="er"><?php echo form_error('email'); ?></div>
	  </div>
	</div>
	
	
	
	<div class="cover">
    <div class="part1">
      <?php
		//confirm password field
		$attributes = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);
			echo form_label('Password: ', 'bloger_password', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";
			?>
    </div>
    <div class="part2">
      <?php
			$data = array(
              'name'        => 'bloger_password',
              'id'          => 'bloger_password',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50',
        );
			echo form_password($data);
			?>
      <div class="er"><?php echo form_error('bloger_password'); ?></div>
    </div>
  </div>
	
	
	
  <div class="cover">
    <div class="part1">
      <?php
		//confirm password field
		$attributes = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);
			echo form_label('Confirm Password: ', 'cpassword', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";
			?>
    </div>
    <div class="part2">
      <?php
			$data = array(
              'name'        => 'cpassword',
              'id'          => 'cpassword',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50',
        );
			echo form_password($data);
			?>
      <div class="er"><?php echo form_error('cpassword'); ?></div>
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
		<div id="captha_cover">
                    <div id="captcha_image">
                        <?php echo $cap['image']; echo "can't read?->reload"; ?>
                    </div>
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
		'value' => 'Submit Info',
		'type' => 'submit',
		'content' => 'Submit Info'
	);
	
	echo form_submit($data);
	
			?>
	</div>
</fieldset>