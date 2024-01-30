@extends('student.layout.dash')

@section('profilecontent')
<h4>PERSONAL INFORMATION</h4>
<form action="{{url('user/update')}}" method="POST">
    @csrf
    <div class="fr">
        <div class="fi">
            <label for="name">Name</label>
            <input type="text" value="{{session('user')->name}}" name="name">
        </div>
        <div class="fi">
            <label for="email">Email Id</label>
            <input type="email" value="{{session('user')->email}}" name="email">
        </div>
        <div class="fi">
            <label for="phone">Phone Number</label>
            <input type="tel" value="{{session('user')->phone}}" name="phone" readonly>
        </div>
    </div>
    <h4>Change Password</h4>
    <div class="fr">
        <div class="fi">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="fi">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
    </div>
    <button type="submit">Update</button>
   <button id="printButton">Print This Page</button>
</form>
<script>
    $(document).ready(function () {
        // Add a click event listener to the print button
        $('#printButton').click(function () {
            // Call the print function when the button is clicked
            window.print();
        });
    });
</script>

@endsection