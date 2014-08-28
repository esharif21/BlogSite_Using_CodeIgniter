<fieldset>
	<legend><b>Blog Window</b></legend>
        <div class="cover">
    <div class="part1">
      <?php 
			echo form_open('bloger_controller/update_data/'.$this->session->userdata('bloger_login_name'));
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
              'value'       => $old_data[0]->login_name,
			  'disabled'    => 'disabled',
			  'maxlength'   => '100',
              'size'        => '50',
        );?>
      <?php echo form_input($data); ?>
      <div class="er"><?php echo form_error('login_name'); ?> </div>
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
              'value'       => $old_data[0]->display_name,
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
		//email field
		
			echo form_label('Email: ', 'email', $attributes);
			echo "&nbsp&nbsp&nbsp&nbsp";?>
    </div>
    <div class="part2">
      <?php 
			$data = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => $old_data[0]->email,
              'maxlength'   => '100',
              'size'        => '50',
        );
			echo form_input($data);
		?>
      <div class="er"><?php echo form_error('email'); ?></div>
    </div>
  </div>
   <div class="buttton">
		<?php

			echo form_submit('Submit', 'Update Info');

		?>
	</div>
</fieldset>