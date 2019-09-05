$(document).ready(function() {
  $(".submit").click(function(event) {
    event.preventDefault();
    let postID = event.currentTarget.attributes[1].nodeValue
    let inside = ('p'+ postID);
    let insideP = event.currentTarget.attributes[0].nodeValue
    let edited = prompt("Please enter your new description:", insideP );
    if (edited === null) {
    return;
}
    $("p."+inside).text(edited)
    let param = {};
    param.content = edited;
    param.postID = postID;
    $.post({
          type: "POST",
          url: "modifyPost.php",
          data: param,
          success: function (response) {
            console.log(response);
          }
      });
        return false;
    });

    $(".titleSubmit").click(function(event) {
      event.preventDefault();
      let postID = event.currentTarget.attributes[1].nodeValue
      let inside = ('t'+ postID);
      let insideP = event.currentTarget.attributes[0].nodeValue
      let edited = prompt("Please enter your new title:", insideP );
      if (edited === null) {
      return;
  }
      $("p."+inside).text(edited)
      let param = {};
      param.title = edited;
      param.postID = postID;
      $.post({
            type: "POST",
            url: "modifyPost.php",
            data: param,
            success: function (response) {
              console.log(response);
            }
        });
          return false;
      });
    $(".pictureSubmit").click(function(event) {
      event.preventDefault();
      let postID = event.currentTarget.attributes[1].nodeValue
      let inside = ('m'+ postID);
      let insideP = event.currentTarget.attributes[0].nodeValue
      let edited = prompt("Link image adress here:", "photo adress.." );
      if (edited === null) {
      return; //break out of the function early
  }
      $("img."+inside).attr('src', edited)
      let param = {};
      param.picture = edited;
      param.postID = postID;
      $.post({
            type: "POST",
            url: "modifyPost.php",
            data: param,
            success: function (response) {
              console.log(response);
            }
        });
          return false;
      });
      $(".priceSubmit").click(function(event) {
        event.preventDefault();
        let postID = event.currentTarget.attributes[1].nodeValue
        let inside = ('r'+ postID);
        let insideP = event.currentTarget.attributes[0].nodeValue
        let edited = prompt("Please enter your new price(USD):", insideP );
        if (edited === null) {
        return;
    }
        $("p."+inside).text(edited)
        let param = {};
        param.price = edited;
        param.postID = postID;
        $.post({
              type: "POST",
              url: "modifyPost.php",
              data: param,
              success: function (response) {
                console.log(response);
              }
          });
            return false;
        });
  });

  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
