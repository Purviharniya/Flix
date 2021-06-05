function volumeToggle(button) {
  var muted = $(".preview-video").prop("muted");
  $(".preview-video").prop("muted", !muted);
  $(button).find("i").toggleClass("fa-volume-mute");
  $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnded() {
  $(".preview-video").toggle();
  $(".preview-image").toggle();
  $(".preview-image").removeAttr("hidden");
}

function goBack() {
  window.history.back();
}

function startHideTimer() {
  var timeout = null;

  $(document).on("mousemove", function () {
    clearTimeout(timeout);
    $(".watchNav").fadeIn();

    timeout = setTimeout(function () {
      $(".watchNav").fadeOut();
    }, 1100);
  });
}

function initVideo(videoID, username) {
  startHideTimer();
  // console.log(videoID,username);
  updateProgressTimer(videoID, username);
}

function updateProgressTimer(videoID, username) {
  addDuration(videoID, username);
  var timer ;

  $("video").on("playing",function(event){
      // console.log("hi");
      window.clearInterval(timer);
      timer = window.setInterval(function(){

      },3000);
  }).on("ended",function(){
    window.clearInterval(timer);
  })
}

function addDuration(videoID, username) {
  $.post(
    "ajax/addDuration.php",
    { videoID: videoID, username: username },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}
