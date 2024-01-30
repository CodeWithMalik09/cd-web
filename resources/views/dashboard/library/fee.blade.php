
 <h5 class="accordian">Fee Structure</h5>
            <table>
                <thead>
                    <th>Shift</th>
                    <th>Timing</th>
                    <th>Monthly Fee </th>
                    {{-- <th>SPT</th>
                    <th>SMains</th>
                    <th>SFinal</th>
                    <th>STT</th> --}}
                    {{-- <th>Remarks</th> --}}
                    <th>Actions</th>
                </thead>
                <tbody class="tab_body">
                    @if (!isset($fees) || $fees->count() == 0)
                        <tr>
                            <td>
                                <input type="text" name="lib_shift[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                                <input type="text" name="lib_timing[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                              <input type="number" name="lib_monthly_fee[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>

                            <td>
                                <div class="addbtn" onclick="add_fee_Row()"><span class="material-icons" style="cursor: pointer">add</span>
                                </div>
                            </td>
                        </tr>
                        @else

                        @foreach ($fees as $fee)

                        <tr>
                            <td>
                                <input type="text" name="lib_shift[]" value="{{$fee->lib_shift}}" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                                <input type="text" name="lib_timing[]" value="{{$fee->lib_timing}}" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                              <input type="number" name="lib_monthly_fee[]" value="{{$fee->lib_monthly_fee}}" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>

                            <td>

                                <div class="addbtn" onclick="add_fee_Row()"><span class="material-icons" style="cursor: pointer">add</span>
                                    <span class="remove-row-button" onclick="remove_fee_row(this)"style="cursor: pointer;font-size:30px">-</span>
                                </div></td>
                        @endforeach
                        @endif
                </tbody>

            </table>
            <script>
                function add_fee_Row() {
                    const tableBody = document.querySelector('.tab_body');
                    const newRow = document.createElement('tr');
                     // Generate a unique ID based on the current timestamp
                    newRow.innerHTML = `
                    <td>
                                <input type="text" name="lib_shift[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                                <input type="text" name="lib_timing[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>
                            <td>
                              <input type="number" name="lib_monthly_fee[]" style="outline:none;height:30px;border:0.5px;width:100%">
                            </td>

                        <td><span class="remove-row-button" onclick="remove_fee_row(this)"style="cursor: pointer">-</span></td>
                    `;
                    tableBody.appendChild(newRow);

                    // Initialize Flatpickr for the new timepicker inputs

                }

                function remove_fee_row(button) {
                    const tableBody = document.querySelector('.tab_body');
                    const row = button.parentElement.parentElement; // Get the parent <tr> of the clicked button
                    tableBody.removeChild(row); // Remove the row from the table
                }

            </script>





