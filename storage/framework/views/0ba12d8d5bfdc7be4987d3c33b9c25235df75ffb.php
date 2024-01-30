<?php $__env->startSection('content'); ?>
    
    <div class="pagetitle" style="background-image:url('<?php echo e(asset("assets/pagetitle_login.png")); ?>')">
        <div class="pagetitle__c">
            <h2>
                Login/Registration
            </h2>
        </div>
    </div>
    <div class="stulogin">
        <div class="stulogin__c">
            <div class="form">
                <div class="form__type">
                    <h4 class="login-tab">Login</h4>
                    <h4 class="registration-tab">Registration</h4>
                </div>
                <form action="<?php echo e(url('login')); ?>" method="POST" class="login">
                    <?php echo csrf_field(); ?>
                    <img src="<?php echo e(asset('assets/logo.jpeg')); ?>" alt="Coaching Detail">
                    <div class="fi">
                        <label for="lphone">Phone Number *</label>
                        <div class="phonein">
                            <input type="tel" maxlength="10" name="phone" id="lphone" placeholder="Enter Phone Number" required>
                            <span onclick="sendotp()" class="otp_btn">SEND OTP</span>
                        </div>
                        <p id="otp_send_notification" style="display:none;">OTP Sent</p>
                    </div>
                    <?php if(session('is_otp_field_visible')): ?>
                        <div class="fi">
                            <label for="lpassword" id="lpl">Enter OTP *</label>
                            <input type="password" name="otp" id="lpassword" class="if" placeholder="Enter 4 Digit OTP" required="">
                        </div>
                    <?php else: ?>
                        <div class="fi">
                            <label for="lpassword" id="lpl">Password *</label>
                            <input type="password" name="password" id="lpassword" class="if" placeholder="Password" required>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="login__btn">Login</button>
                    <p class="login__forget">Forgot Password? <a href="#">Click Here</a></p>
                    <?php if(session('message')): ?>
                        <p class="error"><?php echo e(session('message')); ?></p>
                    <?php endif; ?>
                </form>
                <form action="<?php echo e(url('verifyphone')); ?>" method="POST" class="registration" style="display: none;">
                    <?php echo csrf_field(); ?>
                    <img src="<?php echo e(asset('assets/logo.jpeg')); ?>" alt="Coaching Detail">
                    <div class="fi">
                        <label for="name">Name *</label>
                        <input type="text" name="name" id="name" class="if" placeholder="Name" required>
                    </div>
                    <div class="fi">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" class="if" placeholder="Email Id" required>
                        <?php if(session('email_error')): ?>
                            <p style="color: red;"><?php echo e(session('email_error')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="fi">
                        <label for="phone">Phone Number *</label>
                        <div class="phonein">
                            <input class="if" type="tel" maxlength="10" name="phone" id="rphone" placeholder="Enter Phone Number" required>
                            <!-- <span onclick="sendotp('register')" class="otp_btn">SEND OTP</span> -->
                        </div>
                        <?php if(session('phone_error')): ?>
                            <p style="color: red;"><?php echo e(session('phone_error')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="fi">
                        <label for="rpassword" id="rpl">Password *</label>
                        <input type="password" name="password" id="rpassword" class="if" placeholder="Password" required>
                    </div>
                    <button type="submit" class="login__btn">Continue</button>
                    <p class="login__forget">Already User ? <i class="login-tab" style="color: blue;cursor: pointer;">Login Here</i></p>
                    <?php if(session('message')): ?>
                        <p class="error"><?php echo e(session('message')); ?></p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script>

        <?php if(session('email_error') || session('phone_error')): ?>
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        <?php endif; ?>
        
        let params = new URLSearchParams(window.location.search);
        if(params.get('register') == true || params.get('register') == "true"){
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        }

        $('.registration-tab').on('click',()=>{
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        })
        $('.login-tab').on('click',()=>{
            $('.registration-tab').css({'background-color':"white","color":"black"});
            $('.login-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','flex');
            $('.registration').css('display','none');
        })

        // function sendotp(){
        //     let phone = $("#lphone").val();
        //     $("#lpl").text('Enter OTP *')
        //     $('#lpassword').attr('placeholder','Enter 4 Digit OTP');
        //     $('#lpassword').attr('name','otp');

        //     $.ajax(
        //         {
        //             url:"<?php echo e(url('send-otp')); ?>",
        //             method:"POST",
        //             data:{"_token":"<?php echo e(csrf_token()); ?>","phone":phone},
        //             success: (res)=>{
        //                 if(res.status == "success"){
                            
        //                 }else{
        //                     showAlertDialog(res.message);
        //                 }
        //             }
        //         }
        //     )
        // }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/studentlogin.blade.php ENDPATH**/ ?>