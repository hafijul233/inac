<h1>Date wise Factory Stock Report</h1>
<br/>
<?php

include("sources/inc/double_date.php");

if (isset($_GET['group']) && $_GET['group'] == 1) {
    $group = $_GET['group'];
    $query = sprintf("SELECT date,name,stock,unite,price, type FROM (SELECT * FROM product_input WHERE date BETWEEN '%s' AND '%s' AND (type='1' OR type='3')  ) as pro LEFT JOIN product USING(idproduct)LEFT JOIN product_details USING(idproduct) LEFT JOIN mesurment_unite USING(idunite) LEFT JOIN price USING(idproduct) ORDER BY name, date DESC;", $date1, $date2);
    $info = $qur->get_custom_select_query($query, 6);
    $n = count($info);
    $tti_p = $tto_p = $tto_o = 0;
    $tti = $tto = 0;
    if ($n > 0) {
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button'><b> Show Just Date wise </b></a>";
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&date1=" . $date1 . "&&date2=" . $date2 . "&&group=2' class='button'><b> Group Unit wise </b></a>";
        echo "<div class='embossed table-wrap'>";
        echo "<br/><h2>Grouped Product wise</h2><br/>";
        // echo "<small>Report according to price of date " . date("d M Y (D)") . "</small><br/>";
        echo "<br/><a id='printBox'  href='print.php?e=" . $encptid . "&page=stock&&sub=date_report_factory_productwise&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button' target='_blank'><b> Print </b></a><br/>";
        $first_product = $info[0][1];
        $product_trac = 0;
        foreach ($info as $i) {
            if ($product_trac != $i[1]) {
                if ($i[1] != $first_product) {
                    echo "<tfoot>";
                    echo "<tr>";
                    echo "<td colspan='3'>Total Incoming : <br/> " . $tti_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</td>";
                    $tto = -$tto;
                    echo "<td colspan='3'>Total Outgoing : <br/>" . $tto_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tto) . " TK</td>";
                    $total = $tti - $tto;
                    echo "<td colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</td>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "</table><br/>";
                    $tti_p = $tto_p = 0;
                    $tti = $tto = 0;
                }
                echo "<h3>" . $i[1] . "</h3>";
                echo "<br/><table align='center' class='rb table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>";
                echo "Date";
                echo "</th>";
                echo "<th>";
                echo "Product";
                echo "</th>";
                echo "<th>";
                echo "Price  ";
                echo "</th>";
                echo "<th>";
                echo "Incoming";
                echo "</th>";
                echo "<th>";
                echo "Outgoing";
                echo "</th>";
                echo "<th>";
                echo "Unit";
                echo "</th>";
                echo "<th>";
                echo "Total Price  ";
                echo "</th>";
                echo "<th>";
                echo "Remark";
                echo "</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td>";
                echo $inp->date_convert($i[0]);
                echo "</td>";
                echo "<td>";
                echo $i[1];
                echo "</td>";
                echo "<td>";
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
                    if ($i[5] == 0 || $i[5] == 1)
                        echo "<th class='green'>" . money($ss) . "</th>";
                    else
                        echo "<th class='blue'>" . money($ss) . "</th>";
                } else {
                    $tto += $ss;
                    if ($i[5] == 0 || $i[5] == 1) {
                        $ss = -$ss;
                        echo "<th class='red'>" . money($ss) . "</th>";
                    } else
                        echo "<th class='blue'>" . money($ss) . "</th>";
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
                echo "<td>";
                echo $inp->date_convert($i[0]);
                echo "</td>";
                echo "<td>";
                echo $i[1];
                echo "</td>";
                echo "<td>";
                echo $i[4];
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
                    if ($i[5] == 0 || $i[5] == 1)
                        echo "<td class='green'>" . money($ss) . "</td>";
                    else
                        echo "<td class='blue'>" . money($ss) . "</td>";
                } else {
                    $tto += $ss;
                    if ($i[5] == 0 || $i[5] == 1) {
                        $ss = -$ss;
                        echo "<td class='red'>" . money($ss) . "</td>";
                    } else
                        echo "<td class='blue'>" . money($ss) . "</td>";
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
        $tto = -$tto;
        $total = $tti - $tto;

        echo "<tfoot>";
        echo "<tr>";
        echo "<td colspan='3'>Total Incoming : <br/> " . $tti_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</td>";
        echo "<td colspan='3'>Total Outgoing : <br/>" . $tto_p . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tto) . " TK</td>";
        echo "<td colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table><br/>";
    } else {
        echo "<br/><h2 class='blue'>No input or output between ". convert_date($date1) ." and " . convert_date($date2) . "</h2>";
    }
    echo "</div>";

}
elseif (isset($_GET['group']) == 2) {
    $group = $_GET['group'];
    $query = sprintf("SELECT date,name,stock,unite,price,type FROM (SELECT * FROM product_input WHERE date BETWEEN '%s' AND '%s' AND (type='1' OR type='3')  ) as pro LEFT JOIN product USING(idproduct)LEFT JOIN product_details USING(idproduct) LEFT JOIN mesurment_unite USING(idunite) LEFT JOIN price USING(idproduct) ORDER BY unite, date DESC;", $date1, $date2);
    $info = $qur->get_custom_select_query($query, 6);
    $n = count($info);
    $tti_p = $tto_p = $tto_o = 0;
    $tti = $tto = 0;
    if ($n > 0) {
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button'><b> Show Just Date wise </b></a>";
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&group=1&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button'><b> Group Product wise </b></a>";
        echo "<div class='embossed table-wrap'>";
        echo "<br/><h2>Grouped Unit wise</h2><br/>";
        echo "<small>Report according to price of date " . date("d M Y (D)") . "</small><br/>";
        echo "<br/><a id='printBox' href='print.php?e=" . $encptid . "&page=stock&&sub=daily_report_unitwise&&date=" . date('Y-m-d') . "' class='button' target='_blank'><b> Print </b></a></br>";
        $first_unit = $info[0][3];

        $product_trac = null;
        $unit_trac = null;
        $price_trac = null;

        foreach ($info as $i) {
            if ($unit_trac != $i[3]) {
                if ($i[3] != $first_unit) {
                    echo "<tr><td colspan='3'>Total Incoming : <br/> " . $tti_p . " " . $unit_trac . "<b class='blue'> X </b>" . $price_trac . " TK <b class='blue'>=</b> " . $tti . " TK</td><td colspan='3'>Total Outgoing : <br/>" . $tto_p . " " . $unit_trac . "<b class='blue'> X </b>" . $price_trac . " TK <b class='blue'>=</b> " . -$tto . " TK</td><td colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . ($tti + $tto) . " TK</td></tr>";
                    echo "</table><br/>";
                    $tti_p = $tto_p = 0;
                    $tti = $tto = 0;
                }
                echo "<h3>" . $i[3] . "</h3>";
                echo "<br/><table align='center' class='rb table'>";
                echo "<tr>";
                echo "<td>";
                echo "Date";
                echo "</td>";
                echo "<td>";
                echo "Product";
                echo "</td>";
                echo "<td>";
                echo "Price  ";
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
                echo "Total Price  ";
                echo "</td>";
                echo "<td>";
                echo "Remark";
                echo "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>";
                echo $inp->date_convert($i[0]);
                echo "</td>";
                echo "<td>";
                echo $i[1];
                echo "</td>";
                echo "<td>";
                echo $i[4];
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
                    if ($i[5] == 0 || $i[5] == 1)
                        echo "<td class='green'>" . money($ss) . "</td>";
                    else
                        echo "<td class='blue'>" . money($ss) . "</td>";
                } else {
                    $tto += $ss;
                    if ($i[5] == 0 || $i[5] == 1) {
                        $ss = -$ss;
                        echo "<td class='red'>" . money($ss) . "</td>";
                    } else
                        echo "<td class='blue'>" . money($ss) . "</td>";
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
                echo "<td>";
                echo $inp->date_convert($i[0]);
                echo "</td>";
                echo "<td>";
                echo $i[1];
                echo "</td>";
                echo "<td>";
                echo $i[4];
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
                    if ($i[5] == 0 || $i[5] == 1)
                        echo "<td class='green'>" . money($ss) . "</td>";
                    else
                        echo "<td class='blue'>" . money($ss) . "</td>";
                } else {
                    $tto += $ss;
                    if ($i[5] == 0 || $i[5] == 1) {
                        $ss = -$ss;
                        echo "<td class='red'>" . money($ss) . "</td>";
                    } else
                        echo "<td class='blue'>" . money($ss) . "</td>";
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
                    echo "Godown to factory ";
                }
                echo "</td>";

                echo "</tr>";
            }
            $product_trac = $i[1];
            $price_trac = $i[4];
            $unit_trac = $i[3];
        }
        $tto = -$tto;
        $total = $tti - $tto;
        echo "<tr><td colspan='3'>Total Incoming : <br/> " . money($tti_p) . " " . $unit_trac . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</td><td colspan='3'>Total Outgoing : <br/>" . money($tto_p) . " " . $unit_trac . "<b class='blue'> X </b>" . $price_trac . " TK <b class='blue'>=</b> " . money($tto) . " TK</td><td colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</td></tr>";
        echo "</table><br/>";
    } else {
        echo "<br/><h2 class='blue'>No input or output between " . convert_date($date) . " and " . convert_date($date) . "</h2>";
    }
    echo "</div>";

}
else {
    $query = sprintf("SELECT date,name,stock, unite,price,type FROM (SELECT * FROM product_input WHERE date BETWEEN '%s' AND '%s' AND (type='1' OR type='3')  ) as pro LEFT JOIN product USING(idproduct)LEFT JOIN product_details USING(idproduct) LEFT JOIN mesurment_unite USING(idunite) LEFT JOIN price USING(idproduct) ORDER BY date DESC;", $date1, $date2);
    $info = $qur->get_custom_select_query($query, 6);
    $n = count($info);
    $tti = $tto = $tto_o = 0;
    $tti_p = $tto_p = 0;
    $tto_o = 0;
    if ($n > 0) {
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&group=1&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button'><b> Group Product wise </b></a>";
        echo "<a href='index.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&date1=" . $date1 . "&&date2=" . $date2 . "&&group=2' class='button'><b> Group Unit wise </b></a>";
        echo "<div class='embossed table-wrap'>";
        echo "<h2>Grouped Date Wise</h2>";
        echo "<br/><small>Report according to date " . date("d M Y (D)") . "</small><br/>";
        echo "<br/><a id='printBox'  href='print.php?e=" . $encptid . "&page=stock&&sub=date_report_factory&&date1=" . $date1 . "&&date2=" . $date2 . "' class='button' target='_blank'><b> Print </b></a></br>";
        echo "<br/><table align='center' class='rb table'>";
        echo "<thead>";

        echo "<tr>";

        echo "<th>";
        echo "Date";
        echo "</th>";

        echo "<th>";
        echo "Product";
        echo "</th>";

        echo "<th>";
        echo "Price  ";
        echo "</th>";


        echo "<th>";
        echo "Incoming";
        echo "</th>";

        echo "<th>";
        echo "Outgoing";
        echo "</th>";

        echo "<th>";
        echo "Unit";
        echo "</th>";

        echo "<th>";
        echo "Total Price  ";
        echo "</th>";

        echo "<th>";
        echo "Remark";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($info as $i) {
            echo "<tr>";

            echo "<td>";
            echo $inp->date_convert($i[0]);
            echo "</td>";

            echo "<td>";
            echo $i[1];
            echo "</td>";

            echo "<td>";
            echo $i[4];
            echo "</td>";

            if ($i[2] > 0) {
                echo "<td>";
                echo $i[2];
                if ($i[5] == 0 || $i[5] == 1)
                    $tti_p += $i[2];

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
                    $tto_o += (-$i[2]);
                echo "</td>";
            }

            echo "<td>";
            echo $i[3];
            echo "</td>";
            $ss = $i[2] * $i[4];
            if ($ss > 0) {
                $tti += $ss;
                if ($i[5] == 0 || $i[5] == 1)
                    echo "<td class='green'>" . money($ss) . "</td>";
                else
                    echo "<td class='blue'>" . money($ss) . "</td>";
            } else {
                $tto += $ss;
                if ($i[5] == 0 || $i[5] == 1) {
                    $ss = -$ss;
                    echo "<td class='red'>" . money($ss) . "</td>";
                } else
                    echo "<td class='blue'>" . money($ss) . "</td>";
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
        echo "</tbody>";
        echo "<tfoot>";
        $tto = -$tto;
        $total = $tti - $tto;
        echo "<tr><td colspan='3'>Total Incoming : <br/> " . money($tti_p) . " " . esc($unit_trac) . "<b class='blue'> X </b>" . money($price_trac) . " TK <b class='blue'>=</b> " . money($tti) . " TK</td><td colspan='3'>Total Outgoing : <br/>" . money($tto_p) . " " . $unit_trac . "<b class='blue'> X </b>" . $price_trac . " TK <b class='blue'>=</b> " . money($tto) . " TK</td><td colspan='2'>Total (Incoming  -  Outgoing) : <br/>" . money($total) . " TK</td></tr>";
        echo "</tfoot>";
        echo "</table>";
    } else {
        echo "<br/><h2 class='blue'>No input or output between ". convert_date($date1) ." and " . convert_date($date2) . "</h2>";
    }
    echo "</div>";
}


?>