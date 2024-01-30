@extends('student.layout.dash')

@section('profilecontent')
    @if ($coachings->count() == 0 && $tutors->count() == 0)
        <div class="empty">
            <img src="{{asset('img/empty-tree.svg')}}" alt="">
            <p>Oops! it seems you haven't added anything in your wishlist </p>
        </div>
    @else
        @if ($coachings->count() != 0)
            <h4>WISHLISTED COACHINGS</h4>
            @foreach ($coachings as $coaching)
                @include('components.coachingcard',['coaching'=>$coaching,'courses'=>$courses,'cities'=>$cities,'localities'=>$localities])
            @endforeach
        @endif
        @if ($tutors->count() != 0)
            <h4>TUTORS</h4>
            @foreach ($tutors as $tutor)
                @include('components.tutorcard',['tutor'=>$tutor,'courses'=>$courses])
            @endforeach
        @endif
        
    @endif
@endsection