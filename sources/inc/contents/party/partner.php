<h1>All Business Partner</h1>
<?php
echo "<br/><a id='printBox' href='print.php?e=" . $encptid . "&page=party&&sub=partner' class='button' target='_blank'><b> Print </b></a><br/>";
$query = sprintf("SELECT idparty,name,adress,phone FROM (SELECT party.idparty,name FROM party JOIN party_type USING(idparty) WHERE type = 3) as party LEFT JOIN party_phone USING(idparty) LEFT JOIN party_adress USING (idparty) ORDER BY name;");
$party = $qur->get_custom_select_query($query, 4);
$all_info = [];
$due_total = 0;
$advance_total = 0;

$n = count($party);
if ($n > 0) {
    for ($i = 0; $i < $n; $i++) {
        if ($i != $n - 1 && $party[$i][0] == $party[$i + 1][0]) {
            $all_info[$i][0] = $party[$i][0];
            $all_info[$i][1] = $party[$i][1];
            $all_info[$i][2] = $party[$i][2];
            $all_info[$i][3] = $party[$i][3];
            $all_info[$i][4] = $party[$i + 1][3];
            $all_info[$i][5] = $qur->party_adv_due($party[$i][0]);
            $i++;
        } else {
            $all_info[$i][0] = $party[$i][0];
            $all_info[$i][1] = $party[$i][1];
            $all_info[$i][2] = $party[$i][2];
            $all_info[$i][3] = $party[$i][3];
            $all_info[$i][4] = null;
            $all_info[$i][5] = $qur->party_adv_due($party[$i][0]);
        }
    }
}
echo "<table align='center' class='rb table'>";
echo "<thead>";
echo "<tr>";
echo "<th>";
echo "Name";
echo "</th>";

echo "<th>";
echo "Address";
echo "</th>";

echo "<th>";
echo "Phone";
echo "</th>";

echo "<th>";
echo "Have Due";
echo "</th>";

echo "<th>";
echo "Paid Advance";
echo "</th>";
echo "</tr>";

echo "</thead>";
echo "<tbody>";
if (count($all_info) > 0) {
    foreach ($all_info as $a) {
        echo "<tr>";
        echo "<td class='text-left pl-50'>";
        echo "<a href='index.php?e=" . $encptid . "&&page=party&&sub=view_particular&&id=" . $a[0] . "'>";
        echo $a[1];
        echo "</a>";
        echo "</td>";

        echo "<td class='pl-50 text-left'>";
        echo "<a href='index.php?e=" . $encptid . "&&page=party&&sub=view_particular&&id=" . $a[0] . "'>";
        echo $a[2];
        echo "</a>";
        echo "</td>";

        echo "<td>";
        echo "<a href='index.php?e=" . $encptid . "&&page=party&&sub=view_particular&&id=" . $a[0] . "'>";
        echo $a[3];
        if ($a[4]) {
            echo ", ";
            echo $a[4];
        }
        echo "</a>";
        echo "</td>";


        echo "<td align = 'center' >";
        echo "<a href='index.php?e=" . $encptid . "&&page=party&&sub=view_particular&&id=" . $a[0] . "'>";
        if ($a[5] < 0) {
            $due = -$a[5];
            echo money($due);
            $due_total = $due_total + (-$a[5]);
        } else {
            echo "-";
        }
        echo "</a>";
        echo "</td>";


        echo "<td align = 'center' >";
        echo "<a href='index.php?e=" . $encptid . "&&page=party&&sub=view_particular&&id=" . $a[0] . "'>";
        if ($a[5] > 0) {
            echo money($a[5]);
            $advance_total = $advance_total + $a[5];
        } else {
            echo "-";
        }
        echo "</a>";
        echo "</td>";
        echo "</tr>";
    }
}
echo "</tbody>";
//echo "<tr><th colspan='3'>Total</th><th>" . money($due_total) . "</th><th>" . money($advance_total) . "</th></tr>";
echo "</table>";
?>
