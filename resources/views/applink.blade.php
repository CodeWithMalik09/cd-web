<head>
    <!-- Include your CSS styles here to style the floating button -->
    <style>
        /* CSS to style the floating button */
/* CSS to style the floating button container */
.floating-button-container {
            position: fixed;
            top: 50%;
            left: 85%;
           transform: translate(-7.5%, -25%);

            /* Background color for the button container (blue with transparency) */
            color:black;

            padding: 10px;
            border-radius: 10px;
            text-align: center;
             /* Add a shadow for depth */
            z-index: 9999; /* Initially hide the container */
            animation: zoom 2s infinite alternate;
        }

        /* CSS to style the "cut" or close button */
        .close-button {
            top: 5px;
            right: 5px;
            cursor: pointer;
            color:darkgray;
            font-size: 20px;


        }

        /* CSS to style the link inside the container */


        /* CSS to style the image */

        .floating-button-container a img{

            height: 35px;
            width: 120px;


        }
        @keyframes zoom {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.4);
    }
}
@media (max-width: 768px) {
  /* Adjust the positioning or width for smaller screens */
  .floating-button-container{
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
}


    </style>
</head>
<div class="floating-button-container zoom">

    <a class="app-link" href="https://play.google.com/store/apps/details?id=com.coachingdetail.app" ><img src="img/google_play.png" alt="">  </a>
<span class="close-button" onclick="hideFloatingButton()" style="margin-left"> <i class="fa fa-times"></i></span>
</div>


    <script>
        function showFloatingButton() {
            var floatingButtonContainer = document.querySelector('.floating-button-container');
            floatingButtonContainer.style.display = 'block';
        }

        function hideFloatingButton() {
            var floatingButtonContainer = document.querySelector('.floating-button-container');
            floatingButtonContainer.style.display = 'none';
        }
        showFloatingButton();
    </script>



