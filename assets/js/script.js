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
  setStartTime(videoID, username);
  updateProgressTimer(videoID, username);
}

function updateProgressTimer(videoID, username) {
  addDuration(videoID, username);
  var timer;

  $("video")
    .on("playing", function (event) {
      // console.log("hi");
      window.clearInterval(timer);
      timer = window.setInterval(function () {
        // console.log("hi") //executes every 3 seconds
        updateProgress(videoID, username, event.target.currentTime);
      }, 3000);
    })
    .on("ended", function () {
      window.clearInterval(timer);
      setFinished(videoID, username);
    });
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

function updateProgress(videoId, username, progress) {
  // console.log(progress);
  $.post(
    "ajax/updateDuration.php",
    { videoID: videoId, username: username, progress: progress },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}

function setFinished(videoId, username) {
  // console.log(progress);
  $.post(
    "ajax/setFinished.php",
    { videoID: videoId, username: username },
    function (data) {
      if (data !== null && data !== "") {
        alert(data);
      }
    }
  );
}

function setStartTime(videoId, username) {
  // console.log(progress);
  $.post(
    "ajax/getProgress.php",
    { videoID: videoId, username: username },
    function (data) {
      if (isNaN(data)) {
        alert(data);
        return;
      }
      $("video").on("canplay", function () {
        this.currentTime = data;
        $("video").off("canplay");
      });
    }
  );
}

function restartVideo() {
  $("video")[0].currentTime = 0;
  $("video")[0].play();
  $(".upNext").fadeOut();
}

function watchVideo(videoId){
  window.location.href = "watch.php?id="+videoId;
}

function showUpNext(){
  $(".upNext").fadeIn();
}
