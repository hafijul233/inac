<?php
$id = $_GET['id'];
include("sources/inc/print/double_date.php");
if (isset($_GET['date1']) && isset($_GET['date2'])) {

    $query3 = sprintf("SELECT date, ammount, comment FROM (SELECT id FROM party_payment WHERE idparty = %d) as payment LEFT JOIN transaction USING (id) LEFT JOIN transaction_comment USING(id) WHERE date BETWEEN '%s' AND '%s';", $id, $date1, $date2);
} else {
    echo "<h3>All time report tst</h3>";
    $query3 = sprintf("SELECT date, ammount, comment FROM (SELECT id FROM party_payment WHERE idparty = %d) as payment LEFT JOIN transaction USING (id) LEFT JOIN transaction_comment USING(id);", $id);
}
$name = $qur->get_cond_row('party', array('name'), 'idparty', '=', $id);
$tran = $qur->get_custom_select_query($query3, 3);
if (count($tran) > 0) {
    echo "<h1 class='blue'>Transaction with " . $name[0][0] . " </h1>";
    echo "<table align='center' class='rb'>";
    echo "<tr>";
    
    echo "<th>";
    echo "SI";
    echo "</th>";

    echo "<th>";
    echo "Date";
    echo "</th>";

    echo "<th class='left'>";
    echo " Paid";
    echo "</th>";

    echo "<th>";
    echo " Received";
    echo "</th>";

    echo "<th>";
    echo "Comments";
    echo "</th>";
    
    echo "</tr>";
    $recived = 0;
    $paid = 0;
    $i = 0;
    foreach ($tran as $s) {
        echo "<tr>";

        echo "<td>";
        echo $i++;
        echo "</td>";

        echo "<td>";
        echo $inp->date_convert($s[0]);
        echo "</td>";
        if ($s[1] > 0) {
            echo "<td align = 'center' ></td>";
            echo "<td class='text-right' >" . money($s[1]) . "</td>";
            $recived += $s[1];
        } else {
            $neg = -$s[1];
            echo "<td class='text-right' >" . money($neg) . "</td>";
            echo "<td align = 'center' ></td>";
            $paid += $s[1];
        }

        echo "<td class='text-left'>";
        echo esc($s[2]);
        echo "</td>";

        echo "</tr>";
    }
    $paid *= (-1);
    echo "<tr>";
    echo "<td colspan='2'>Total </td>";
    echo "<td class='text-right'><b>" . money($paid) . "</b></td>";
    echo "<td class='text-right'><b>" . money($recived) . "</b  ></td>";
    echo "<td> - </td></tr>";
    echo "</table>";
    $total = $qur->party_adv_due($id);
    if ($total < 0) {
        $total *= (-1);
        echo "<h2 class='faintred'>Total Due of " . $name[0][0] . " : " . money($total) . " taka</h2><br/>";
    } elseif ($total > 0) {
        echo "<h2 class='faintred'>Total Outstanding of " . $name[0][0] . " : " . money($total) . " taka</h2><br/>";
    } else {
        echo "<h2 class='green'>You neither have Outstanding nor due with " . $name[0][0] . "</h2><br/>";
    }
}
?>