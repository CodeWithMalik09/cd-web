<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
@php
    $i=0;

@endphp

<div class="container">
    <div class="rff">
        <div class="rff__c">
            <h5>Course Category</h5>
            <div class="rff__c-table">
    <table>
        <thead>
            <tr>
                <th>Course Types</th>
                <th>Course Offerings</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!isset($coursecategories) || $coursecategories->count() == 0)
            <tr>
                <td>
                    <label class="checkbox-label"><input type="checkbox" value="3"  name="courseCategory[{{$i}}][categories][]">Regular</label>
                    <label class="checkbox-label"><input type="checkbox" value="4"  name="courseCategory[{{$i}}][categories][]">Correspondence</label>
                    <label class="checkbox-label"><input type="checkbox" value="6"  name="courseCategory[{{$i}}][categories][]">Test series</label>
                    <label class="checkbox-label"><input type="checkbox" value="5"  name="courseCategory[{{$i}}][categories][]">Online Mode</label>
                </td>
                <td>
                    <select name="courseCategory[{{$i}}][course][]" id="courses">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td> <span class="add-row">+</span></td>
            </tr>
            @else
            @foreach ($coursecategories as $coursecategory)
            <tr>
                <td>
                    @php
    $dataArray = json_decode($coursecategory->category, true);
@endphp

@foreach ($categories as $category)
    @php
        $isChecked = in_array($category->id, $dataArray);
    @endphp
    <label class="checkbox-label">
        <input type="checkbox" value="{{ $category->id }}" name="courseCategory[{{ $i }}][categories][]" {{ $isChecked ? 'checked' : '' }}>
        {{ $category->name }}
    </label>
@endforeach


                </td>
                <td>
                    @php
                    $courseArray = json_decode($coursecategory->course, true);
                @endphp

                <select name="selectedCourses[]" style="border:none;outline:none">
                    @foreach ($courses as $course)
                        @php
                            $isSelected = in_array($course->id, $courseArray);
                        @endphp
                        <option value="{{ $course->id }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                </td>
                <td> <span class="add-row" style="font-size:20px;cursor:pointer">+</span>
                    <span class="remove-row" style="font-size:20px;cursor:pointer">-</span>
                </td>
            </tr>
            @endforeach
                    @endif
        </tbody>

    </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Function to add a new row
        function addRow() {
                {{$i++}}

            var newRow = document.createElement('tr');
            newRow.innerHTML = `<td>
                                    <label class="checkbox-label">Regular<input type="checkbox"  value="3" id="inp" name="courseCategory[{{$i}}][categories][]"></label>
                                    <label class="checkbox-label">Correspondence<input type="checkbox"  value="4" id="inp" name="courseCategory[{{$i}}][categories][]"></label>
                                    <label class="checkbox-label">Test series<input type="checkbox"  value="6" id="inp" name="courseCategory[{{$i}}][categories][]"></label>
                                    <label class="checkbox-label">Online Mode<input type="checkbox"  value="5" id="inp" name="courseCategory[{{$i}}][categories][]"></label>
                                </td>
                                <td>
                                    <select name="courseCategory[{{$i}}][course][]" id="courses">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><span class="remove-row" style="font-size:20px;cursor:pointer">-</span></td>
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

