<!--<div class="side_boxes_tab">
    Blogs Order By Most-
    <div class="tabs">
        <ul>
            <li><a href="#tab1">Read</a></li>
            <li><a href="#tab2">Comments</a></li>
        </ul>
        <div id="tab1">
            //<?php
//            foreach ($blogs_order_by_read as $each_blog_by_read)
//                echo "<li class=\"fontsize8\">" . anchor('bloger_controller/view_blog_details/' . $each_blog_by_read->blog_id, $each_blog_by_read->title . '(' . $each_blog_by_read->read_count . ')', 'title="Read Details"') . "</li>";
//            ?>
        </div>
        <div id="tab2">
            //<?php
//            foreach ($blogs_order_by_comment as $each_blog_by_comment)
//                echo "<li class=\"fontsize8\">" . anchor('bloger_controller/view_blog_details/' . $each_blog_by_comment->blog_id, $each_blog_by_comment->title . '(' . $each_blog_by_comment->comment_count . ')', 'title="Read Details"') . "</li>";
//            ?>
        </div>
    </div>
</div>-->
<div class="side_boxes">
                        <fieldset>
                            <legend>Most Read Blogs</legend>
                                 <?php
            foreach ($blogs_order_by_read as $each_blog_by_read)
                echo "<li class=\"fontsize8\">" . anchor('bloger_controller/view_blog_details/' . $each_blog_by_read->blog_id, $each_blog_by_read->title . '(' . $each_blog_by_read->read_count . ')', 'title="Read Details"') . "</li>";
            
            
                    echo $this->pagination->create_links();
               
            
            ?>
                        </fieldset>
</div>
<div class="side_boxes">
                        <fieldset>
                            <legend>Most Comments Blogs</legend>
                                 <?php
            foreach ($blogs_order_by_comment as $each_blog_by_comment)
                echo "<li class=\"fontsize8\">" . anchor('bloger_controller/view_blog_details/' . $each_blog_by_comment->blog_id, $each_blog_by_comment->title . '(' . $each_blog_by_comment->comment_count . ')', 'title="Read Details"') . "</li>";
            echo $this->pagination->create_links();
            ?>
                        </fieldset>
</div>