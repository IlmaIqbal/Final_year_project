<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div>
        <h1>Thank you for your purchase</h1>

        <table>
            <tr>
                <td>Event Type:</td>
                <td class="text-right">{{ $eventData['event_type']  }}</td>
            </tr>
            <tr>
                <td>Number of Guests:</td>
                <td class="text-right">{{ $eventData['guest_no'] }}</td>
            </tr>
            <tr>
                <td>Start Date:</td>
                <td class="text-right">{{ $eventData['start_date'] }}</td>
            </tr>
            <tr>
                <td>End Date:</td>
                <td class="text-right">{{ $eventData['end_date'] }}</td>
            </tr>
            <tr>
                <td>Venue:</td>
                <td class="text-right">{{ $eventData['venue_name'] }}</td>
            </tr>
            <tr>
                <td>Venue Location:</td>
                <td class="text-right">{{ $eventData['venue_location'] }}</td>
            </tr>
            <tr>
                <td>Venue Price:</td>
                <td class="text-right">{{ $eventData['venue_price'] }}</td>
            </tr>
            <tr>
                <td>Catering:</td>
                <td class="text-right">{{ $eventData['catering_name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Catering Price:</td>
                <td class="text-right">{{ $eventData['catering_price']?? 0 }}</td>
            </tr>
            <tr>
                <td>Decoration:</td>
                <td class="text-right">{{ $eventData['decoration_name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Decoration Price:</td>
                <td class="text-right">{{ $eventData['decoration_price']?? 0 }}</td>
            </tr>
            <tr>
                <td>Entertainment:</td>
                <td class="text-right">{{ $eventData['entertainment_name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Entertainment Price:</td>
                <td class="text-right">{{ $eventData['entertainment_price']?? 0 }}</td>
            </tr>
            <tr>
                <td>Total:</td>
                <td class="text-right fw-bold">{{ 'Rs. ' . number_format((float)(
                    ($eventData['venue_price'] ?? 0) +
                    ($eventData['catering_price'] ?? 0) +
                    ($eventData['decoration_price'] ?? 0) +
                    ($eventData['entertainment_price'] ?? 0)
                    ), 2) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>