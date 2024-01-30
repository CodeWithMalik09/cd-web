@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <h4 >Add Result &amp; Achivements</h4>
                <form action="{{url('/')}}" method="POST">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <form action="{{url('dashboard/new-result-achivement')}}" method="POST">
                    @csrf
                    <div class="form__c">
                        <div class="row">
                            <div class="fi">
                                <label for="coaching">Coaching</label>
                                <select name="coaching_id" id="" required>
                                    @foreach ($coachings as $coaching)
                                        <option value="{{$coaching->id}}">{{$coaching->name}} ({{$coaching->operation_areas[0]}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fi">
                                <label for="course">Course</label>
                                <select name="course_id" id="" required>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fi">
                                <label for="type">Stream</label>
                                <input type="text" name="stream" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="fi">
                                <label for="exam_year">Exam Year *</label>
                                <input type="text" name="exam_year" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_mains">Selected In Mains <span>(type N/A if not available)</span></label>
                                <input type="number" name="selected_in_mains" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_pt">Selected In PT <span>(type N/A if not available)</span></label>
                                <input type="number" name="selected_in_pt" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="fi">
                                <label for="selected_in_final">Selected In Final <span>(type N/A if not available)</span></label>
                                <input type="number" name="selected_in_final" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_top_ten">Selected In Top 10 <span>(type N/A if not available)</span></label>
                                <input type="number" name="selected_in_top_ten" required>
                            </div>
                            <div class="fi">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" required>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn form_btn">SUBMIT RESULT AND ACHIVEMENT</button>
                    @if (session('message'))
                        <p style="color: green;font-size:16px;text-align:center;">{{session('message')}}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
          window.onload = ()=>{
            $(document).ready(function() {
                $('select').select2({
                //   theme:"classic"
                });
            });
        }
    </script>

@endsection