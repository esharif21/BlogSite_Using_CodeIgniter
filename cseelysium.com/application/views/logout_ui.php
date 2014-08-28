    <div class="side_boxes">
            <fieldset>
                    <legend>
                            <b>Logout</b>
                    </legend>
                    Welcome <b><?php echo $this->session->userdata('bloger_login_name'); ?></b>
                    <?php 
                            
                            $form_open_attributes = array('id' => 'logout_form');
                            echo form_open('bloger_controller/logout', $form_open_attributes);
                            
                            //echo form_submit('Submit', 'Submit Info');
                            $data = array(
                            'name' => 'login_button',
                            'id' => 'login_button',
                            'value' => 'Logout',
                            'type' => 'submit',
                            'content' => 'Enter'
                            );

                            echo form_submit($data);
                    ?>

            </fieldset>

    </div>