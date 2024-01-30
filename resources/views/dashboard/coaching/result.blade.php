<div class="rff">
    <div class="rff__c">
        <h5 class="accordian">Student Achivements</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Type</th>
                    <th>Exam Year</th>
                    <th>Stream</th>
                    <th>Student Name</th>
                    <th>Rank</th>
                    <th>Percentage/Score</th>
                    {{-- <th>SPT</th>
                    <th>SMains</th>
                    <th>SFinal</th>
                    <th>STT</th> --}}
                    {{-- <th>Remarks</th> --}}
                    <th>Actions</th>
                </thead>
                <tbody class="achivement_tbody">
                    @if (!isset($results) || $results->count() == 0)
                        <tr>
                            <td>
                                <input type="hidden" name="data_type[]" value="achivement">

                                <select name="result_course[]">
                                    <option selected disabled>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="result_type[]">
                            </td>
                            <td>
                                <input type="text" name="result_exam_year[]">
                            </td>
                            <td>
                                <input type="text" name="result_stream[]">
                            </td>
                            <td>
                                <input type="text" name="result_student_name[]">
                            </td>
                            <td>
                                <input type="text" name="result_rank[]">
                            </td>
                            <td>
                                <input type="text" name="result_percentage[]">
                            </td>
                            {{-- <td>
                                <input type="text" name="result_spt[]">
                            </td>
                            <td>
                                <input type="text" name="result_smains[]">
                            </td>
                            <td>
                                <input type="text" name="result_sfinal[]">
                            </td>
                            <td>
                                <input type="text" name="result_stt[]">
                            </td> --}}
                            {{-- <td>
                                <input type="text" name="result_remarks[]">
                            </td> --}}
                            <td>
                                <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                            </td>
                        </tr>
                        
                    @else
                        @foreach ($results as $result)
                            <tr>
                                <td>
                                    <input type="hidden" name="data_type[]" value="achivement">

                                    <select name="result_course[]">
                                        <option selected disabled>Select Course</option>
                                        @foreach ($courses as $course)
                                            @if ($result->course_id == $course->id)
                                                <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                            @else
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="result_type[]" value="{{$result->type}}">
                                </td>
                                <td>
                                    <input type="text" name="result_exam_year[]" value="{{$result->exam_year}}">
                                </td>
                                <td>
                                    <input type="text" name="result_stream[]" value="{{$result->stream}}">
                                </td>
                                <td>
                                    <input type="text" name="result_student_name[]" value="{{$result->student_name}}">
                                </td>
                                <td>
                                    <input type="text" name="result_rank[]" value="{{$result->rank}}">
                                </td>
                                <td>
                                    <input type="text" name="result_percentage[]" value="{{$result->percentage}}">
                                </td>
                                {{-- <td>
                                    <input type="text" name="result_spt[]" value="{{$result->selected_in_pt}}">
                                </td>
                                <td>
                                    <input type="text" name="result_smains[]" value="{{$result->selected_in_mains}}">
                                </td>
                                <td>
                                    <input type="text" name="result_sfinal[]" value="{{$result->selected_in_final}}">
                                </td>
                                <td>
                                    <input type="text" name="result_stt[]" value="{{$result->selected_in_top_ten}}">
                                </td>
                                <td>
                                    <input type="text" name="result_remarks[]" value="{{$result->remarks}}">
                                </td> --}}
                                <td>
                                    <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                                    <div class="addbtn" onclick="removeAchivementRow(this,'{{$result->student_name}}',{{$coaching->id}})"><span class="material-icons">remove</span></div>
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
    function removeAchivementRow(e,studentname = 0,coaching = 0){
        e.parentNode.parentNode.remove();
        if(studentname != 0){
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/dashboard/delete-result-and-achivement",
                    method:"POST",
                    data:{"coaching_id":coaching,"student_name":studentname,'_token':'{{csrf_token()}}'},
                    success: (res)=>{
                        if(res.status == "success"){
                        }
                    }
                }
            )
        }
    }


    function addAchivementRow(){
        $('.achivement_tbody').append(
            `
                <tr>
                    <td>
                        <input type="hidden" name="data_type[]" value="achivement">
                        <select name="result_course[]">
                            <option selected disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="result_type[]">
                    </td>
                    <td>
                        <input type="text" name="result_exam_year[]">
                    </td>
                    <td>
                        <input type="text" name="result_stream[]">
                    </td>
                    <td>
                        <input type="text" name="result_student_name[]">
                    </td>
                    <td>
                        <input type="text" name="result_rank[]">
                    </td>
                    <td>
                        <input type="text" name="result_percentage[]">
                    </td>
                    <td>
                        <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script>