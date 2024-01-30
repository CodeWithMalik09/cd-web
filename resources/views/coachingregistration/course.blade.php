<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
@php
    $i=0;

@endphp

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Course Types</th>
                <th>Course Offerings</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <label class="checkbox-label"><input type="checkbox" value="3"  name="courseCategory[{{$i}}][categories][]">Regular</label>
                    <label class="checkbox-label"><input type="checkbox" value="4"  name="courseCategory[{{$i}}][categories][]">Correspondence</label>
                    <label class="checkbox-label"><input type="checkbox" value="6"  name="courseCategory[{{$i}}][categories][]">Test series</label>
                    <label class="checkbox-label"><input type="checkbox" value="5"  name="courseCategory[{{$i}}][categories][]">Online Mode</label>
                </td>
                <td>
                    <select name="courseCategory[{{$i}}][course][]" id="courses">
                        <option selected disabled>Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td> <button type="button" class="add-row">+</button></td>
            </tr>
        </tbody>

    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Function to add a new row
        function addRow() {
                {{$i++}}

            var newRow = document.createElement('tr');
            newRow.innerHTML = `<td>
                                    <label class="checkbox-label"><input type="checkbox"  value="3" id="inp" name="courseCategory[{{$i}}][categories][]">Regular</label>
                                    <label class="checkbox-label"><input type="checkbox"  value="4" id="inp" name="courseCategory[{{$i}}][categories][]">Correspondence</label>
                                    <label class="checkbox-label"><input type="checkbox"  value="6" id="inp" name="courseCategory[{{$i}}][categories][]">Test series</label>
                                    <label class="checkbox-label"><input type="checkbox"  value="5" id="inp" name="courseCategory[{{$i}}][categories][]">Online Mode</label>
                                </td>
                                <td>
                                    <select name="courseCategory[{{$i}}][course][]" id="courses">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><button type="button" class="remove-row">-</button></td>
                                `;

            document.querySelector('tbody').appendChild(newRow);
        }

        // Function to remove a row
        function removeRow(event) {
            if (event.target.classList.contains('remove-row')) {
                event.target.parentElement.parentElement.remove();
            }
        }

        // Event listener for plus icon
        document.querySelector('.add-row').addEventListener('click', addRow);

        // Event listener for minus icon (delegated to the parent tbody for dynamically added rows)
        document.querySelector('tbody').addEventListener('click', removeRow);
    });
</script>

