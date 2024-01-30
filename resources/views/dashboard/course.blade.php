@extends('dashboard.layouts.dash')

@section('content')
    <div class="city">
        <div class="city__c">
            <div class="city__c-l">
                <h2>Add New Course</h2>
                @if (isset($course))
                    <form action="{{url('dashboard/updatecourse')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$course->id}}">
                        <div class="fi">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="coursename" value='{{$course->name}}' required>
                        </div>
                        <div class="fi">
                            <label for="name">Description</label>
                            <textarea type="text" id="name" name="description" required>{{$course->description}}</textarea>
                        </div>
                        <img src="{{url('storage').'/'.$course->icon}}" alt="Couse Icon">
                        <div class="fi">
                            <label for="name">Logo/Icon</label>
                            <input type="file" id="name" name="icon">
                        </div>
                        <button type="submit">Update Course</button>
                    </form>
                @else
                    <form action="{{url('dashboard/createcourse')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="fi">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="coursename" required>
                        </div>
                        <div class="fi">
                            <label for="name">Description</label>
                            <textarea type="text" id="name" name="description" required></textarea>
                        </div>
                        <div class="fi">
                            <label for="name">Logo/Icon</label>
                            <input type="file" id="name" name="icon" required>
                        </div>
                        <button type="submit" class="btn">Add</button>
                    </form>
                @endif
            </div>
            <div class="city__c-r">
                <div class="rheader">
                    <h2>Courses</h2>
                    <p>Total Courses : {{count($courses)}}</p>
                </div>
                <div class="city__c-r-oac">
                    @foreach ($courses as $course)
                        <div class="oa">
                            <h3>{{$course->name}}</h3>
                            <div class="oa__controls">
                                {{-- <span class="material-icons">edit</span> --}}
                                <a onclick="editItem(this)" data-type="course" data-href="{{url('dashboard/editcourse').'/'.$course->id}}">
                                    <span class="material-icons">edit</span>
                                </a>
                                <a onclick="deleteItem(this)" data-type="course" data-href="{{url('dashboard/deletecourse').'/'.$course->id}}">
                                    <span class="material-icons">delete</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection