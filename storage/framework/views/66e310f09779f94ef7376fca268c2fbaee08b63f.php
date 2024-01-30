<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching Detail Admin Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashcss.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet"> 

</head>
<body>
    <div class="login">
        <div class="login__c">
            <img src="<?php echo e(asset('assets/logo.jpeg')); ?>" alt="Coaching Detail">
            <h2>Admin Login</h2>
            <form action="<?php echo e(url('cms')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="fi">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="example@gmail.com" required>
                </div>
                <div class="fi">
                    <label for="password">Password</label>
                    <input type="password" name="password" required placeholder="Password">
                </div>
                <button class="btn">Login</button>
                <?php if(session('message')): ?>
                    <p style="margin-top: 10px;color:red;font-size:16px;font-family:'poppins';"><?php echo e(session('message')); ?></p>
                <?php endif; ?>
                <p style="margin-top: 10px;color:grey;font-size:14px;font-family:'poppins';">Forgot Password ? <a href="#">Click Here</a></p>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/login.blade.php ENDPATH**/ ?>