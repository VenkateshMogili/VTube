$(document).ready(function(){
  loadData();
});
  var loadData=function(){
    var video_i=document.getElementById("video_i").value;
    $.ajax({
      type:"GET",
      url:"comments_page.php?video="+video_i,
      dataType:"html",
      success:function(response){
        $("#comments_page").html(response);
        setTimeout(loadData,5000);
      }
    });
};
$(document).ready(function(){
    $("#search2").click(function(){
  $("#vcontent2").fadeIn("slow");
    $("#vcontent").fadeOut("fast");
    var keywords=document.getElementById("keyword");
    var keyword=document.getElementById("keyword").value;
    if ( $.trim( $('#keyword').val() ) == '' )
    {
      keywords.value="";
      keywords.focus();
      keywords.placeholder="Please Enter Something to Search";
    }
    else{
    document.getElementById("vid").pause();
    $("#searchresult").fadeIn("fast");
    $("#maincontent").fadeOut("fast");
      $("#searchresult").html("<center><img src='images/videoload.gif'><br><h3>Searching...</h3></center>");
    $("#searchresult").load("searchvideo.php?keyword="+keyword);
    }
  });
  $("#vmenu").click(function(){
    $("#vmenuvb").slideToggle("fast");
  });
   $("#cll,#subb").click(function(){
    $("#replies").slideUp("fast");
  });

  $("#search").click(function(){
    document.getElementById("vid").pause();
    var keywords=document.getElementById("keyword");
    var keyword=document.getElementById("keyword").value;
    if ( $.trim( $('#keyword').val() ) == '' )
    {
      keywords.value="";
      keywords.focus();
      keywords.placeholder="Please Enter Something to Search";
    }
    else{
    $("#searchresult").fadeIn("fast");
    $("#maincontent").fadeOut("fast");
      $("#searchresult").html("<center><img src='images/videoload.gif'><br><h3>Searching...</h3></center>");
    $("#searchresult").load("searchvideo.php?keyword="+keyword);
  }
  });
  $("#send_comment").click(function(){
    var comments=document.getElementById("comment");
    var comment=document.getElementById("comment").value;
    var comment2 = comment.replace(/ /g, '+');
    var video_i=document.getElementById("video_i").value;
    if ( $.trim( $('#comment').val() ) == '' )
    {
      comments.value="";
      comments.focus();
      comments.placeholder="Please Enter Something to Comment";
    }
    else{
    $("#sending_comment").fadeIn("slow");
      $("#sending_comment").html("<center><img src='images/loading2.gif'>Sending Comment...</center>");
    $("#sending_comment").load("sending_comment.php?comment="+comment2+"&&video_i="+video_i);
    var video_i2=document.getElementById("video_i").value;
    $("#comments_page").load("comments_page.php?video="+video_i2);
    document.getElementById("comment").value="";
  }
  });
});
$(window).ready(function(){
  window.load(function(){
  $("vcontent").load("etube.php");
});
});
$(document).on('click','.loadmorevideos2',function(){
    $(this).fadeOut("slow");
    $(this).text("Loading....");
    var ele=$(this).parent('li');
    var aval=document.getElementById("vgetlink").value;
    $.ajax({
      url:'loadmorevideos2.php?v='+aval,
      type:'POST',
      data: {
        pages:$(this).data('pages'),
      },
      success: function(response){
        if(response){
          ele.hide();
          $(".videos_list2").append(response);
        }
      }
    });
  });
function load_page(pageloc,pageid){	
    $("html, body").animate({ scrollTop: 0 }, 1000); 
    $("#vcontent2").fadeOut("fast");
    $("#vcontent").fadeIn("slow");
       $('#vcontent').html("<center><br><br><img src='images/loading.gif'><br><h4 style='color:white;'>Loading...</h4></center>").load(pageloc);       
}
function view_video(pageloc,pageid){  
    $("html, body").animate({ scrollTop: 0 }, 1000);
    $("#maincontent").fadeIn("fast");
      $("#searchresult").fadeOut("fast");
       $('#vidd').html("<center><div style='border-top:2px solid red;background-color:black;width:100%;height:500px;box-shadow:1px 2px 3px lightgray;'><br><br><br><img src='images/videoload.gif' style='border-radius:100px;width:100px;height:100px;'><br><i style='color:yellow;font-size:20px;font-family:georgia;'>Loading...</i></div></center>").load(pageloc);               
}
function view_main_video(pageloc,pageid){  
    $("html, body").animate({ scrollTop: 0 }, 1000);
       $('#vidd').html("<center><div style='border-top:2px solid red;background-color:black;width:100%;height:500px;box-shadow:1px 2px 3px lightgray;'><br><br><br><img src='images/videoload.gif' style='border-radius:100px;width:100px;height:100px;'><br><i style='color:yellow;font-size:20px;font-family:georgia;'>Loading...</i></div></center>").load(pageloc);               
}
function give_reply(pageloc,pageid){
    $("#replies").fadeIn("fast");
       $('#replies').html("<center><br><br><br><img src='images/videoload.gif' style='border-radius:100px;width:100px;height:100px;'><br><b style='color:black'>Loading...</b></center>").load(pageloc);               
}
$(document).on('click','.loadmorevideos',function(){
    $(this).fadeOut("slow");
    $(this).text("Loading....");
    var ele=$(this).parent('li');
    $.ajax({
      url:'loadmorevideos.php',
      type:'POST',
      data: {
        page:$(this).data('page'),
      },
      success: function(response){
        if(response){
          ele.hide();
          $(".videos_list").append(response);
        }
      }
    });
});
$(document).on('click','.loadmorevideos3',function(){
    $(this).fadeOut("slow");
    $(this).text("Loading.");
    $(this).fadeIn("slow");
    $(this).text("Loading..");
    $(this).fadeOut("slow");
    $(this).text("Loading...");
    $(this).fadeIn("slow");
    $(this).text("Loading....");
    $(this).fadeIn("slow");
    var ele=$(this).parent('li');
    var aval=document.getElementById("keyword").value;
    $.ajax({
      url:'loadmorevideos3.php?keyword='+aval,
      type:'POST',
      data: {
        page:$(this).data('page'),
      },
      success: function(response){
        if(response){
          ele.hide();
          $(".videos3_list").append(response);
        }
      }
    });
  });
$(document).on('click','.loadmorecomments',function(){
    $(this).text("Loading....");
    $(this).fadeOut("slow");
    var ele=$(this).parent('li');
    var aval=document.getElementById("video_i").value;
    $.ajax({
      url:'comments_loadmore_page.php?video='+aval,
      type:'POST',
      data: {
        page:$(this).data('page'),
      },
      success: function(response){
        if(response){
          ele.hide();
          $(".comments_list").append(response);
        }
      }
    });
  });
