@extends('coaching.layouts.dash')

@section('content')
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('coachingcms/createresults')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$result->id}}">
                <div class="crcoaching__c-l">
                    <h2>Add New Result and Achivements</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="courses">
                                    @foreach ($courses as $course)
                                        @if ($course->id == $result->course_id)
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
                                <label for="exam_year">Exam Year *</label>
                                <input type="text" value="{{$result->exam_year}}" name="exam_year" id="exam_year" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="stream">Stream *</label>
                                <input type="text" value="{{$result->stream}}" name="stream" id="stream">
                            </div>
                            <div class="fi">
                                <label for="type">Type *</label>
                                <input type="text" value="{{$result->type}}" name="type" id="type">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="selected_in_pt">Selected In PT *</label>
                                <input type="text" value="{{$result->selected_in_pt}}" name="selected_in_pt" id="selected_in_pt" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_mains">Selected In Mains *</label>
                                <input type="text" value="{{$result->selected_in_mains}}" name="selected_in_mains" id="selected_in_mains" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="selected_in_final">Selected In Final *</label>
                                <input type="text" value="{{$result->selected_in_final}}" name="selected_in_final" id="selected_in_final" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_top_ten">Selected In Top 10 *</label>
                                <input type="text" value="{{$result->selected_in_top_ten}}" name="selected_in_top_ten" id="selected_in_top_ten" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="remarks">Remarks * </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="6" required>{{$result->remarks}}"</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Add Result and Achivement</button>
                </div>
                <div class="crcoaching__c-r">
                    <h2>Info</h2>
                    <p><b>Created At:</b> {{date('g:i A d F Y',strtotime($result->created_at))}}</p>
                    <p><b>Updated At:</b> {{date('g:i A d F Y',strtotime($result->updated_at))}}</p>
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