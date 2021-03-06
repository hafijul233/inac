<h2>Accounts Report</h2>
<?php

include("sources/inc/print/double_date.php");

$ob = $qur->getPrevBalance($date1);
echo "<h4>Opening Balance of " . $inp->date_convert($date1) . " : " . $ob . " Taka</h4>";
$query = sprintf("SELECT * FROM (SELECT * FROM transaction WHERE DATE BETWEEN '%s' AND '%s') as tran LEFT JOIN transaction_comment USING(id) ORDER BY DATE DESC;", $date1, $date2);
$res = $qur->get_custom_select_query($query, 5);

$in_total = 0;
$out_total = 0;

echo "<table align='center' class='rb'>";
echo "<tr>";

echo "<th>SI</th>";

echo "<th>";
echo "Date";
echo "</th>";

echo "<th>";
echo "Investment / Revenue";
echo "</th>";

echo "<th>";
echo "Drawings / Expenses";
echo "</th>";

echo "<th width='200px'>";
echo "Comments";
echo "</th>";
echo "</tr>";
$p = 0;
$r = 0;
$j = 1;
for ($i = 0; $i < count($res); $i++) {
    echo "<tr>";

    echo "<td>" . $j++ . "</td>";

    echo "<td>";
    echo $inp->date_convert($res[$i][1]);
    echo "</td>";


    if ($res[$i][3] > 0) {
        $total = $res[$i][3];
        echo "<td class='text-right'>";
        echo money($total);
        echo "</td>";
        $in_total += $res[$i][3];

        echo "<td>";
        echo "-";
        echo "</td>";
    } else {
        echo "<td>";
        echo "-";
        echo "</td>";

        $total = $res[$i][3] * (-1);
        echo "<td class='text-right'>";
        echo money($total);
        echo "</td>";
        $out_total = $out_total + ($res[$i][3] * (-1));
    }

    if (isset($res[$i][4])) {
        echo "<td width='100px' class='text-left'>";
        echo $res[$i][4];
        echo "</td>";
    } else {
        echo "<td width='100px'>";
        echo "-";
        echo "</td>";
    }

    echo "</tr>";
}

echo "<tr>";
echo "<th colspan='2' class='text-right'>Total</th>";
echo "<th class='text-right'>" . money($in_total) . "</th>";
echo "<th class='text-right'>" . money($out_total) . "</th>";
$total = $in_total - $out_total;
echo "<th>Balance : " . money($total) . "</th>";
echo "</tr>";

echo "</table>";
?>