<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

    <!-- Table with a unique class -->
    <table class="custom-table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Type</th>
                <th>Exam Year</th>
                <th>Stream</th>
                <th>Student Name</th>
                <th>Rank</th>
                <th>Score</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <tr>
                <td>
                    <select name="achievementcourse[]" id="courses">
                        <option selected disabled>Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="type[]" style="outline: none;border:none">
                </td>
                <td>
                    <input type="text"  name="exam_year[]" style="outline: none;border:none">
                </td>
                  <td><input type="text"  name="stream[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="student_name[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="Rank[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="Score[]" style="outline: none;border:none"></td>

                <td><span class="add-row-button" onclick="add_Row()">+</span></td>
            </tr>
        </tbody>
    </table>

<script>
    function add_Row() {
        const tableBody = document.querySelector('.table-body');
        const newRow = document.createElement('tr');
         // Generate a unique ID based on the current timestamp
        newRow.innerHTML = `
        <td>
                    <select name="achievementcourse[]" id="courses">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text"  placeholder="" name="type[]" style="outline: none;border:none">
                </td>
                <td>
                    <input type="text"  name="exam_year[]" style="outline: none;border:none">
                </td>
                  <td><input type="text"  name="stream[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="student_name[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="Rank[]" style="outline: none;border:none"></td>
                  <td><input type="text"  name="Score[]" style="outline: none;border:none"></td>
            <td><span class="remove-row-button" onclick="remove_Row(this)">-</span></td>
        `;
        tableBody.appendChild(newRow);

        // Initialize Flatpickr for the new timepicker inputs

    }

    function remove_Row(button) {
        const tableBody = document.querySelector('.table-body');
        const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
        tableBody.removeChild(row); // Remove the row from the table
    }

</script>
