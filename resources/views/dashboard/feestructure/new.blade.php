@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                {{-- <a href="{{url('dashboard/createcoaching')}}">New Coaching</a> --}}
                <h4>Add Fee Structure</h4>
                <form action="{{url('/')}}" method="POST">
                    
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <form action="{{url('dashboard/store-fee-structure')}}" method="POST">
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
                                <label for="process">Admission Process</label>
                                <textarea rows="6" type="text" name="admission_process"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="fi">
                                <label for="batch_starting_date">Batch Starting Date</label>
                                <input type="date" name="batch_starting_date" required>
                            </div>
                            <div class="fi">
                                <label for="fees">Fees</label>
                                <input type="number" name="fees" required>
                            </div>
                            <div class="fi">
                                <label for="discount">Scholarship Discount</label>
                                <input type="text" name="scholarship_discount" required>
                            </div>
                            <div class="fi">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" required>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn form_btn">SUBMIT FEE STRUCTURE</button>
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