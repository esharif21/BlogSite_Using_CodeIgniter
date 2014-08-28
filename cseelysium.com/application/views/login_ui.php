<?php 
    if(isset($login_error))
        echo $login_error;
?>

<div class="side_boxes">
            <fieldset>
                    <legend>
                            <b>Login</b>
                    </legend>
                    <?php
                    
                            $form_open_attributes = array('id' => 'login_form');
                            echo form_open('bloger_controller/bloger_login_check', $form_open_attributes);
                            $data = array(
                                    'name'        => 'bloger_name',
                                    'id'          => 'bloger_name',
                                    'placeholder' => 'Write Login Name',
                                    'value'       => '',
                                    'maxlength'   => '100',
                                    'size'        => '50',
                            );
                            echo form_input($data)."<br />";
                            echo form_error('bloger_name');


                            $data = array(
                                    'name'		=> 'bloger_pass',
                                    'id'		=> 'bloger_pass',
                                    'placeholder'	=> 'Password',
                                    'value'		=>'',
                                    'maxlength' =>'30',
                            );
                            echo form_password($data)."<br />";
                            echo form_error('bloger_pass');

                    ?>

                            Not a member? <?php echo anchor('home_controller/view_registration_form','Sign-Up'); ?><br /><br />

                    <?php

                            //echo form_submit('Submit', 'Submit Info');
                            $data = array(
                            'name' => 'login_button',
                            'id' => 'login_button',
                            'value' => 'Enter',
                            'type' => 'submit',
                            'content' => 'Enter'
                            );

                            echo form_submit($data);
                            echo form_close();
                    ?>

            </fieldset>

    </div>