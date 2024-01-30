<div class="loginpopup__background">
    <div class="loginpopup">
        <div class="loginpopup__exit"><p>X</p></div>
        <div class="loginpopup__c">
            <div class="loginpopup__c-l">
                <h4>Login</h4>
                <p>Get access to your account, wishlist and many more.</p>
            </div>
            <div class="loginpopup__c-r">
                <form action="{{url('login')}}" method="POST">
                    @csrf
                    <div class="fi">
                        <label for="lphone">Phone Number *</label>
                        <div class="phonein">
                            <input type="tel" maxlength="10" name="phone" id="lphone" placeholder="Enter Phone Number" required>
                            <span onclick="sendotp()" class="otp_btn">SEND OTP</span>
                        </div>
                        <p id="otp_send_notification" style="display:none;">OTP Sent</p>
                    </div>
                    <div class="fi">
                        <label for="lpassword" id="lpl">Password</label>
                        <div class="fi__forget">
                            <input type="password" name="password" class="if" id="lpassword">
                            <a class="forget" href="{{url('forgetpassword')}}">Forgot?</a>
                        </div>
                    </div>
                    <p class="policy">By continuing, you agree to Coaching Detail Terms of Use and <a href="{{url('privacy-policy')}}">Privacy Policy</a>.</p>
                    <button type="submit" class="btnsub">Login</button>
                    <a href="{{url('login')}}"><p>New User? Create Account</p></a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.loginpopup__exit').on('click',()=>{
        $('.loginpopup__background').toggle();
        document.cookie = "showpopup=no";
    })
    
</script>