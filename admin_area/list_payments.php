<h3 class="text-center text-success">All Payments</h3>

<table class="table table-bordered mt-5">
    <thead class="table-info text-center">
        <?php
        $get_payments = "select * from user_payments";
        $result = mysqli_query($con, $get_payments);
        $rows_count = mysqli_num_rows($result);

        if ($rows_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No Payments recived yet</h2>";
        } else {
            echo "<tr>
        <th>Sl no</th>
        <th>Invoice number</th>
        <th>Amount</th>
        <th>Payment mode </th>
        <th> Order Date</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class='table-secondary text-center'>";
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $invoice_number = $row_data['invoice_number'];
                $amount = $row_data['amount'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                $number++;
                echo " <tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
        <td><a href='' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
    </tr>";
            }
        }

        ?>


        </tbody>
</table>