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
        @foreach($cities as $city)
        <a href="{{ url("coachings/{$city->name}") }}" style="color:#3498db">
        Coaching institutes in {{$city->name}} |   </a>
        @endforeach
    </p>

</div>
