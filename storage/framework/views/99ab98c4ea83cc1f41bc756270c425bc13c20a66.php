<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    .social-container {
      position: fixed;
      top: 70%;
      right: 0;
      transform: translateY(-70%);
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      z-index: 9999;
    }

    .social-box {
      position: relative;
      width: 67px;
      height: 67px;
      background-color: #3498db;
      margin-bottom: 20px;
      overflow: hidden;
      transition: width 0.3s ease;
      cursor: pointer;
      border-radius: 5px;
    }

    .social-box.expanded {
      width: 240px;
    }

    .social-icon {
      color: #fff;
      font-size: 24px;
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      z-index: 1;
    }
    .close-icon {
    position: absolute;
    top: 5px;
    left: 10px;
    color: #fff;
    font-size: 12px;
    cursor: pointer;
    display: none; /* Hide the close icon by default */
  }

  .social-box.expanded .close-icon {
    display: block; /* Show the close icon when the social box is expanded */
  }


    .social-text {
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background-color: #2c3e50;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 14px;
      transition: left 0.3s ease;
      z-index: 0;
      font-family: nunito;
    }

    .social-box.expanded .social-text {
      left: 0;
    }
  </style>
</head>
<body>

  <div class="social-container">
    <div class="social-box" onclick="toggleExpand(this)" style="background-color: green">
      <i class="fab fa-whatsapp social-icon" style="margin-left:10px"></i>

      <div class="social-text"><a href="https://whatsapp.com/channel/0029VaEarzB4tRrkLCa9ez2p" style="color:white">Join us on WhatsApp</a></div>
      <i class="fas fa-times close-icon"></i>
    </div>

    <div class="social-box" style="margin-top: -10px;" onclick="toggleExpand(this)">
      <center><i class="fab fa-facebook social-icon"  style="margin-left:10px"></i></center>

      <div class="social-text">
        <a href="https://www.facebook.com/coachingdetail/" style="color:white">
        Join us on Facebook</a></div>
        <i class="fas fa-times close-icon"></i>
    </div>

    <div class="social-box" style="margin-top: -10px;background-color:#2c3e50" onclick="toggleExpand(this)">
     <img src="<?php echo e(asset('img/play.png')); ?>" alt="" style="height:25px;width:25px;margin-left:12px" class="social-icon">

     <div class="social-text"><a class="app-link" href="https://play.google.com/store/apps/details?id=com.coachingdetail.app" style="color:white">Download App</a></div>
     <i class="fas fa-times close-icon"></i>
    </div>
  </div>

  <script>
    function toggleExpand(element) {
      element.classList.toggle('expanded');

    }
  </script>

  <!-- Add your page content here -->

</body>
</html>
<?php /**PATH C:\Users\asus\Downloads\cd\resources\views/social_media.blade.php ENDPATH**/ ?>