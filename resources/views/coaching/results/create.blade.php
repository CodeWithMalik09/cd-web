@extends('coaching.layouts.dash')

@section('content')
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('coachingcms/createresults')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crcoaching__c-l" style="width: 100%;">
                    <h2>Add New Result and Achivements</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="courses">
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="exam_year">Exam Year *</label>
                                <input type="text" name="exam_year" id="exam_year" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="stream">Stream *</label>
                                <input type="text" name="stream" id="stream">
                            </div>
                            <div class="fi">
                                <label for="type">Type *</label>
                                <input type="text" name="type" id="type">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="selected_in_pt">Selected In PT *</label>
                                <input type="text" name="selected_in_pt" id="selected_in_pt" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_mains">Selected In Mains *</label>
                                <input type="text" name="selected_in_mains" id="selected_in_mains" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="selected_in_final">Selected In Final *</label>
                                <input type="text" name="selected_in_final" id="selected_in_final" required>
                            </div>
                            <div class="fi">
                                <label for="selected_in_top_ten">Selected In Top 10 *</label>
                                <input type="text" name="selected_in_top_ten" id="selected_in_top_ten" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="remarks">Remarks * </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Add Result and Achivement</button>
                </div>
                {{-- <div class="crcoaching__c-r">
                    <h2>Images</h2>
                    <div class="di">
                        <img src="{{asset('assets/img_placeholder.png')}}" style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Facutly Image</label>
                </div> --}}
            </form>
        </div>
    </div>
@endsection