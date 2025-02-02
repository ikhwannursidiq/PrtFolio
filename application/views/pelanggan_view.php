<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html>
<head>
    <style>
        body {font-family: sans-serif;
            font-size: 10pt;
        }
        p {	margin: 0pt; }
        table.items {
            border: 0.1mm solid #000000;
        }
        td { vertical-align: top; }
        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }
        table thead td { background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }
        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #000000;
            background-color: #FFFFFF;
            border: 0mm none #000000;
            border-top: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }
        .items td.totals {
            text-align: right;
            border: 0.1mm solid #000000;
        }
        .items td.cost {
            text-align: "." center;
        }
    </style>
</head>
<body>

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="15%">Ref. No.</td>
        <td width="10%">Quantity</td>
        <td width="45%">Description</td>
        <td width="15%">Unit Price</td>
        <td width="15%">Amount</td>
    </tr>
    </thead>
    <tbody>
    <!-- ITEMS HERE -->
    
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MX37801982</td>
        <td align="center">1</td>
        <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
        <td class="cost">&pound;102.11</td>
        <td class="cost">&pound;102.11</td>
    </tr>
    <tr>
        <td align="center">MR7009298</td>
        <td align="center">25</td>
        <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
        <td class="cost">&pound;12.26</td>
        <td class="cost">&pound;325.60</td>
    </tr>
    <!-- END ITEMS HERE -->
    <tr>
        <td class="blanktotal" colspan="3" rowspan="6"></td>
        <td class="totals">Subtotal:</td>
        <td class="totals cost">&pound;1825.60</td>
    </tr>
    <tr>
        <td class="totals">Tax:</td>
        <td class="totals cost">&pound;18.25</td>
    </tr>
    <tr>
        <td class="totals">Shipping:</td>
        <td class="totals cost">&pound;42.56</td>
    </tr>
    <tr>
        <td class="totals"><b>TOTAL:</b></td>
        <td class="totals cost"><b>&pound;1882.56</b></td>
    </tr>
    <tr>
        <td class="totals">Deposit:</td>
        <td class="totals cost">&pound;100.00</td>
    </tr>
    <tr>
        <td class="totals"><b>Balance due:</b></td>
        <td class="totals cost"><b>&pound;1782.56</b></td>
    </tr>
    </tbody>
</table>
<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>
</body>
</html>
