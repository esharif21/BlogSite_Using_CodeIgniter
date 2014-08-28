 
<?php
$user_name = $this->session->userdata('bloger_login_name');
?>
<div class="bloger_header">
    <div class="header_cover">
        <div class="cover_photo"></div>
        <div class="bloger_img floatleft"><img src="<?php echo $profile_photo_link; ?>" alt="<?php echo $user_name;?>" /></div>
        <div class="bloger_statistics floatright">
            <fieldset>
                <legend>Bloger Statistics</legend>
                <table>
                    <th>Member Since</th><th>Posts</th><th>Comments Given</th><th>Comments Got</th><th>Like Given</th><th>Like Got</th>
                    <?php echo "<tr><td>$member_since</td><td>$total_posts</td><td>$total_comments_given</td><td>$total_comments_got</td><td>$total_likes_given</td><td>$total_likes_got</td></tr>"; ?>
                </table>
            </fieldset>
        </div>
    </div>
    <div class="bloger_menubar">
        <?php
        echo anchor('bloger_controller/view_bloger_password_ui/' . $this->session->userdata('bloger_login_name'), 'Change Password', 'class="bloger_menu_item"');
        echo anchor('bloger_controller/view_bloger_profile/' . $this->session->userdata('bloger_login_name'), 'My Profile', 'class="bloger_menu_item"');
        echo anchor('bloger_controller/view_blog_ui/' . $this->session->userdata('bloger_login_name'), 'Add New Blog', 'class="bloger_menu_item"');
        echo anchor('bloger_controller/my_blogs/' . $this->session->userdata('bloger_login_name'), 'My Blogs', 'class="bloger_menu_item"');
        ?>
    </div>
</div>
<?php
    echo "<h1>Welcome Mr. $user_name</h1>";
?>