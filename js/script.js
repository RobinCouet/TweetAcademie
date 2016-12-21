$(document).ready(function(){

  $("#text-box").bind('input propertyChange', function (e) {
    var char = 140 - $("#text-box").val().length;
    if (char >= 0) {
      $("#nbr").removeClass("green");
      $("#nbr").removeClass("red");
      $("#nbr").addClass("green");
    }
    else {
      $("#nbr").removeClass("green");
      $("#nbr").removeClass("red");
      $("#nbr").addClass("red");
    }
    $("#nbr").html("Charactere restant : " + char);
  });

  $(".message_to_send").submit(function(e){

    e.preventDefault();

    var dest = $("li.tchatli.color").attr("id");
    var data = $(this).serialize() + '&user=' + dest;
    $.ajax({
      url: "http://localhost/Projet_Web_tweet_academie/messages/send",
      method: "GET",
      data : data,
      success: function(result) {
        $("#area").val("");     
      }});
  });

  $(".tchatli").click(function(e){

    $('.member ul li').removeClass('color'); 
    $(this).addClass('color'); 

    var data = 'user=' + $(this).attr("id");

    $.ajax({
      url: "http://localhost/Projet_Web_tweet_academie/messages/tchat",
      method: "GET",
      data : data,
      success: function(result) {
        $("#recu").html(result);
      }});
  });
});
