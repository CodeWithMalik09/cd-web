@extends('coaching.layouts.dash')

@section('content')
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('coachingcms/createfeestructure')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crcoaching__c-l" style="width: 100%;">
                    <h2>Add New Fee Structure</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="course" id="coursess">
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="stream">Stream *</label>
                                <input type="text" name="stream" id="stream" required>
                            </div>
                            <div class="fi">
                                <label for="type">Type *</label>
                                <input type="text" name="type" id="type">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="fees">Fees *</label>
                                <input type="text" name="fees" id="fees" required>
                            </div>
                            <div class="fi">
                                <label for="batch_starting_date">Batch Starting Date *</label>
                                <input type="date" name="batch_starting_date" id="batch_starting_date" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="scholarship_discount">Scholarship Discount *</label>
                                <input type="text" name="scholarship_discount" id="scholarship_discount" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="admission_process">Admission Process *</label>
                                <textarea name="admission_process" id="admission_process" cols="30" rows="6" required></textarea>
                            </div>
                            <div class="fi">
                                <label for="remarks">Remarks * </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Add Fee Structure</button>
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