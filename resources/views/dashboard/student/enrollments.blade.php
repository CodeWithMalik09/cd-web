@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="javascript:void(0)">Enrollments</a>
                <form action="{{ url('dashboard/search-student') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="studash__c-r">
                @if ($enrollments->count() == 0)
                    <div class="empty">
                        <img src="{{asset('img/empty-tree.svg')}}" alt="">
                        <p>Oops! It seems that this student isn't enrolled in any coaching. </p>
                    </div>
                @else
                    @if ($enrollments->count() != 0)
                        @foreach ($enrollments as $enrollment)
                            <div class="enrollment__card">
                                <h3>{{$enrollment->coaching->name}}</h3>
                                <div class="row">
                                    <p>Course: {{$enrollment->course->name}}</p>
                                    <p>Category: {{$enrollment->courseCategory->name}}</p>
                                    <p>Session: {{$enrollment->session}}</p>
                                </div>
                                <div class="row">
                                    <p>Centre: {{$enrollment->centre}}</p>
                                    <p>Batch Type: {{$enrollment->batch_type}}</p>
                                    <p>Exam: {{$enrollment->exam}}</p>
                                </div>
                                <div class="row mt-4">
                                    <p>Applied On: {{date('d F Y',strtotime($enrollment->created_at))}}</p>
                                    <span class="badge">Status: Under Verification</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>

            @if (!isset($search))
                @if($enrollments->count() > 20)
                    @include('dashboard.components.pagination', ['data' => $enrollments])
                @endif
            @endif
        </div>
    </div>
@endsection
