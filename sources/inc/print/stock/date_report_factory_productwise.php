<h2>Date wise Factory Stock Report</h2>
<?php
include("sources/inc/print/double_date.php");
$query = sprintf("SELECT date,name,stock,unite,price, type FROM (SELECT * FROM product_input WHERE date BETWEEN '%s' AND '%s' AND (type='1' OR type='3')  ) as pro LEFT JOIN product USING(idproduct)LEFT JOIN product_details USING(idproduct) LEFT JOIN mesurment_unite USING(idunite) LEFT JOIN price USING(idproduct) ORDER BY name, date DESC;", $date1, $date2);
$info = $qur->get_custom_select_query($query, 6);
$n = count($info);
$tti_p = $tto_p = $tto_o = 0;
$tti = $tto = $product_trac = 0;
$si = 1;
if ($n > 0) {
    // echo "<small>Report according to price of date " . date("d M Y (D)") . "</small><br/>";
    $first_product = $info[0][1];
    foreach ($info as $i) {

        if ($product_trac != $i[1]) {
            if ($i[1] != $first_product) {
                echo "<tr>";
                echo "<th>-</th>";
                echo "<th colspan='3'>Total Incoming : <br/> " . $tti_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</th>";
                $tto = -$tto;
                echo "<th colspan='3'>Total Outgoing : <br/>" . $tto_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tto) . " TK</th>";
                $total = $tti - $tto;
                echo "<th colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</th>";
                echo "</tr>";
                echo "</table><br/>";
                $tti_p = $tto_p = 0;
                $tti = $tto = 0;
                $si = 1;
            }
            echo "<h3>" . $i[1] . "</h3>";
            echo "<table align='center' class='rb'>";
            echo "<tr>";

            echo "<th>SI</th>";

            echo "<td>";
            echo "Date";
            echo "</td>";

            echo "<td>";
            echo "Product";
            echo "</td>";

            echo "<td>";
            echo "Price ";
            echo "</td>";

            echo "<td>";
            echo "Incoming";
            echo "</td>";

            echo "<td>";
            echo "Outgoing";
            echo "</td>";

            echo "<td>";
            echo "Unit";
            echo "</td>";

            echo "<td>";
            echo "Total Price ";
            echo "</td>";

            echo "<td>";
            echo "Remark";
            echo "</td>";

            echo "</tr>";
            echo "<tr>";

            echo "<td>" . $si++ . "</td>";

            echo "<td>";
            echo $inp->date_convert($i[0]);
            echo "</td>";

            echo "<td>";
            echo $i[1];
            echo "</td>";

            echo "<td class='text-right'>";
            echo money($i[4]);
            echo "</td>";

            if ($i[2] > 0) {
                echo "<td>";
                echo $i[2];
                if ($i[5] == 0 || $i[5] == 1)
                    $tti_p = $tti_p + $i[2];

                echo "</td>";

                echo "<td>";
                if ($i[5] == 0 || $i[5] == 1) {
                    echo "-";
                } else {
                    echo $i[2];
                }
                echo "</td>";

            } else {

                echo "<td>";
                if ($i[5] == 0 || $i[5] == 1) {
                    echo "-";
                } else {
                    echo $i[2];
                }
                echo "</td>";

                echo "<td>";
                echo(-$i[2]);
                if ($i[5] == 0 || $i[5] == 1)
                    $tto_p = $tto_o + (-$i[2]);
                echo "</td>";

            }

            echo "<td>";
            echo $i[3];
            echo "</td>";

            $ss = $i[2] * $i[4];
            if ($ss > 0) {
                $tti += $ss;
                echo "<td class='text-right'>" . money($ss) . "</td>";
            } else {
                $tto += $ss;
                $ss = -$ss;
                echo "<td class='text-right'>" . money($ss) . "</td>";
            }

            echo "<td>";
            if ($i[5] == 0) {
                echo "Godown";
            }
            if ($i[5] == 1) {
                echo "Factory";
            }
            if ($i[5] == 2) {
                echo "Factory to godown";
            }
            if ($i[5] == 3) {
                echo "Godown to factory";
            }
            echo "</td>";

            echo "</tr>";

        } else {
            echo "<tr>";

            echo "<td>" . $si++ . "</td>";

            echo "<td>";
            echo $inp->date_convert($i[0]);
            echo "</td>";

            echo "<td>";
            echo $i[1];
            echo "</td>";

            echo "<td class='text-right'>";
            echo money($i[4]);
            echo "</td>";

            if ($i[2] > 0) {
                echo "<td>";
                echo $i[2];
                echo "</td>";
                if ($i[5] == 0 || $i[5] == 1) $tti_p = $tti_p + $i[2];

                echo "<td>";
                if ($i[5] == 0 || $i[5] == 1) {
                    echo "-";
                } else {
                    echo $i[2];
                }
                echo "</td>";

            } else {

                echo "<td>";
                if ($i[5] == 0 || $i[5] == 1) {
                    echo "-";
                } else {
                    echo $i[2];
                }
                echo "</td>";

                echo "<td>";
                echo(-$i[2]);
                echo "</td>";
                if ($i[5] == 0 || $i[5] == 1) $tto_p = $tto_o + (-$i[2]);

            }

            echo "<td>";
            echo $i[3];
            echo "</td>";

            $ss = $i[2] * $i[4];
            if ($ss > 0) {
                $tti += $ss;
                echo "<td class='text-right'>" . money($ss) . "</td>";
            } else {
                $tto += $ss;
                $ss = -$ss;
                echo "<td class='text-right'>" . money($ss) . "</td>";
            }
            echo "<td>";

            if ($i[5] == 0) {
                echo "Godown";
            }
            if ($i[5] == 1) {
                echo "Factory";
            }
            if ($i[5] == 2) {
                echo "Factory to godown";
            }
            if ($i[5] == 3) {
                echo "Godown to factory";
            }
            echo "</td>";

            echo "</tr>";
        }
        $product_trac = $i[1];
        $price_trac = $i[4];
        $unit_trac = $i[3];
    }
    echo "<tr>";
    echo "<th>-</th>";
    echo "<th colspan='3'>Total Incoming : <br/> " . $tti_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</th>";
    $tto = -$tto;
    echo "<th colspan='3'>Total Outgoing : <br/>" . $tto_p . " " . $unit_trac . "<b class='blue'> X </b>" . $price_trac . " TK <b class='blue'>=</b> " . money($tto) . " TK</th>";
    $total = $tti - $tto;
    echo "<th colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</th>";
    echo "</tr>";
    echo "</table><br/>";
    // echo "<br/><small>Report according to price of date " . date("d M Y (D)") . "</small>";
} else {
    echo "<br/><h2 class='blue'>No input or output between $date1 and $date2</h2>";
}
?>