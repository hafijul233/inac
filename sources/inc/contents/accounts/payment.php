<h2>Payment</h2>
<br/>
<?php
include "./sources/inc/usercheck.php";
$flag = true;

if (isset($_POST['party']) && isset($_POST['p_t'])
    && isset($_POST['p_m']) && $_POST['amnt'] > 0) {

    //for check transaction
    if (isset($_POST['p_m']) && $_POST['p_m'] == 1) {
        if ($_POST['c_bn'] != "" && $_POST['c_br'] != "" && $_POST['c_ac'] != "") {
            $date = $_POST['d_y'] . '-' . $_POST['d_m'] . '-' . $_POST['d_d'];
            $bank[0] = null;
            $bank[1] = $_POST['c_bn'];
            $bank[2] = $_POST['c_br'];
            $bank[3] = $_POST['c_d_y'] . '-' . $_POST['c_d_m'] . '-' . $_POST['c_d_d'];
            $bank[4] = $_POST['c_ac'];
            $flag = $qur->add_party_transaction($_POST['party'], $date, $_POST['amnt'], $_POST['p_t'], $_POST['p_m'], $_POST['cmnt'], 1, $bank);
        } else {
            echo "<h3 class='red'>Ensure data about cheque</h3>";
            $qur->printPayment($_GET['pt'], $_GET['pay_type'], $_GET['cost']);
        }
    } //for cash transaction
    else {
        $date = $_POST['d_y'] . '-' . $_POST['d_m'] . '-' . $_POST['d_d'];

        $flag = $qur->add_party_transaction($_POST['party'], $date, $_POST['amnt'], $_POST['p_t'], $_POST['p_m'], $_POST['cmnt'], 1, null);

        if ($flag == true) {
            echo "<h2 class='green'>Transaction successful</h2>
							  <br/><a href='index.php?e=" . $encptid . "&&page=accounts&&sub=payment' class='bigbutton'>OK</a>";
        } else if (isset($_GET['pt']) && isset($_GET['pay_type']) && isset($_GET['cost'])) {
            echo "<h3 class='red'>Transaction failed</h3>";
            $qur->printPayment($_GET['pt'], $_GET['pay_type'], $_GET['cost']);
        } else {
            echo "<h3 class='red'>Ensure data validity</h3>";
            $payment_id = (isset($_GET['pt'])) ? $_GET['pt'] : NULL;
            $payment_type = (isset($_GET['pay_type'])) ? $_GET['pay_type'] : NULL;
            $payment_amount = (isset($_GET['cost'])) ? $_GET['cost'] : 0;

            $qur->printPayment($payment_id, $payment_type, $payment_amount);
        }
    }
} else {
    $payment_id = (isset($_GET['pt'])) ? $_GET['pt'] : NULL;
    $payment_type = (isset($_GET['pay_type'])) ? $_GET['pay_type'] : NULL;
    $payment_amount = (isset($_GET['cost'])) ? $_GET['cost'] : 0;

    $qur->printPayment($payment_id, $payment_type, $payment_amount);
}
