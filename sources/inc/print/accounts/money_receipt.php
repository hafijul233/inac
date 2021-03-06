<?php

$transaction_id = $inp->value_pgd('transaction');
$party_id = $inp->value_pgd('party');

$money_receipt = $qur->print_money_receipt($transaction_id, $party_id);
if (count($money_receipt) > 2) {
    extract($money_receipt);
} else {
    header("Location: print.php?e=$encptid&page=accounts&sub=money_receipt&transaction=$transaction_id&party=$party_id");
}
//d($money_receipt);
/*$serial = '1232456789';

$client = 'Mohammad Hafijul Islam';
$address = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
$amount = '2000000.56';
$is_cash = false;
$cheque = 123456789;
$chaque_date = strtotime("+15days");
$bank = "Dutch Bangla Bank Ltd.";
$branch = "Mohammadpur";
$ac_no = "123456789";*/
?>
<style>
  td:first-of-type {
    font-weight: normal;
  }
</style>
<h1>Money Receipt</h1>
<table>
  <tr>
    <th width="150" class="text-left">Serial No:</th>
    <td><?= esc($serial) ?></td>
    <td class="text-right" colspan="2"><b>Date: </b> <?= date('d F, Y (D)', strtotime($date)) ?></td>
  </tr>
  <tr>
    <th class="text-left"><br/>Client Name:</th>
    <td colspan="3"><br/><span
          style="display:block; width:100%; border-bottom: 2px dotted black;"><?= esc($client) ?></span></td>
  </tr>
  <tr>
    <th class="text-left" style="vertical-align: top;"><br/>Address:</th>
    <td colspan="3"><br/><span style="display:block; width:100%; border-bottom: 2px dotted black;">
                <?= esc($address) ?>
            </span>
    </td>
  </tr>
  <tr>
    <th colspan="4">
      <div style="margin: auto; font-size: 2rem; padding: 30px">
        Amount:
        <span style="border: 2px solid black; padding: 15px;"><?php
            $fmt = numfmt_create('en_IN', NumberFormatter::CURRENCY);
            echo numfmt_format_currency($fmt, abs($amount), "BDT") . "\n";
            ?></span>
      </div>
    </th>
  </tr>
  <tr>
    <th class="text-left">
      In Words:
    </th>
    <td colspan="3">
        <?php
        $amount = explode('.', $amount);
        $taka = abs($amount[0]);
        $paisa = abs($amount[1]);
        $fmt = numfmt_create('en_IN', NumberFormatter::SPELLOUT);
        $taka_spell = ucwords(str_replace('-', ' ', numfmt_format($fmt, $taka)));
        $paisa_spell = ucwords(str_replace('-', ' ', numfmt_format($fmt, $paisa)));

        if ($paisa != 0)
            printf("%s Taka And %s Poysha Only", $taka_spell, $paisa_spell);
        else
            printf("%s Taka Only", $taka_spell);
        ?>
    </td>
  </tr>
  <tr>
    <table>
      <tr>
        <th width="230" colspan="3" class="text-left"><br/>
          In Cash/ Cheque/ Pay order/ Draft No:
        </th>
        <td style="border-bottom: 2px dotted black; text-align: center"><br/>
            <?= ($is_cash == 1) ? esc($cheque) : null; ?>
        </td>
        <th class="text-center"><br/>
          Dated:
        </th>
        <td width="150" style="font-weight: normal;  border-bottom: 2px dotted black; text-align: center"><br/>
            <?= ($is_cash == 1) ? date('d/m/Y', strtotime($cheque_date)) : null; ?>
        </td>
      </tr>
      <tr>
        <th class="text-left" width="125"><br>Bank Name:</th>
        <td colspan="5" style="border-bottom: 2px dotted black; text-align: center"><br>
            <?= ($is_cash == 1) ? esc($bank) : null; ?>
        </td>
      </tr>
      <tr>
        <th class="text-left"><br>Branch:</th>
        <td colspan="2" style="border-bottom: 2px dotted black; text-align: center"><br>
            <?= ($is_cash == 1) ? esc($branch) : null; ?></td>
        <th class="text-center"><br>A/C No:</th>
        <td colspan="2" style="border-bottom: 2px dotted black; text-align: center"><br>
            <?= ($is_cash == 1) ? esc($ac_no, true) : null; ?></td>
      </tr>
    </table>
  </tr>
</table>
