<div class="rff">
    <div class="rff__c">
        <h5>Fee Structure</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Item Name</th>
                    <th>Type</th>
                    <th>Fee Amount</th>
                    <th>Due Date</th>
                    <th>Payment Frequency</th>
                    <th>Late Payment fee</th>
                    <th>Discount</th>
                    <th>Notes/comments</th>
                    <th>Actions</th>
                </thead>
                <tbody class="fee_tbody">

                        <tr>
                            <td>
                                <input type="text" id="item_name" name="item_name" required>
                            </td>
                            <td>
                                <select id="item_type" name="item_type" required>
                                    <option value="book">Book</option>
                                    <option value="DVD">DVD</option>
                                    <option value="magazine">Magazine</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" id="fee_amount" name="fee_amount" step="0.01" required>
                            </td>
                            <td>
                                <input type="date" id="due_date" name="due_date">
                            </td>
                            <td>
                                <select id="payment_frequency" name="payment_frequency" required>
                                    <option value="one-time">One-Time</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="yearly">Yearly</option>

                                </select>
                            </td>
                            <td>
                                <input type="number" id="late_payment_fee" name="late_payment_fee" step="0.01">
                            </td>
                            <td>
                                <input type="text" id="discount_or_promotion" name="discount_or_promotion">
                            </td>
                            <td>
                                <textarea id="notes" name="notes" rows="4"></textarea>
                            </td>

                            <td>
                                <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                            </td>
                        </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function removeFeeRow(e, fee = 0) {
        e.parentNode.parentNode.remove();
        if (fee != 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/dashboard/delete-fee-structure",
                method: "POST",
                data: {"fee_id": fee, '_token': '{{csrf_token()}}'},
                success: (res) => {
                    if (res.status == "success") {
                        // Handle success if needed
                    }
                }
            })
        }
    }

    function addFeeRow() {
        $('.fee_tbody').append(
            `<tr>
                <td>
                    <input type="text" id="item_name" name="item_name" required>
                </td>
                <td>
                    <select id="item_type" name="item_type" required>
                        <option value="book">Book</option>
                        <option value="DVD">DVD</option>
                        <option value="magazine">Magazine</option>
                    </select>
                </td>
                <td>
                    <input type="number" id="fee_amount" name="fee_amount" step="0.01" required>
                </td>
                <td>
                    <input type="date" id="due_date" name="due_date">
                </td>
                <td>
                    <select id="payment_frequency" name="payment_frequency" required>
                        <option value="one-time">One-Time</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </td>
                <td>
                    <input type="number" id="late_payment_fee" name="late_payment_fee" step="0.01">
                </td>
                <td>
                    <input type="text" id="discount_or_promotion" name="discount_or_promotion">
                </td>
                <td>
                    <textarea id="notes" name="notes" rows="4"></textarea>
                </td>
                <td>
                    <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                    <div class="addbtn" onclick="removeFeeRow(this)"><span class="material-icons">remove</span></div>
                </td>
            </tr>`
        );
    }
</script>

