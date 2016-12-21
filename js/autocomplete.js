$(document).ready(function() {

    $('.text_to_tweet').bind('input propertychange', function(e) {
        
        var string = $(this).val();
        var index = string.lastIndexOf("@");

        if (index > 0) {

            var data = string.substring(index+1);
            var final = "user=" + data;

            $.ajax({
              url: "http://localhost/Projet_Web_tweet_academie/home/users",
              method: "GET",
              data : final,
              success: function(result) {
                $(".suggestion").html(result); 
            }});
        }
    });
});