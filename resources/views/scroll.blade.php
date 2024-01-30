<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Up/Down Example</title>
  <style>
    body {
      height: 1500px; /* For demonstration purposes, add enough content to scroll */
    }

    #pageUp, #pageDown {
      position: fixed;
      bottom: 20px;
      right: 20px;
      font-size: 20px;
      cursor: pointer;
      z-index: 999; /* Increased z-index value */
    }
  </style>
</head>
<body>
  <!-- Your page content goes here -->

  <div id="pageUp" onclick="scrollPage(-1)">▲ Page Up</div>
  <div id="pageDown" onclick="scrollPage(1)">▼ Page Down</div>

  <script>
    function scrollPage(direction) {
      // Get the current scroll position
      var currentPosition = window.scrollY;

      // Calculate the new scroll position based on the direction (1 for down, -1 for up)
      var newPosition = currentPosition + direction * window.innerHeight;

      // Scroll smoothly to the new position
      window.scrollTo({
        top: newPosition,
        behavior: 'smooth'
      });
    }
  </script>
</body>
</html>
