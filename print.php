<?php
include("./sources/inc/system.php");
include("sources/inc/security_o.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="css/printstyle.css" type="text/css"/>
  <script type='text/javascript' src='js/print.js'></script>
</head>
<body onLoad="printpage()" style="width: 900px; margin: 0 auto;  font-size: 16pt;">
<center>
  <h1 id='banner'><?= COMPANY ?></h1>
    <?php
    $page = $inp->value_pgd('page');
    $sub = $inp->value_pgd('sub');
    $section = "print";
    include("sources/inc/content.php");
    ?>
</center>
<?php echo "<b style='display:block; bottom: 0; margin-top: 2rem;'>Printed on : " . date("d M Y (D) h:i:s A") . "</b>"; ?>
</body>
</html>
