<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

    <!-- Table with a unique class -->
    <table class="custom-table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Course Name</th>
                <th>Stream</th>
                <th>Fees</th>
                <th>Batch Starting Date</th>
                <th>Duration</th>
                <th>Admission Process</th>
                <th>Scholarship Discount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="tablebody">
            <tr>
                <td>
                    <select name="fee_course[]" id="courses">
                        <option selected disabled>Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="course_name[]">
                </td>
                <td>
                    <input type="text"  name="fee_stream[]">
                </td>
                  <td>
                    <input type="text" name="fees[]">
                  </td>
                  <td>
                    <input type="date" id="birthday" name="batch_start_date[]">
                  </td>
                  <td>
                    <input type="text" name="course_duration[]">
                  </td>
                  <td>
                    <input type="text"  name="admission_process[]">
                  </td>
                  <td>
                    <input type="text" name="discount[]">
                  </td>

                <td><button class="add-row-button" onclick="add_Rows()">+</button></td>
            </tr>
        </tbody>
    </table>

<script>
    function add_Rows() {
        const tableBody = document.querySelector('.tablebody');
        const newRow = document.createElement('tr');
         // Generate a unique ID based on the current timestamp
        newRow.innerHTML = `
        <td>
                    <select name="fee_course[]" id="courses">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="course_name[]">
                </td>
                <td>
                    <input type="text"  name="fee_stream[]">
                </td>
                  <td>
                    <input type="text" name="fees[]">
                  </td>
                  <td>
                    <input type="date" id="birthday" name="batch_start_date[]">
                  </td>
                  <td>
                    <input type="text" name="course_duration[]">
                  </td>
                  <td>
                    <input type="text"  name="admission_process[]">
                  </td>
                  <td>
                    <input type="text" name="discount[]">
                  </td>

            <td><button class="remove-row-button" onclick="remove_Rows(this)">-</button></td>
        `;
        tableBody.appendChild(newRow);

        // Initialize Flatpickr for the new timepicker inputs

    }

    function remove_Rows(button) {
        const tableBody = document.querySelector('.tablebody');
        const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
        tableBody.removeChild(row); // Remove the row from the table
    }
</script>
