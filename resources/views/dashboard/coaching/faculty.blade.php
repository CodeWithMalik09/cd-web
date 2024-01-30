<div class="rff">
    <div class="rff__c">
        <h5>Faculties</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Specialization</th>
                    <th>University</th>
                    <th>college</th>
                    <th>Experience</th>
                    <th>Actions</th>
                </thead>
                <tbody class="faculty_tbody">
                    @if (!isset($faculties) || $faculties->count() == 0)
                        <tr>
                            <td>
                                <input type="text" name="faculty_name[]">
                            </td>
                            <td>
                                <input type="text" name="faculty_designation[]">
                            </td>
                            <td>
                                <input type="text" name="faculty_specialization[]">
                            </td>
                            <td>
                                <input type="text" name="faculty_university[]">
                            </td>
                            <td>
                                <input type="text" name="faculty_college[]">
                            </td>
                            <td>
                                <input type="text" name="faculty_experience[]">
                            </td>
                            <td>
                                <div class="addbtn" onclick="addFacultyRow()"><span class="material-icons">add</span></div>
                                <div class="addbtn" onclick="moveDown(this)"><span class="material-icons">arrow_circle_down</span></div>
                                <div class="addbtn" onclick="moveUp(this)"><span class="material-icons">arrow_circle_up</span></div>
                            </td>
                        </tr>
                        
                    @else
                        @foreach ($faculties as $faculty)
                            <tr>
                                <td>
                                    <input type="text" name="faculty_name[]" value="{{$faculty->name}}">
                                </td>
                                <td>
                                    <input type="text" name="faculty_designation[]" value="{{$faculty->designation}}">
                                </td>
                                <td>
                                    <input type="text" name="faculty_specialization[]" value="{{$faculty->specialization_on}}">
                                </td>
                                <td>
                                    <input type="text" name="faculty_university[]" value="{{$faculty->university}}"> 
                                </td>
                                <td>
                                    <input type="text" name="faculty_college[]" value="{{$faculty->college}}">
                                </td>
                                <td>
                                    <input type="text" name="faculty_experience[]" value="{{$faculty->experience_in_years}}">
                                </td>
                                <td>
                                    <div class="addbtn" onclick="addFacultyRow()"><span class="material-icons">add</span></div>
                                    <div class="addbtn" onclick="removeRow(this,{{$faculty->id}})"><span class="material-icons">remove</span></div>
                                    <div class="addbtn" onclick="moveDown(this)"><span class="material-icons">arrow_circle_down</span></div>
                                    <div class="addbtn" onclick="moveUp(this)"><span class="material-icons">arrow_circle_up</span></div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function removeRow(e,faculty = 0){
        e.parentNode.parentNode.remove();
        if(faculty != 0){
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/dashboard/delete-faculty-from-coaching",
                    method:"POST",
                    data:{"faculty_id":faculty,'_token':'{{csrf_token()}}'},
                    success: (res)=>{
                        if(res.status == "success"){
                        }
                    }
                }
            )
        }
    }

    function addFacultyRow(){
        $('.faculty_tbody').append(
            `
                <tr>
                    <td>
                        <input type="text" name="faculty_name[]">
                    </td>
                    <td>
                        <input type="text" name="faculty_designation[]">
                    </td>
                    <td>
                        <input type="text" name="faculty_specialization[]">
                    </td>
                    <td>
                        <input type="text" name="faculty_university[]">
                    </td>
                    <td>
                        <input type="text" name="faculty_college[]">
                    </td>
                    <td>
                        <input type="text" name="faculty_experience[]">
                    </td>
                    <td>
                        <div class="addbtn" onclick="addFacultyRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeRow(this)"><span class="material-icons">remove</span></div>
                        <div class="addbtn" onclick="moveDown(this)"><span class="material-icons">arrow_circle_down</span> </div>
                        <div class="addbtn" onclick="moveUp(this)"><span class="material-icons">arrow_circle_up</span> </div>
                    </td>
                </tr>
            `
        );
    }

    function moveDown(e)
    {
        var $element = e;
        var row = $($element).parents("tr:first");
        row.insertAfter(row.next());
    }

    function moveUp(e)
    {
        var $element = e;
        var row = $($element).parents("tr:first");
        row.insertBefore(row.prev());
    }

</script>