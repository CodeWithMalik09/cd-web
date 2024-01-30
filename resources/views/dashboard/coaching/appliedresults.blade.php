<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

    <!-- Table with a unique class -->
    <div class="rff">
        <div class="rff__c">
            <h5>Applied Results</h5>
            <div class="rff__c-table">
    <table class="custom-table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Exam Year</th>
                <th>Stream/Post</th>
                <th>Selected Students{{"(PT)"}}</th>
                <th>Selected Students{{"(Mains)"}}</th>
                <th>Selected Students{{"(Final)"}}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="t-body">
            @if (!isset($appliedresults) || $appliedresults->count() == 0)
            <tr>
                <td>
                    <select name="resultcourse[]" id="courses">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="resultexam_year[]">
                </td>
                <td>
                    <input type="text"  name="resultstream[]">
                </td>
                  <td>
                    <select name="resultpt_select[]" id="">
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
                    <select name="resultmain_select[]" id="">
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
                    <select name="resultfinal_select[]" id="">
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

                <td><span class="add-row-button" onclick="add_R()">+</span></td>
            </tr>
            @else
            @foreach ($appliedresults as $appliedresult)
            <tr>
                <td>
                    <select name="resultcourse[]" id="courses">
                        @foreach ($courses as $course)
                        @if ($appliedresult->course == $course->id)
                            <option value="{{$course->id}}" selected>{{$course->name}}</option>
                        @else
                            <option value="{{$course->id}}">{{$course->name}}</option>
                        @endif
                    @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="resultexam_year[]" value="{{$appliedresult->exam_year}}">
                </td>
                <td>
                    <input type="text"  name="resultstream[]" value="{{$appliedresult->stream}}">
                </td>
                  <td>
                    <select name="resultpt_select[]" id="">
                        <option value="N/A" <?php echo ($appliedresult->selected_pt_students == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                        <option value="1-24" <?php echo ($appliedresult->selected_pt_students == '1-24') ? 'selected' : ''; ?>>1-24</option>
                        <option value="24-49" <?php echo ($appliedresult->selected_pt_students == '24-49') ? 'selected' : ''; ?>>24-49</option>
                        <option value="50-99" <?php echo ($appliedresult->selected_pt_students == '50-99') ? 'selected' : ''; ?>>50-99</option>
                        <option value="100-249" <?php echo ($appliedresult->selected_pt_students == '100-249') ? 'selected' : ''; ?>>100-249</option>
                        <option value="250-499" <?php echo ($appliedresult->selected_pt_students == '250-499') ? 'selected' : ''; ?>>250-499</option>
                        <option value="500-999" <?php echo ($appliedresult->selected_pt_students == '500-999') ? 'selected' : ''; ?>>500-999</option>
                        <option value="1000+" <?php echo ($appliedresult->selected_pt_students == '1000+') ? 'selected' : ''; ?>>1000+</option>
                    </select>

                  </td>
                  <td>
                    <select name="resultmain_select[]" id="">
                        <option value="N/A" <?php echo ($appliedresult->selected_mains_students == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                        <option value="1-24" <?php echo ($appliedresult->selected_mains_students == '1-24') ? 'selected' : ''; ?>>1-24</option>
                        <option value="24-49" <?php echo ($appliedresult->selected_mains_students == '24-49') ? 'selected' : ''; ?>>24-49</option>
                        <option value="50-99" <?php echo ($appliedresult->selected_mains_students == '50-99') ? 'selected' : ''; ?>>50-99</option>
                        <option value="100-249" <?php echo ($appliedresult->selected_mains_students == '100-249') ? 'selected' : ''; ?>>100-249</option>
                        <option value="250-499" <?php echo ($appliedresult->selected_mains_students == '250-499') ? 'selected' : ''; ?>>250-499</option>
                        <option value="500-999" <?php echo ($appliedresult->selected_mains_students == '500-999') ? 'selected' : ''; ?>>500-999</option>
                        <option value="1000+" <?php echo ($appliedresult->selected_mains_students == '1000+') ? 'selected' : ''; ?>>1000+</option>
                    </select>
                  </td>
                  <td>
                    <select name="resultfinal_select[]" id="">
                        <option value="N/A" <?php echo ($appliedresult->selected_final_students == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                        <option value="1-24" <?php echo ($appliedresult->selected_final_students == '1-24') ? 'selected' : ''; ?>>1-24</option>
                        <option value="24-49" <?php echo ($appliedresult->selected_final_students == '24-49') ? 'selected' : ''; ?>>24-49</option>
                        <option value="50-99" <?php echo ($appliedresult->selected_final_students == '50-99') ? 'selected' : ''; ?>>50-99</option>
                        <option value="100-249" <?php echo ($appliedresult->selected_final_students == '100-249') ? 'selected' : ''; ?>>100-249</option>
                        <option value="250-499" <?php echo ($appliedresult->selected_final_students == '250-499') ? 'selected' : ''; ?>>250-499</option>
                        <option value="500-999" <?php echo ($appliedresult->selected_final_students == '500-999') ? 'selected' : ''; ?>>500-999</option>
                        <option value="1000+" <?php echo ($appliedresult->selected_final_students == '1000+') ? 'selected' : ''; ?>>1000+</option>
                    </select>
                  </td>

                <td><span class="add-row-button" onclick="add_R()">+</span></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
            </div>
        </div>
    </div>

<script>
    function add_R() {
        const tableBody = document.querySelector('.t-body');
        const newRow = document.createElement('tr');
         // Generate a unique ID based on the current timestamp
        newRow.innerHTML = `
        <td>
                    <select name="resultcourse[]" id="courses">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="resultexam_year[]">
                </td>
                <td>
                    <input type="text"  name="resultstream[]">
                </td>
                  <td>
                    <select name="resultpt_select[]" id="">
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
                    <select name="resultmain_select[]" id="">
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
                    <select name="resultfinal_select[]" id="">
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
            <td><span class="remove-row-button" onclick="remove_R(this)">-</span></td>
        `;
        tableBody.appendChild(newRow);

        // Initialize Flatpickr for the new timepicker inputs

    }

    function remove_R(button) {
        const tableBody = document.querySelector('.t-body');
        const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
        tableBody.removeChild(row); // Remove the row from the table
    }

</script>
