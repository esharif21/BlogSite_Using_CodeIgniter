/* jquery for main menu bar*/ 
                    $(".menu ul li").removeClass("active");         
                    $(function () 
                    {             
                        var url = window.location.pathname;               
                        var activePage = url.substring(url.lastIndexOf('/') + 1);             
                        $('.menu ul li a').each(function () 
                        {        
                            var currentPage = this.href.substring(this.href.lastIndexOf('/') + 1);              
                            if (activePage == currentPage) 
                            {                
                                $(this).parent().addClass('active');                 
                            }             
                        });         
                    });
                    
                    
                    //add all jQuery codes
                    
                    $(document).ready(function()
                    {
                            //animating message notificaton
                            $('.message_style').animate({
                            opacity: 'hide',
                            }, 10000);
                            //table even/odd coloring
                           // $('#main tbody tr:even').css('background-color','#E8FAFE');
                            $('#main tbody tr:odd').css('background-color','#FFFFFF');
                            //$('#main tbody tr:even').css({'background-color': '#dddddd', 'color': '#fff'});//if multiple properties then it should be 2nd brace
                            $('#main tbody tr:even').css({
                            'background-color': '#F5F5F5'
                            });
                            
                            $('.tabs').tabs();
                            /*$('#tabs').tabs({
                            event: 'mouseover',
                            fx: {
                            opacity: 'toggle',
                            duration: 'fast'
                            },
                            spinner: 'Loading...',
                            cache: true
                            });
                            $('#tabs-nav li').click(function(event) {
                            event.preventDefault();
                            $('#tabs p').hide();
                            $('#tabs-nav .current').removeClass("current");
                            $(this).addClass('current');
                            var clicked = $(this).find('a:first').attr('href');
                            $('#tabs ' + clicked).fadeIn('fast');
                            }).eq(0).addClass('current');
                            */
                /*============== blog archival by date ==================*/
                                            $(".menu_body").hide();
                        //toggle the componenet with class menu_body
                        $(".menu_head").click(function()
                        {
                            $(this).next(".menu_body").slideToggle(600);
                            var plusmin;
                            plusmin = $(this).children(".plusminus").text();

                            if( plusmin == '(+)')
                                $(this).children(".plusminus").text('(-)');
                            else
                                $(this).children(".plusminus").text('(+)');
                        });
                        $(".menu_body_month").hide();
                        $(".menu_head_month").click(function()
                        {
                            $(this).next(".menu_body_month").slideToggle(600);
                            var plusmin;
                            plusmin = $(this).children(".plusminus").text();

                            if( plusmin == '(+)')
                                $(this).children(".plusminus").text('(-)');
                            else
                                $(this).children(".plusminus").text('(+)');
                        });
                    });
                    
//other jQuery scripts for testing


function showMsg()
{
    alert("First js example!");
    //$('#content').progressbar();
    
}