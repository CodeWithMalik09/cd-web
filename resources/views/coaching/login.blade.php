<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching Detail || Coaching CMS Login</title>
    <link rel="stylesheet" href="{{asset('css/dashcss.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet"> 

</head>
<body>
    <div class="login">
        <div class="login__c">
            <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
            <h2>Coaching Login</h2>
            <form action="{{url('coachingcms')}}" method="POST">
                @csrf
                <div class="fi">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="example@gmail.com" required>
                </div>
                <div class="fi">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button class="btn">Login</button>
                @if (session('message'))
                    <p style="margin-top: 1rem;color:red;font-size:1.6rem;font-family:'poppins';">{{session('message')}}</p>
                @endif
                    <p style="margin-top: 1rem;color:grey;font-size:1.6rem;font-family:'poppins';">Forgot Password ? <a href="#">Click Here</a></p>
            </form>
        </div>
    </div>
</body>
</html>