@extends('coaching.layouts.dash')

@section('content')
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('coachingcms/editfeestructure')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$fee_structure->id}}">
                <div class="crcoaching__c-l">
                    <h2>Edit Fee Structure</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="coursess">
                                    @foreach ($courses as $course)
                                        @if ($course->id == $fee_structure->course_id)
                                            <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="stream">Stream *</label>
                                <input type="text" value="{{$fee_structure->stream}}" name="stream" id="stream" required>
                            </div>
                            <div class="fi">
                                <label for="type">Type *</label>
                                <input type="text" value="{{$fee_structure->type}}" name="type" id="type">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="fees">Fees *</label>
                                <input type="text" value="{{$fee_structure->fees}}" name="fees" id="fees" required>
                            </div>
                            <div class="fi">
                                <label for="batch_starting_date">Batch Starting Date *</label>
                                <input type="date" value="{{$fee_structure->batch_starting_date}}" name="batch_starting_date" id="batch_starting_date" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="scholarship_discount">Scholarship Discount *</label>
                                <input type="text" value="{{$fee_structure->scholarship_discount}}" name="scholarship_discount" id="scholarship_discount" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="admission_process">Admission Process *</label>
                                <textarea name="admission_process" id="admission_process" cols="30" rows="6" required>{{$fee_structure->admission_process}}</textarea>
                            </div>
                            <div class="fi">
                                <label for="remarks">Remarks * </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="6" required>{{$fee_structure->remarks}}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Update Fee Structure</button>
                </div>
                <div class="crcoaching__c-r">
                    <h2>Info</h2>
                    <p><b>Created On:</b> {{date('g:i A d F Y',strtotime($fee_structure->created_at))}}</p>
                    <p><b>Last Updated On:</b> {{date('g:i A d F Y',strtotime($fee_structure->updated_at))}}</p>

                    {{-- <div class="di">
                        <img src="{{asset('assets/img_placeholder.png')}}" style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Facutly Image</label> --}}
                </div>
            </form>
        </div>
    </div>
@endsection