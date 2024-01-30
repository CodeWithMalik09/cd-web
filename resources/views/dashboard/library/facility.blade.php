
@php
    $i=1;
@endphp
<h5 class="accordian">Facility</h5>
<table>
    <thead>
        <th>S.No.</th>
        <th>Facility</th>

        {{-- <th>SPT</th>
        <th>SMains</th>
        <th>SFinal</th>
        <th>STT</th> --}}
        {{-- <th>Remarks</th> --}}
        <th>Actions</th>
    </thead>
    <tbody class="facility_body">
        @if (!isset($facilities) || $facilities->count() == 0)
            <tr>
                <td>
                  <center>  {{$i++}}</center>
                </td>
                <td>
                    <input type="text" name="lib_facility[]" style="outline:none;height:30px;border:0.5px;width:100%">
                </td>


                <td>
                    <div class="addbtn" onclick="add_facility_Row()"><span class="material-icons" style="cursor: pointer">add</span>
                    </div>
                </td>
            </tr>
            @else
            @foreach ($facilities as $facility)
            <tr>
                <td>
                  <center>  {{$i++}}</center>
                </td>
                <td>
                    <input type="text" name="lib_facility[]" value="{{$facility->facility}}" style="outline:none;height:30px;border:0.5px;width:100%">
                </td>
                <td>
                    <div class="addbtn" onclick="add_facility_Row()"><span class="material-icons" style="cursor: pointer;">add</span>
                        <span class="remove-row-button" onclick="remove_facility_row(this)"style="cursor: pointer;font-size:30px">-</span>
                    </div>
                </td>
            </tr>
            @endforeach
         @endif
    </tbody>

</table>
<script>
var currentSNo = {{$i}};
    function add_facility_Row() {
        const tableBody = document.querySelector('.facility_body');
        const newRow = document.createElement('tr');
         // Generate a unique ID based on the current timestamp
        newRow.innerHTML = `
        <td>
            <center>  ${currentSNo}</center>
                </td>
                <td>
                    <input type="text" name="lib_facility[]" style="outline:none;height:30px;border:0.5px;width:100%">
                </td>


            <td><span class="remove-row-button" onclick="remove_facility_row(this)"style="cursor: pointer">-</span></td>
        `;
        tableBody.appendChild(newRow);
      currentSNo++;

        // Initialize Flatpickr for the new timepicker inputs

    }

    function remove_facility_row(button) {
        const tableBody = document.querySelector('.facility_body');
        const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
        tableBody.removeChild(row);
        currentSNo--; // Remove the row from the table
    }

</script>





