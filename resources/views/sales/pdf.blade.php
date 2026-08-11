<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Invoice</title>

    <style>

        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
        }

        * {
            box-sizing: border-box;
        }

        .header {
            width: 100%;
            margin-bottom: 25px;
        }

        .left {
            float: left;
            width: 60%;
        }

        .right {
            float: right;
            width: 40%;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        h1 {
            margin: 0;
            color: #2563eb;
            font-size: 30px;
        }

        h2 {
            margin: 5px 0;
            font-size: 18px;
        }

        .store {
            font-size: 14px;
            color: #666;
        }

        .box {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            padding: 6px 0;
        }

        .title {
            font-weight: bold;
            color: #555;
            width: 150px;
        }

    </style>

</head>

<body>

<div class="header">

    <div class="left">

        <h1>Hady Store</h1>

        <div class="store">
            Cleaning Products Store
        </div>

        <h2 style="margin-top:20px;">
            SALES INVOICE
        </h2>

    </div>

    <div class="right">

        <strong>Invoice #</strong><br>

        {{ $sale->invoice_number }}

        <br><br>

        <strong>Date</strong><br>

        {{ $sale->sale_date->format('Y-m-d') }}

    </div>

    <div class="clear"></div>

</div>


<div class="box">

    <table class="info">

        <tr>

            <td class="title">
                Customer
            </td>

            <td>
                {{ $sale->customer?->name ?? 'Cash Customer' }}
            </td>

        </tr>

        <tr>

            <td class="title">
                Payment Method
            </td>

            <td>
                {{ ucfirst(str_replace('_',' ',$sale->payment_method)) }}
            </td>

        </tr>

        <tr>

            <td class="title">
                Paid
            </td>

            <td>
                {{ number_format($sale->paid,2) }}
            </td>

        </tr>

        <tr>

            <td class="title">
                Due
            </td>

            <td>
                {{ number_format($sale->due,2) }}
            </td>

        </tr>

    </table>

</div>
<div style="margin-top:25px;">

    <table>

        <thead>

            <tr style="background:#2563eb;color:#fff;">

                <th style="padding:10px;border:1px solid #ddd;">
                    #
                </th>

                <th style="padding:10px;border:1px solid #ddd;text-align:left;">
                    Product
                </th>

                <th style="padding:10px;border:1px solid #ddd;">
                    Qty
                </th>

                <th style="padding:10px;border:1px solid #ddd;">
                    Unit Price
                </th>

                <th style="padding:10px;border:1px solid #ddd;">
                    Total
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($sale->items as $item)

                <tr>

                    <td style="padding:8px;border:1px solid #ddd;text-align:center;">
                        {{ $loop->iteration }}
                    </td>

                    <td style="padding:8px;border:1px solid #ddd;">
                        {{ $item->product?->name }}
                    </td>

                    <td style="padding:8px;border:1px solid #ddd;text-align:center;">
                        {{ $item->quantity }}
                    </td>

                    <td style="padding:8px;border:1px solid #ddd;text-align:right;">
                        {{ number_format($item->sale_price,2) }}
                    </td>

                    <td style="padding:8px;border:1px solid #ddd;text-align:right;">
                        {{ number_format($item->total,2) }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>


<table style="width:320px;margin-top:25px;margin-left:auto;">

    <tr>

        <td style="padding:8px;border:1px solid #ddd;font-weight:bold;">
            Subtotal
        </td>

        <td style="padding:8px;border:1px solid #ddd;text-align:right;">
            {{ number_format($sale->subtotal,2) }}
        </td>

    </tr>

    <tr>

        <td style="padding:8px;border:1px solid #ddd;font-weight:bold;">
            Discount
        </td>

        <td style="padding:8px;border:1px solid #ddd;text-align:right;">
            {{ number_format($sale->discount,2) }}
        </td>

    </tr>

    <tr>

        <td style="padding:8px;border:1px solid #ddd;font-weight:bold;">
            Total
        </td>

        <td style="padding:8px;border:1px solid #ddd;text-align:right;">
            {{ number_format($sale->total,2) }}
        </td>

    </tr>

    <tr>

        <td style="padding:8px;border:1px solid #ddd;font-weight:bold;">
            Paid
        </td>

        <td style="padding:8px;border:1px solid #ddd;text-align:right;">
            {{ number_format($sale->paid,2) }}
        </td>

    </tr>

    <tr>

        <td style="padding:8px;border:1px solid #ddd;font-weight:bold;color:#dc2626;">
            Due
        </td>

        <td style="padding:8px;border:1px solid #ddd;text-align:right;color:#dc2626;font-weight:bold;">
            {{ number_format($sale->due,2) }}
        </td>

    </tr>

</table>

@if($sale->notes)

<div style="margin-top:30px;">

    <strong>Notes</strong>

    <div style="margin-top:8px;padding:10px;border:1px solid #ddd;">

        {{ $sale->notes }}

    </div>

</div>

@endif
<hr style="margin-top:40px;border:none;border-top:1px solid #ddd;">

<div style="margin-top:15px;text-align:center;color:#666;font-size:12px;">

    <p>
        Thank you for your business ❤️
    </p>

    <p>
        Hady Store - Cleaning Products Management System
    </p>

    <p>
        Printed at:
        {{ now()->format('Y-m-d h:i A') }}
    </p>

</div>

</body>

</html>
