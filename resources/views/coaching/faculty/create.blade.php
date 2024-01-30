@extends('coaching.layouts.dash')

@section('content')
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{url('coachingcms/createfaculty')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crcoaching__c-l">
                    <h2>Add New Faculty</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="name">Name *</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="designation">Designation *</label>
                                <input type="text" name="designation" id="designation" required>
                            </div>
                            <div class="fi">
                                <label for="special">Specialization In *</label>
                                <input type="text" name="specialization_on" id="special">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="university">University *</label>
                                <input type="text" name="university" id="university" required>
                            </div>
                            <div class="fi">
                                <label for="college">College *</label>
                                <input type="text" name="college" id="college" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="experience">Experience (in years) *</label>
                                <input type="text" name="experience" id="experience">
                            </div>
                            <div class="fi">
                                <label for="jobtype">Job Type *</label>
                                <input type="text" name="jobtype" id="jobtype" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="achivements">Faculty Achivements *</label>
                                <textarea name="achivements" id="achivements" cols="30" rows="6" required></textarea>
                            </div>
                            <div class="fi">
                                <label for="remarks">Remarks * </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Add Faculty</button>
                </div>
                <div class="crcoaching__c-r">
                    <h2>Images</h2>
                    <div class="di">
                        <img src="{{asset('assets/img_placeholder.png')}}" style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Facutly Image</label>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#thumbnail').change((e)=>{
            $('.di').empty()
            let reader = new FileReader();
            reader.onload = (re)=>{
                $('.di').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        })
    </script>
@endsection