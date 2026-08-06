<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt</title>

    <style>

        body{
            width:80mm;
            margin:auto;
            font-family:monospace;
            font-size:13px;
        }

        h2,
        p{
            margin:3px 0;
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th,
        td{
            padding:3px 0;
            text-align:left;
        }

        .right{
            text-align:right;
        }

        hr{
            border:none;
            border-top:1px dashed #000;
            margin:8px 0;
        }

        .footer{
            text-align:center;
            margin-top:15px;
        }

    </style>

</head>

<body>

    <h2>HADY STORE</h2>

    <p>Cleaning Products</p>

    <hr>

    <p>Invoice : {{ $sale->invoice_number }}</p>

    <p>Date : {{ $sale->sale_date->format('Y-m-d') }}</p>

    <hr>

    <table>

        <thead>

            <tr>

                <th>Item</th>

                <th>Qty</th>

                <th class="right">Total</th>

            </tr>

        </thead>

        <tbody>

        @foreach($sale->items as $item)

            <tr>

                <td>{{ $item->product->name }}</td>

                <td>{{ $item->quantity }}</td>

                <td class="right">
                    {{ number_format($item->total,2) }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    <hr>

    <table>

        <tr>

            <td>Subtotal</td>

            <td class="right">
                {{ number_format($sale->subtotal,2) }}
            </td>

        </tr>

        <tr>

            <td>Discount</td>

            <td class="right">
                {{ number_format($sale->discount,2) }}
            </td>

        </tr>

        <tr>

            <td>Total</td>

            <td class="right">
                {{ number_format($sale->total,2) }}
            </td>

        </tr>

        <tr>

            <td>Paid</td>

            <td class="right">
                {{ number_format($sale->paid,2) }}
            </td>

        </tr>

        <tr>

            <td>Due</td>

            <td class="right">
                {{ number_format($sale->due,2) }}
            </td>

        </tr>

    </table>

    <hr>

    <div class="footer">

        <strong>Thank You ❤️</strong>

    </div>

    <script>

        window.onload = function () {

            window.print();

            window.onafterprint = function () {

                window.location.href = "{{ route('sales.index') }}";

            };

        };

    </script>

</body>

</html>
