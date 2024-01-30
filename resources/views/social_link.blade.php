<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <style>

.whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;

            color: white;


            cursor: pointer;
            z-index: 9999;
            animation: whatsappMove 2s infinite alternate;

        }
        .whatsapp-button i{
            padding: 10px;
            background-color: green;
            font-size: 34px;
            border-radius: 100%;

        }
        .whatsapp-button span{
            padding: 5px;
            background-color: green;
            border-radius: 10px;
            font-size: 20px;

        }
         @keyframes whatsappMove {
            0% {
                right: 20px;
            }
            100% {
                right: 100px; /* Adjust the distance for the animation */
            }
        }
        .whatsapp-button a{
            color: white;
        }
    </style>
</head>
<div class="whatsapp-button">
    <a href="https://whatsapp.com/channel/0029Va4DXxJ84OmG4RTWgn1B">
    <i class="fa fa-whatsapp" aria-hidden="true"></i> <span>Join Our whatsApp Channel</span>
</a>
<i class="fa fa-times" aria-hidden="true" style="background: none;color:black; font-size:16px" id="close" onclick="hideWhatsAppButton()"></i>
</div>
<script>
    // Function to show the WhatsApp button
    function showWhatsAppButton() {
        var whatsappButton = document.querySelector('.whatsapp-button');
        whatsappButton.style.display = 'block'; // Show the button
    }

    // Function to hide the WhatsApp button
    function hideWhatsAppButton() {
        var whatsappButton = document.querySelector('.whatsapp-button');
        whatsappButton.style.display = 'none'; // Hide the button
    }

</script>
