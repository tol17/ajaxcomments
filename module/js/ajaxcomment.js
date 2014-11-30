/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
           $(document).ready(function(){
              
                $('body').append('<div id="blackout"></div>');
                $('body').append('<div id="commentform">Just a moment...</div>');
                var boxWidth = 410;

                function closeForm() {
                    var scrollPos = $(window).scrollTop();
                    /* Hide the popup and blackout when clicking outside the popup */
                    $('#commentform').hide(); 
                    $('#blackout').hide(); 
                    $("html,body").css("overflow","auto");
                    $('html').scrollTop(scrollPos);
                    $('#commentform').html('<div "id=commentform">Just a moment...</div>');
                }
               
                function centerBox() {

                    /* Preliminary information */
                    var winWidth = $(window).width();
                    var winHeight = $(document).height();
                    var scrollPos = $(window).scrollTop();
                    /* auto scroll bug */

                    /* Calculate positions */

                    boxWidth = winWidth * 0.6;
                    var disWidth = (winWidth - boxWidth) / 2;
                    var disHeight = scrollPos + 120;

                    /* Move stuff about */
                    $('#commentform').css({'width' : boxWidth+'px', 'left' : disWidth+'px', 'top' : disHeight+'px'});
                    $('#blackout').css({'width' : winWidth+'px', 'height' : winHeight+'px'});

                    return false;
                }

                $(window).resize(centerBox);
                $(window).scroll(centerBox);
                centerBox();	

                $('#comment').click(function(e) {

                    /* Prevent default actions */
                    e.preventDefault();
                    e.stopPropagation();

                    var scrollPos = $(window).scrollTop();

                     /* Show the correct popup box, show the blackout and disable scrolling */
                    $.ajax({
                        "url": "index.php?option=com_comment&view=commentform&format=raw",
                        "dataType": "html",
                        "cache": false,
                        "success": function(html){
                            //Add comment form
                            $('#commentform').html(html);
                            var baseUrl;
                            var appUrl;

                            baseUrl = document.location.href;
                            baseUrl = baseUrl.substring(0, baseUrl.lastIndexOf('/'));
                            appUrl = baseUrl.substring(0, baseUrl.lastIndexOf('/'));
                           
                            $.getScript(appUrl + '/components/com_comment/assets/js/ajaxform.js', function(){
                    
                            });
                        },
                    });
                     
                    $('#commentform').show();
                    $('#blackout').show();
                    $('html,body').css('overflow', 'hidden');

                    /* Fixes a bug in Firefox */
                    $('html').scrollTop(scrollPos);
                });
                $('#commentform').click(function(e) { 
                    /* Stop the link working normally on click if it's linked to a popup */
                    e.stopPropagation(); 
                });
                $('html').click(function() { 
                    closeForm();
                });
            });
        })(jQuery);


