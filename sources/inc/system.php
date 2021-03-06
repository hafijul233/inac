<?php
session_start();
date_default_timezone_set('Asia/Dhaka');

//Theme Choice Variable 1 as default
$_SESSION['theme'] = (isset($_SESSION['theme'])) ? $_SESSION['theme'] : null;

//USER TYPE CONSTANTS
defined('STAFF') || define('STAFF', 0);
defined('ADMIN') || define('ADMIN', 1);
defined('USER') || define('USER', 2);

//App Constants
defined('COMPANY') || define('COMPANY', "Agro Fresh", true);
defined('SENDER_EMAIL') || define('SENDER_EMAIL', "Agro Fresh", true);
defined('SENDER_NAME') || define('SENDER_NAME', "Agro Fresh", true);
defined('BALANCE') || define('BALANCE', "0");
defined('CASH') || define('CASH', "0");
defined('BANK') || define('BANK', "1");
defined('ENTRY') || define('ENTRY', "entry");
defined('EXPENSE') || define('EXPENSE', "return");
defined('INVESTMENT') || define('INVESTMENT', "invest");
defined('DRAWING') || define('DRAWING', "draw");

/** Debug Function
 * @param mixed ...$var
 */
function d(...$var)
{
    echo "<pre>";
    var_dump(...$var);
    echo "</pre>";
}


/**
 * print (-) if variable is not set
 * used for clean output
 * @param $variable
 * @return string
 */
function esc(&$variable, $force_string = false)
{
    if (isset($variable)) {
        if (is_numeric($variable) && $force_string == false) {
            if (is_integer($variable))
                return intval($variable);
            else
                return floatval($variable);
        } else
            return htmlentities($variable);
    } else return '-';
}

/**
 * print (0.0) if variable is not set
 * @param $variable
 * @return float
 */
function esc_num(&$variable)
{
    if (isset($variable))
        return floatval($variable);
    else
        return 0.00;
}

/**
 * money format converter function
 * thousand separator and fixed
 * 2 decimal point
 * @param $number
 * @return string
 */
function money(&$number)
{
    if (isset($number) && is_numeric($number))
        return number_format($number, '2', '.', ',');
    else
        return '0.00';
}

function convert_date($date)
{
    $dates = explode('-', $date);
    if (checkdate($dates[1], $dates[2], $dates[0])) {
        return date("d M Y (D)", strtotime($date));
    } else {
        return 'Invalid Date';
    }
}