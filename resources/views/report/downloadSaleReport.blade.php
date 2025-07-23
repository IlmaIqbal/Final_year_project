<!DOCTYPE html>
<html>

<head>
    <title>{{ ucfirst($type) }} Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <h2>{{ ucfirst($type) }} Sales Report</h2>

    <table>
        <thead>
            <tr>
                <th>{{ ucfirst($type) }}</th>
                <th>Total Quantity</th>
                <th>Total Revenue (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $label => $data)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['quantity'] }}</td>
                <td>Rs. {{ number_format($data['revenue'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>