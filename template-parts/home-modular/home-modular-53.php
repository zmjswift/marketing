<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/swiper-bundle.min.css">
<section class="recent-post-section-swiper" style="background-color: #EEF0F2;">
  <div class="container">
    <?php if ($modular_title || $modular_describe) { ?>
      <div class="section-title" style="margin-bottom: 0px!important;">
        <?php if ($modular_title) {
          echo '<h2 style="content: none;">' . $modular_title . '</h2>';
        } ?>
        <?php if ($modular_describe) {
          echo '<p style="color: '.$mmodular_describe_color.';text-transform: none;">' . $modular_describe . '</p>';
        } ?>
      </div>
    <?php } ?>
    <div class="recent-post-section">
      <div class="container">
        <div class='swiper-container'>
          <div class='swiper-wrapper' style="padding-bottom: 30px;">
            <?php
            if (!empty($id['add_modular_53'])) {
              $i = '1';
              foreach ($id['add_modular_53'] as $value) :
            ?>
                <div class="swiper-slide">
                  <video id="video<?php echo $i++; ?>" muted playsinline webkit-playsinline>
                    <source src="<?php echo $value['modular_53_img']; ?>" type="video/mp4">
                  </video>
                  <div class="title">
                    <p><?php echo $value['modular_53_title']; ?></p>
                  </div>
                  <i class="fa fa-play-circle-o play-icon" style="font-size: 5rem;color: <?php $bgcolor = isset($id['modular_53_color']) ? $id['modular_53_color'] : '#007aff'; echo $bgcolor; ?>;opacity: 0.7;"></i>
                </div>
            <?php
              endforeach;
            }
            ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper('.swiper-container', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    on: {
      slideChange: function () {
        var videos = document.querySelectorAll('.swiper-slide video');
        videos.forEach(video => {
          video.pause();
        });
      },
    },
    breakpoints: {
      767: {
        slidesPerView: 1,
      },
      991: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 5,
      },
    },
  });

  document.querySelectorAll('.swiper-slide video').forEach(video => {
    video.addEventListener('mouseenter', function () {
      this.play();
    });
    video.addEventListener('mouseleave', function () {
      this.pause();
    });
  });

  var videoElements = document.querySelectorAll('.swiper-slide video');
  videoElements.forEach((video, index) => {
    video.addEventListener('click', function () {
      playVideo('video' + (index + 1));
    });
  });

  function playVideo(videoId) {
    var video = document.getElementById(videoId);
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  }
</script>

<div id="videoModal" class="modal">
  <span class="close">&times;</span>
  <video id="modalVideo" controls autoplay>
    <source src="" type="video/mp4">
  </video>
</div>

<script>
var modal = document.getElementById('videoModal');
var videos = document.querySelectorAll('.swiper-slide video');
var playIcons = document.querySelectorAll('.play-icon');

videos.forEach((video, index) => {
  video.addEventListener('click', function () {
    var modalVideo = document.getElementById('modalVideo');
    modalVideo.src = this.querySelector('source').src;
    modal.style.display = "block";
    modalVideo.classList.remove('controls-hidden');
    modalVideo.load();
  });
});

playIcons.forEach((icon, index) => {
  icon.addEventListener('click', function () {
    var modalVideo = document.getElementById('modalVideo');
    var videoIndex = index;
    var video = videos[videoIndex];
    var source = video.querySelector('source');
    if (source) {
      modalVideo.src = source.src;
      modal.style.display = "block";
      modalVideo.classList.remove('controls-hidden');
      modalVideo.load();
    }
  });
});

var span = document.getElementsByClassName("close")[0];

span.onclick = function () {
  modal.style.display = "none";
  var modalVideo = document.getElementById('modalVideo');
  modalVideo.pause();
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
    var modalVideo = document.getElementById('modalVideo');
    modalVideo.pause();
  }
};
</script>
<style>
.swiper-container {
  position: relative;
  overflow: hidden;
  list-style: none;
  padding: 0;
  z-index: 1;
}

.swiper-slide {
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
  transition: 300ms;
  transform: scale(0.9);
}

.swiper-backface-hidden .swiper-slide {
  transform: scale(0.9);
}

.title {
  position: absolute;
  bottom: -60px;
  left: 0;
  width: 100%;
  text-align: center;
}

.swiper-button-next,
.swiper-button-prev {
  color: <?php $bgcolor = isset($id['modular_53_color']) ? $id['modular_53_color'] : '#007aff';
  echo $bgcolor; ?>;
}

.swiper-container {
  width: 100%;
  padding: 0 10px;
}

.swiper-slide {
  text-align: center;
  font-size: 16px;
  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

video {
  height: auto;
  width: 100%;
  border-radius: 20px;
}

.swiper-button-next {
  right: 0px!important;
}

.swiper-button-prev {
  left: 0px!important;
}

.modal {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.9);
}

.modal video {
  margin: 80px auto;
  display: block;
  height: 75%;
  width: auto;
}

.modal video.controls-hidden::-webkit-media-controls {
  display: none !important;
}

.close {
  position: absolute;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  top: 10px;
  right: 25px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
/* 在视频容器上添加相对定位 */
.swiper-slide {
  position: relative;
}

/* 播放图标样式 */
.play-icon {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 60px;
  height: 60px;
  background: url('path_to_your_play_icon.png') no-repeat center;
  background-size: contain;
  cursor: pointer;
  z-index: 2;
}
</style>