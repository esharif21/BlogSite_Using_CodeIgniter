<?php
    $password_change_status=$this->session->userdata('password_update_status');
    if($password_change_status!=NULL)
	{
		echo "<div class=\"message_style\">$password_change_status</div>";
		$this->session->unset_userdata('password_update_status');
	}
?>
<fieldset>
	<legend><b>Change Your Password</b></legend>
        <div class="cover">
    <div class="part1">
      <?php 
			echo form_open('bloger_controller/change_bloger_password/'.$this->session->userdata('bloger_login_name'));
			//name field
			$attributes = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);
			echo form_label('Login Name: ', 'login_name', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";?>
    </div>
    <div class="part2">
      <?php

			$data = array(
              'name'        => 'login_name',
              'id'          => 'login_name',
              'value'       => $old_info[0]->login_name,
			  'disabled'    => 'disabled',
			  'maxlength'   => '100',
              'size'        => '50',
        );?>
      <?php echo form_input($data); ?>
    </div>
  </div>
  <div class="cover">
    <div class="part1">
      <?php
			echo form_label('Old Password: ', 'old_password', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";?>
    </div>
    <div class="part2">
      <?php 
			$data = array(
              'name'        => 'old_password',
              'id'          => 'old_password',
              'value'       => '',
              'size'        => '50',
        );
			echo form_password($data);
		?>
      <div class="er"><?php echo form_error('old_password'); ?></div>
    </div>
  </div>
  <div class="cover">
    <div class="part1">
      <?php
		//email field
		
			echo form_label('Current Password: ', 'current_password', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";?>
    </div>
    <div class="part2">
      <?php 
			$data = array(
              'name'        => 'current_password',
              'id'          => 'current_password',
              'value'       => '',
              'size'        => '50',
        );
			echo form_password($data);
		?>
      <div class="er"><?php echo form_error('current_password'); ?></div>
    </div>
  </div>
  <div class="cover">
    <div class="part1">
      <?php
		//email field
		
			echo form_label('Confirm Password: ', 'confirm_password', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";?>
    </div>
    <div class="part2">
      <?php 
			$data = array(
              'name'        => 'confirm_password',
              'id'          => 'confirm_password',
              'value'       => '',
              'size'        => '50',
        );
			echo form_password($data);
		?>
      <div class="er"><?php echo form_error('confirm_password'); ?></div>
    </div>
  </div>
   <div class="buttton">
		<?php
			echo form_submit('Submit', 'Change');
		?>
	</div>
</fieldset>