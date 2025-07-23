<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Stock Level Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .status {
            font-weight: bold;
        }

        .in-stock {
            color: green;
        }

        .low-stock {
            color: orange;
        }

        .out-stock {
            color: red;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Stock Level Report</h2>
        <p>Beautiful Celebration</p>
        <p>3184 Spruce Drive, Pittsburgh, PA 15201</p>
        <p>Email: bc@gmail.com | Phone: 081-345-6789</p>
    </div>
    <p>Date : {{ now()->format('F d, Y h:i A ') }}</p>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Current Stock</th>
                <th>Reorder Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $value)

            @php
            $availableQty = $value->total_qty - $value->total_issued;
            @endphp
            <tr>
                <td>{{ $value->product->name }}</td>
                <td>{{ $value->product->product_type }}</td>
                <td>{{ $availableQty }}</td>
                <td>{{ $value->product->reorder_level}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>