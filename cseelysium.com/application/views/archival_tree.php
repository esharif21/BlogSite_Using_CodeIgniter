
    <div class="side_boxes">
        
        <fieldset>
        <legend>Blogs By Date</legend>
            <div class="menu_container">
                <?php 
                        $count_year12=0;
                        $count_year13=0;
                        $count_year14=0;
                        $count_year15=0;
                        $count_year16=0;
                        
                        $count_month1=0;
                        $count_month2=0;
                        $count_month3=0;
                        $count_month4=0;
                        $count_month5=0;
                        $count_month6=0;
                        $count_month7=0;
                        $count_month8=0;
                        $count_month9=0;
                        $count_month10=0;
                        $count_month11=0;
                        $count_month12=0;
                        foreach ($all_blogs as $each_blog)
                        {
                            $temp_date=$each_blog->date;
                            //echo $temp_date."<br />";
                            $temp_year=substr($temp_date,0,4);
                            $temp_month=substr($temp_date,5,2);
                            if($temp_year=="2013")
                            {
                                if($temp_month=="12")
                                    $count_month12++;
                                $count_year13++;
                            }
                            if($temp_year=="2014")
                            {
                                if($temp_month=="01")
                                    $count_month1++;
                                $count_year14++;
                            }
                            if($temp_year=="2015")
                            {
                                if($temp_month=="12")
                                    $count_month12++;
                                $count_year15++;
                            }
                        }
                        
                        if($count_year13>0)
                        {
                            echo "<p class=\"menu_head\">2013<span class=\"plusminus\">(+)</span></p>";
                            $temp_month=substr($temp_date,5,2);
                            echo "<div class=\"menu_body\" style=\"display: none;\">";
                                echo "<p class=\"menu_head_month\">nov<span class=\"plusminus\">(+)</span></p>";
                                echo "<div class=\"menu_body_month\" style=\"display: none;\">";
                                    do
                                    {
                                        echo "<a>How to install jQuery-LEARN!</a>";
                                        $count_month12--;
                                    }while ($count_month12>0); 
                                echo "</div>";
                            echo "</div>";
                        }
                ?>
                <p class="menu_head">2014<span class="plusminus">(+)</span></p>
                <div class="menu_body" style="display: none;">
                    <p class="menu_head_month">November<span class="plusminus">(+)</span></p>
                    <div class="menu_body_month" style="display: none;">
                        <a>How to install jQuery-LEARN!</a>
                        <a>Hello World Blog!</a>
                    </div>
                    <p class="menu_head_month">December<span class="plusminus">(+)</span></p>
                    <div class="menu_body_month" style="display: none;">
                        <a>My 2nd Blog</a>
                    </div>                                            
                </div>
                <p class="menu_head">2015<span class="plusminus">(+)</span></p>
                <div class="menu_body" style="display: none;">
                    <p class="menu_head_month">January<span class="plusminus">(+)</span></p>
                    <div class="menu_body_month" style="display: none;">
                        <a>How to install jQuery-LEARN!</a>
                        <a>Hello World Blog!</a>
                    </div>
                    <p class="menu_head_month">February<span class="plusminus">(+)</span></p>
                    <div class="menu_body_month" style="display: none;">
                        <p>My 2nd Blog</p>
                    </div>                                            
                </div>


            </div>
        </fieldset>
    </div>