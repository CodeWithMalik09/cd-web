<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="css/register.css">
</head>

    <!-- Table with a unique class -->
    <table class="custom-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Specialisation</th>
                <th>University</th>
                <th>College</th>
                <th>Experience</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="tbody">
            <tr>
                <td>
                    <input type="text" name="f_name[]">
                </td>
                <td>
                    <input type="text"  placeholder="" name="f_designation[]">
                </td>
                <td>
                    <input type="text"  name="f_specialisation[]">
                </td>
                  <td>
                    <input type="text" name="f_university[]">
                  </td>
                  <td>
                    <input type="text" name="f_college[]">
                  </td>
                  <td>
                    <input type="text" name="f_experience[]">
                  </td>

                <td><span class="add-row-button" onclick="add()">+</span></td>
            </tr>
        </tbody>
    </table>

<script>
    function add() {
        const tableBody = document.querySelector('.tbody');
        const newRow = document.createElement('tr');
         // Generate a unique ID based on the current timestamp
        newRow.innerHTML = `
        <td>
                    <input type="text" name="f_name[]">
                </td>
                <td>
                    <input type="text"  placeholder="" name="f_designation[]">
                </td>
                <td>
                    <input type="text"  name="f_specialisation[]">
                </td>
                  <td>
                    <input type="text" name="f_university[]">
                  </td>
                  <td>
                    <input type="text" name="f_college[]">
                  </td>
                  <td>
                    <input type="text" name="f_experience[]">
                  </td>
            <td><span class="remove-row-button" onclick="remove(this)">-</span></td>
        `;
        tableBody.appendChild(newRow);

        // Initialize Flatpickr for the new timepicker inputs

    }

    function remove(button) {
        const tableBody = document.querySelector('.tbody');
        const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
        tableBody.removeChild(row); // Remove the row from the table
    }

</script>
