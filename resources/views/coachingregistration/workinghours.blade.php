
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <title>Days and Working Hours</title>
    <style>
    </style>
</head>
<body>
    <!-- Table with a unique ID -->
    <table id="myTable">
        <thead>
            <tr>
                <th>Days</th>
                <th>From</th>
                <th>To</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <tr>
                <td>
                   <input type="text" name="weekdays[]" placeholder="e.g. Monday-to-Friday">
                </td>
                <td>
                    <input type="text" name="from[]" id="timepicker" placeholder="Select Time">
                </td>
                <td><input type="text" name="to[]" id="timepicker" placeholder="Select Time">

                </td>

                <td><span id="add-row-button" onclick="addRow()">+</span></td>
            </tr>
        </tbody>
    </table>
    <!-- Plus icon with a unique ID -->


    <script>
        // JavaScript for adding rows to the table with a unique ID
       function addRow() {
    const tableBody = document.getElementById('table-body');
    const newRow = document.createElement('tr');

    // Generate unique IDs for the new timepicker inputs
    const uniqueId = Date.now(); // Unique timestamp-based ID
    newRow.innerHTML = `
        <td>
            <input type="text" name="weekdays[]" placeholder="e.g. Monday-to-Friday">
        </td>
        <td>
            <input type="text" name="from[]" id="timepicker-${uniqueId}" placeholder="Select Time">
        </td>
        <td>
            <input type="text" name="to[]" id="timepicker-${uniqueId + 1}" placeholder="Select Time">
        </td>
        <td><span class="remove-row-button" onclick="removeRow(this)" style="cursor:pointer">-</span></td>
    `;

    tableBody.appendChild(newRow);

    // Initialize flatpickr for the new timepicker inputs
    flatpickr(`#timepicker-${uniqueId}`, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour time format with AM/PM
        time_24hr: false, // Enable 12-hour format
    });

    flatpickr(`#timepicker-${uniqueId + 1}`, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour time format with AM/PM
        time_24hr: false, // Enable 12-hour format
    });
}
        function removeRow(button) {
    const tableBody = document.getElementById('table-body');
    const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
    tableBody.removeChild(row); // Remove the row from the table
}
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K", // 12-hour time format with AM/PM
                time_24hr: false, // Enable 12-hour format
            });
        });
    </script>


