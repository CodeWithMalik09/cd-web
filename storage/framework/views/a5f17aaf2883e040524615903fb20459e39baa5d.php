<head>
    <style>
        .hkeyword{
            width:90%;
           background-color:white;
          margin-left:5%;
         text-align: justify;
         text-justify: inter-word;
         margin-bottom:10px;
      }

        .hkeyword p{
            padding:10px;
            font-size:1.6rem;
            background-color:white;
            width:95%;
            font-family:nunito;
          padding-left:30px;
       color:#3498db;
        }

       .hkeyword h2{
          font-family:nunito;
          font-size:22px;
          margin:5px;
         text-align:center;
        }
    </style>
</head>

<div class="hkeyword">
<h2>List Of Top Coaching Classes Across India</h2>

    <p>
        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(url("coachings/{$city->name}")); ?>" style="color:#3498db">
        Coaching institutes in <?php echo e($city->name); ?> |   </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </p>

</div>
<?php /**PATH C:\Users\asus\Downloads\cd\resources\views/homekeyword.blade.php ENDPATH**/ ?>