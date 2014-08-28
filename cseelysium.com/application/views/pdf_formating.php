<img src="http://localhost/cseelysium.com/upload/sharif.jpg" />
    <?php
echo "<h2>Hello ".$one_blog_for_pdf[0]->login_name."!</h2><b>This is the blog you've downloaded</b><br />";
echo "Title: <b><u>".$one_blog_for_pdf[0]->title."</u></b><br />";
echo "Submitted on: <b>".$one_blog_for_pdf[0]->date.". </b><br />Blog Type: <b>".$one_blog_for_pdf[0]->blog_type.".</b><br />";

echo "Details: ".$one_blog_for_pdf[0]->details."<br /><br /><br />";
echo "<h4>Thank you Buddy!</h4>";
echo "<h5>Click ".base_url('')." for more.</h5>";  
?>
