@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('dashboard/updatekeyword')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $keyword->id }}">
                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Edit Keyword</h5>


                        <div class="fr">
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="city" id="cities">
                                    @foreach ($city as $city)
                                     @if($city->id == $keyword->city)
                                            <option value="{{ $city->id }}"selected>{{ $city->name }}</option>
                                        @else
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="courses" required>
                                    <option disabled selected>Select Course</option>
                                    @foreach ($course as $course)
                                             @if($course->id == $keyword->course)
                                             <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                             @else
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                       @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">Course Type</label>
                                <select name="type" id="courses" required>
                                    <option disabled selected>Select Course</option>
                                    @foreach ($category as $category)
                                                @if($category->id == $keyword->category)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                         @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                       <div class="fr">
                            <div class="fi">
                                <label for="">Key1</label>
                                <input type="text" name="key1" style="height: 100px" value="{{$keyword->key1}}">
                            </div>
                            <div class="fi">
                                <label for="">Key2</label>
                              <input type="text" name="key2" style="height: 100px" value="{{$keyword->key2}}">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">Key3</label>
                                <input type="text" name="key3" style="height: 100px" value="{{$keyword->key3}}">
                            </div>
                        </div>                       
                         <div class="fr">
                            <div class="fi">
                                <label for="">Title</label>
                                <input type="text" name="title" id="" value="{{$keyword->title}}">
                            </div>
                            <div class="fi">
                                <label for="">Meta</label>
                                <input type="text" name="meta" value="{{$keyword->meta}}">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">OG Title</label>
                                <input type="text" name="ogtitle" value="{{$keyword->ogtitle}}">
                            </div>
                            <div class="fi">
                                <label for="">OG Description</label>
                                <input type="text" name="ogdesc" value="{{$keyword->ogdesc}}">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">OG Type</label>
                                <input type="text" name="ogtype" value="{{$keyword->ogtype}}">
                            </div>
                            <div class="fi">
                                <label for="">OG Url</label>
                                <input type="text" name="ogurl" value="{{$keyword->ogurl}}">
                            </div>
                        </div>
                           <div class="fr">
                            <div class="fi">
                                <label for="">Canonical</label>
                                <input type="text" name="canonical" value="{{$keyword->canonical}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>
                </div>

    </div>

@endsection
