<h1>Particular Product Overview</h1>
<br/>
<?php
$id = $inp->value_pgd('id');
echo "<form method = 'POST'  class='embossed'>";
$product = $qur->get_custom_select_query('SELECT idproduct, name FROM product LEFT JOIN product_details USING (idproduct);', 2);
echo "<h4 class='blue'>Select Product</h4><br/>";
echo "<img src='images/blank1by1.gif' width='300px' height='1px'/><br/>";
if (isset($id)) {
    $qur->get_dropdown_array($product, 0, 1, 'id', $id, 'full-width');
} else {
    $qur->get_dropdown_array($product, 0, 1, 'id', null, 'full-width');
}
echo "<br/><br/><input type = 'submit' name = 'ab' value = 'Show' />";
echo "</form><br/>";

if (isset($id)) {
    include("sources/inc/double_date_id.php");
    echo "<br/>";
    $info = $qur->get_particular_product_overview($id, $date1, $date2);
    $n = count($info);
    if ($n > 0) {
        $qun = 0;
        $cos = 0;
        echo "<br/><a id='printBox' href='print.php?e=" . $encptid . "&page=product&&sub=particular_product&&date1=" . $date1 . "&&date2=" . $date2 . "&&id=" . $id . "' class='button' target='_blank'><b> Print </b></a><br/>";

        echo "<h3 class='green'>Current Stock : " . $qur->current_stock($id) . "</h3>";

        echo "<br/><table align='center' class='rb table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>";
        echo "Date";
        echo "</th>";
        echo "<th>";
        echo "Party";
        echo "</th>";
        echo "<th>";
        echo "Quantity";
        echo "</th>";
        echo "<th>";
        echo "Price";
        echo "</th>";
        echo "<th>";
        echo "Total";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($info as $i) {
            echo "<tr>";
            echo "<td>";
            echo $inp->date_convert($i[0]);
            echo "</td>";

            echo "<th>";
            echo esc($i[1]);
            echo "</th>";

            echo "<td>";
            echo esc($i[2]);
            $qun += esc_num($i[2]);
            echo "</td>";

            echo "<td class='text-right pr-50'>";
            echo money($i[3]);

            echo "</td>";

            echo "<td class=' text-right pr-50'>";
            $mul = $i[2] * $i[3];
            echo money($mul);
            $cos += $mul;
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";

        /*echo "<tr>";
        echo "<td colspan = 2>";
        echo "Total ";
        echo "</td>";
        echo "<td ><b>";
        echo $qun;
        echo "</b></td>";
        echo "<td> </td>";
        echo "<td><b>" . money($cos) . "</b></td>";
        echo "</tr>";*/
        echo "</table>";
    } else {
        echo "<br/><h3 class='blue'>There is nothing to show about this item between these dates</h3>";
    }

}

?>