<h2>All Finished Product Stock Report</h2>
<?php
$query = sprintf("SELECT name, stock, factory_stock,unite, price, idproduct FROM (SELECT idproduct,idunite FROM product_details WHERE sell = 1) as product LEFT JOIN product USING (idproduct) LEFT JOIN stock USING(idproduct) LEFT JOIN mesurment_unite USING(idunite)  LEFT JOIN price USING(idproduct);");

$info = $qur->get_custom_select_query($query, 6);
$cost = 0;
if (count($info) > 0) {
    echo "<table class='rb'>";
    echo "<tr>";
    echo "<th>";
    echo "Name";
    echo "</th>";

    echo "<th>";
    echo "Godown";
    echo "</th>";


    echo "<th>";
    echo "Factory";
    echo "</th>";

    echo "<th>";
    echo "Total Stock";
    echo "</th>";

    echo "<th>";
    echo "Unit";
    echo "</th>";

    echo "<th>";
    echo "Price";
    echo "</th>";


    echo "<th>";
    echo "Total";
    echo "</th>";

    echo "</tr>";

    foreach ($info as $ar) {
        echo "<tr>";
        echo "<th>";
        echo "<a href='index.php?e=" . $encptid . "&page=product&sub=particular_product&id=" . $ar[4] . "'>";
        echo $ar[0];
        echo "</a>";
        echo "</th>";

        echo "<td>";
        echo $ar[1];
        echo "</td>";


        echo "<td>";
        echo $ar[2];
        echo "</td>";

        echo "<td>";
        echo $ar[1] + $ar[2];
        echo "</td>";

        echo "<td>";
        echo $ar[3];
        echo "</td>";

        echo "<td>";
        echo money($ar[4]);
        echo "</td>";


        echo "<td>";
        $total = ($ar[1] + $ar[2]) * $ar[4];
        echo money($total);
        $cost += ($ar[1] + $ar[2]) * $ar[4];
        echo "</td>";
        echo "</tr>";
    }

    echo "<tr>";
    echo "<th colspan = '6' >";
    echo "Grand Total : ";
    echo "</th>";

    echo "<td >";
    echo money($cost);
    echo "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "No raw materials is in stock";
}

?>
