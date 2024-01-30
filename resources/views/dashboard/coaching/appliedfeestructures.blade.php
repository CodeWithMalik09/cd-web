<div class="rff">
    <div class="rff__c">
        <h5>Fee Structure</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Course Name</th>
                    <th>Stream</th>
                    <th>Fees</th>
                    <th>Batch Starting Date</th>
                    <th>Duration</th>
                    <th>Admission Process</th>
                    <th>Scholarship Discount</th>
                    <th>Actions</th>
                </thead>
                <tbody class="fee_tbody">
                    @if (!isset($appliedfeestructures) || $appliedfeestructures->count() == 0)
                        <tr>
                            <td>
                                <select name="fee_course[]">
                                    <option selected disabled>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="fee_course_name[]">
                            </td>
                            <td>
                                <input type="text" name="fee_stream[]">
                            </td>
                            <td>
                                <input type="text" name="fee_fee[]">
                            </td>
                            <td>
                                <input type="date" name="fee_date[]">
                            </td>
                            <td>
                                <input type="text" name="fee_duration[]">
                            </td>
                            <td>
                                <input type="text" name="fee_process[]">
                            </td>
                            <td>
                                <input type="text" name="fee_discount[]">
                            </td>
                        
                            <td>
                                <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                            </td>
                        </tr>
                        
                    @else
                        @foreach ($appliedfeestructures as $fee)
                            <tr>
                                <td>
                                    <select name="fee_course[]">
                                        <option selected disabled>Select Course</option>
                                        @foreach ($courses as $course)
                                            @if ($fee->course_id == $course->id)
                                                <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                            @else
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="fee_course_name[]" value="{{$fee->course_name}}">
                                </td>
                                <td>
                                    <input type="text" name="fee_stream[]" value="{{$fee->stream}}">
                                </td>
                                <td>
                                    <input type="text" name="fee_fee[]" value="{{$fee->fees}}">
                                </td>
                                <td>
                                    <input type="date" name="fee_date[]" value="{{$fee->batch_starting_date}}">
                                </td>
                                <td>
                                    <input type="text" name="fee_duration[]" value="{{$fee->course_duration}}">
                                </td>
                                <td>
                                    <input type="text" name="fee_process[]" value="{{$fee->admission_process}}">
                                </td>
                                <td>
                                    <input type="text" name="fee_discount[]" value="{{$fee->scholarship_discount}}">
                                </td>
                                <td>
                                    <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                                    <div class="addbtn" onclick="removeFeeRow(this,{{$fee->id}})"><span class="material-icons">remove</span></div>
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
    function removeFeeRow(e,fee = 0){
        e.parentNode.parentNode.remove();
        if(fee != 0){
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/dashboard/delete-fee-structure",
                    method:"POST",
                    data:{"fee_id":fee,'_token':'{{csrf_token()}}'},
                    success: (res)=>{
                        if(res.status == "success"){
                        }
                    }
                }
            )
        }
    }

    function addFeeRow(){
        $('.fee_tbody').append(
            `
                <tr>
                    <td>
                        <select name="fee_course[]">
                            <option selected disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="fee_course_name[]">
                    </td>
                    <td>
                        <input type="text" name="fee_stream[]">
                    </td>
                    <td>
                        <input type="text" name="fee_fee[]">
                    </td>
                    <td>
                        <input type="date" name="fee_date[]">
                    </td>
                    <td>
                        <input type="text" name="fee_duration[]">
                    </td>
                    <td>
                        <input type="text" name="fee_process[]">
                    </td>
                    <td>
                        <input type="text" name="fee_discount[]">
                    </td>
                    <td>
                        <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeFeeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script>