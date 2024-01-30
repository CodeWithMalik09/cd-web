<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expandable Social Media Icons</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    #social-icon-container {
      position: fixed;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      background-color: #333;
      color: #fff;
      padding: 10px;
      cursor: pointer;
      z-index: 1000; /* Set a high z-index value */
    }

    #social-icons {
      display: none;
      flex-direction: column;
      align-items: flex-end;
    }

    .social-icon {
      margin: 5px;
      padding: 8px;
      background-color: #555;
      border-radius: 50%;
      font-size: 20px;
    }
  </style>
</head>
<body>

  <div id="social-icon-container">
    <div id="social-icons">
      <div class="social-icon">W</div>
      <div class="social-icon">T</div>
      <!-- Add more social media icons as needed -->
    </div>
    <div id="toggle-icon" class="social-icon">+</div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var socialIconsContainer = document.getElementById('social-icons');
      var toggleIcon = document.getElementById('toggle-icon');

      toggleIcon.addEventListener('click', function () {
        if (socialIconsContainer.style.display === 'flex') {
          socialIconsContainer.style.display = 'none';
        } else {
          socialIconsContainer.style.display = 'flex';
        }
      });
    });
  </script>

</body>
</html>
