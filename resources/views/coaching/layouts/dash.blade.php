<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching Detail Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/dashcss.css')}}">

    {{-- Bootstrap --}}
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    {{-- <link rel="stylesheet" href="{{asset('css/semantic.min.css')}}">
    <script src="{{asset('js/semantic.min.js')}}"></script> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet"> 
</head>
<body>
    <header class="dh">
        <div class="dh__c">
            <span class="material-icons">menu</span>
            <h2>Coaching Detail</h2>
            <div class="dh__c-admin">
                <img class="dh__c-admin-img" src="{{url('storage').'/'.session('coaching')->logo}}" alt="Admin Image">
                <p class="dh__c-admin-n">{{session('coaching')->name}}</p>
                <div class="dh__c-admin-box">
                    <img src="{{url('storage').'/'.session('coaching')->logo}}" alt="Admin Image">
                    <h3>{{session('coaching')->name}}</h3>
                    <p>{{session('coaching')->email}}</p>
                    <div class="dh__c-admin-btnc">
                        <a href="{{url('coachingcms/logout')}}" class="logout btn">Logout</a>
                        <a href="#" class="edit btn">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        @include('coaching.layouts.sidebar')

        <div class="container__mc">
            @yield('content')
        </div>
    </div>
</body>
</html>