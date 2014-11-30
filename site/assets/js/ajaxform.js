/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
(function($) {
    $(document).ready(function(){
              
        $('#btnclose').click(function(e) {
            e.preventDefault();
            
            var scrollPos = $(window).scrollTop();
            /* Hide the popup and blackout when clicking outside the popup */
            $('#commentform').hide(); 
            $('#blackout').hide(); 
            $("html,body").css("overflow","auto");
            $('html').scrollTop(scrollPos);
            $('#commentform').html('<div "id=commentform">Just a moment...</div>');
        });

        $('#form-commentform').submit(function(e) {
            e.preventDefault();
            e.stopPropagation();

            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);

            $.ajax({
                "url": formURL,
                "dataType": "html",
                "data": formData,
                "mimeType": "multipart/form-data",
                "type": "POST",
                "cache": false,
                "contentType": false,
                "processData":false,
                "success": function(html){
                    $('#commentform').html(html);
                    
                    var baseUrl;
                    var appUrl;

                    baseUrl = document.location.href;
                    baseUrl = baseUrl.substring(0, baseUrl.lastIndexOf('/'));
                    appUrl = baseUrl.substring(0, baseUrl.lastIndexOf('/'));
                    $.getScript(appUrl + '/components/com_comment/assets/js/ajaxform.js', function(){
                    
                    });
                },
                "error": function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                } 
            });
        });
    });
})(jQuery);


