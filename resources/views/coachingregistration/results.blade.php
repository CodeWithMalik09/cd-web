<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

    <!-- Table with a unique class -->
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
            <tr>
                <td>
                    <select name="resultcourse[]" id="courses">
                        <option selected disabled>Select Course</option>
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

                <td><button type="button" class="add-row-button" onclick="add_R()">+</button></td>
            </tr>
        </tbody>
    </table>

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
            <td><button type="button" class="remove-row-button" onclick="remove_R(this)">-</button></td>
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
