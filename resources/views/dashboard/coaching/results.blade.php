<div class="rff">
    <div class="rff__c">
        <h5 class="accordian">Student Results</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Exam Year</th>
                    <th>Stream/Post</th>
                    <th>Selected Students(PT)</th>
                    <th>Selected Students(Mains)</th>
                    <th>Selected Students(Final)</th>
                    {{-- <th>SPT</th>
                    <th>SMains</th>
                    <th>SFinal</th>
                    <th>STT</th> --}}
                    {{-- <th>Remarks</th> --}}
                    <th>Actions</th>
                </thead>
                <tbody class="result_tbody">
                    @if (!isset($results) || $results->count() == 0)
                        <tr>
                            <td>
                                <input type="hidden" name="rcdata_type[]" value="result">
                                <select name="rcresult_course[]">
                                    <option selected disabled>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="rcresult_exam_year[]" id="">
                                    <option disabled selected>Select Year</option>
                                    <option value="N/A">N/A</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="rcresult_stream[]">
                            </td>
                            <td>
                                <select name="selected_in_pt[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <select name="selected_in_mains[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <select name="selected_in_final[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span>
                                </div>
                            </td>
                        </tr>
                    @else
                        @php
                            $year_range = ['N/A',2018, 2019, 2020, 2021, 2022, 2023];
                            $selection_range = ['N/A','1-24', '24-49', '50-99', '100-249', '250-499', '500-999', '1000+'];
                        @endphp
                        @foreach ($results as $result)
                            <tr>
                                <td>
                                    <input type="hidden" name="rcdata_type[]" value="result">
                                    <select name="rcresult_course[]">
                                        <option selected disabled>Select Course</option>
                                        @foreach ($courses as $course)
                                            @if ($result->course_id == $course->id)
                                                <option value="{{ $course->id }}" selected>{{ $course->name }}
                                                </option>
                                            @else
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="rcresult_exam_year[]" id="">
                                        @foreach ($year_range as $year)
                                            @if ($year == $result->exam_year)
                                                <option value="{{ $year }}" selected>{{ $year }}
                                                </option>
                                            @else
                                                <option value="{{ $year }}">{{ $year }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>

                                    <input type="text" name="rcresult_stream[]" value="{{ $result->stream }}">
                                </td>
                                <td>
                                    <select name="selected_in_pt[]" id="">
                                        @foreach ($selection_range as $select)
                                            @if ($select == $result->selected_in_pt)
                                                <option value="{{ $select }}" selected>{{ $select }}
                                                </option>
                                            @else
                                                <option value="{{ $select }}">{{ $select }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="selected_in_mains[]" id="">
                                        @foreach ($selection_range as $select)
                                            @if ($select == $result->selected_in_mains)
                                                <option value="{{ $select }}" selected>{{ $select }}
                                                </option>
                                            @else
                                                <option value="{{ $select }}">{{ $select }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="selected_in_final[]" id="">
                                        @foreach ($selection_range as $select)
                                            @if ($select == $result->selected_in_final)
                                                <option value="{{ $select }}" selected>{{ $select }}
                                                </option>
                                            @else
                                                <option value="{{ $select }}">{{ $select }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span>
                                    </div>
                                    <div class="addbtn"
                                        onclick="removeResultRow(this,'{{ $result->student_name }}',{{ $coaching->id }})">
                                        <span class="material-icons">remove</span>
                                    </div>
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
    function removeResultRow(e, studentname = 0, coaching = 0) {
        e.parentNode.parentNode.remove();
        if (studentname != 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/dashboard/delete-result-and-achivement",
                method: "POST",
                data: {
                    "coaching_id": coaching,
                    "student_name": studentname,
                    '_token': '{{ csrf_token() }}'
                },
                success: (res) => {
                    if (res.status == "success") {}
                }
            })
        }
    }


    function addResultRow() {
        $('.result_tbody').append(
            `
                <tr>
                    <td>
                        <input type="hidden" name="rcdata_type[]" value="result">
                        <select name="rcresult_course[]">
                            <option selected disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="rcresult_exam_year[]" id="">
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="rcresult_stream[]">
                    </td>
                    <td>
                        <select name="selected_in_pt[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <select name="selected_in_mains[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <select name="selected_in_final[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script>
