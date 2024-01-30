@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('dashboard/insertkeyword')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Add New Keyword</h5>


                        <div class="fr">
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="city" id="cities">
                                    @foreach ($city as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="courses" required>
                                    <option disabled selected>Select Course</option>
                                    @foreach ($course as $course)

                                            <option value="{{ $course->id }}">{{ $course->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">Course Type</label>
                                <select name="type" id="courses" required>
                                    <option disabled selected>Select Course Type</option>
                                    @foreach ($category as $category)

                                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                        </div>
                       <div class="fr">
                            <div class="fi">
                                <label for="">Key1</label>
                                <input type="text" name="key1" style="height: 100px">
                            </div>
                            <div class="fi">
                                <label for="">Key2</label>
                              <input type="text" name="key2" style="height: 100px">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">Key3</label>
                                <input type="text" name="key3" style="height: 100px">
                            </div>
                        </div>                       
                       <div class="fr">
                            <div class="fi">
                                <label for="">Title</label>
                                <input type="text" name="title" id="">
                            </div>
                            <div class="fi">
                                <label for="">Meta</label>
                                <input type="text" name="meta">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">OG Title</label>
                                <input type="text" name="ogtitle">
                            </div>
                            <div class="fi">
                                <label for="">OG Description</label>
                                <input type="text" name="ogdesc">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="">OG Type</label>
                                <input type="text" name="ogtype">
                            </div>
                            <div class="fi">
                                <label for="">OG Url</label>
                                <input type="text" name="url">
                            </div>
                        </div>
                         <div class="fr">
                            <div class="fi">
                                <label for="">Canonical</label>
                                <input type="text" name="canonical">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Insert</button>

                    </div>
                </div>

    </div>

@endsection
