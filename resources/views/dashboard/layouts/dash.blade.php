<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoachingDetail Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashcss.css') }}">

    {{-- Bootstrap --}}
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap"
        rel="stylesheet">


    {{-- //Summernote --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{-- sweetalert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <header class="dh">
        <div class="dh__c">
            <span class="material-icons">menu</span>
            <h2>CoachingDetail</h2>
            <div class="dh__c-admin">
                <img class="dh__c-admin-img" src="{{ asset('assets/logo.jpeg') }}" alt="Admin Image">
                <p class="dh__c-admin-n">{{ auth()->user()->name }}</p>
                <div class="dh__c-admin-box">
                    <img src="{{ asset('assets/logo.jpeg') }}" alt="Admin Image">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->email }}</p>
                    <div class="dh__c-admin-btnc">
                        <a href="{{ url('dashboard/logout') }}" class="logout btn">Logout</a>
                        <a href="{{ url('dashboard/edit-profile') }}" class="edit btn">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @if (session('message'))
        <script>
            swal({
                title: "Message",
                text: "{{ session('message') }}",
                icon: "success",
                button: "OK",
            });
        </script>
    @endif

    <script>
        function deleteItem(e) {
            swal({
                    title: "Are you sure?",
                    text: `Once deleted, you will not be able to recover this ${e.dataset.type}!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = e.dataset.href;
                        // swal("Poof! Your imaginary file has been deleted!", {
                        //     icon: "success",
                        // });
                    } else {
                        swal({
                            title: "Status",
                            text: `This ${e.dataset.type} is not deleted and its safe.`,
                            icon: "success",
                        });
                    }
                });
        }
              function ApproveItem(e) {
            swal({
                    title: "Are you sure?",
                    text: `This will change it's status to verified ${e.dataset.type}!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = e.dataset.href;
                        // swal("Poof! Your imaginary file has been deleted!", {
                        //     icon: "success",
                        // });
                    }
                });
        }
        function unApproveItem(e) {
            swal({
                    title: "Are you sure?",
                    text: `This will change it's status to unverified ${e.dataset.type}!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = e.dataset.href;
                        // swal("Poof! Your imaginary file has been deleted!", {
                        //     icon: "success",
                        // });
                    }
                });
        }

        function editItem(e) {
            swal({
                    title: "Are you sure?",
                    text: `you want to edit this ${e.dataset.type}!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = e.dataset.href;
                        // swal("Poof! Your imaginary file has been deleted!", {
                        //     icon: "success",
                        // });
                    }
                });
        }
    </script>


    <div class="dashcontainer">
        @include('dashboard.layouts.sidebar')

        <div class="dashcontainer__mc">
            @yield('content')
        </div>
    </div>
</body>

</html>
