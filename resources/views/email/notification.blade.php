<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h2>{{ $title }}</h2>
    <table style="width: 100%;">
        <tr>
        	<td style="padding-top: 5px;">
        		<h4>First Name</h4>
        		<span>{{ $firstName }}</span>
        	</td>

        	<td style="padding-top: 5px;">
        		<h4>Last Name</h4>
        		<span>{{ $lastName }}</span>
        	</td>
        </tr>

        <tr>
        	<td style="padding-top: 30px;">
        		<h4>Date</h4>
        		<span>{{ $date }}</span>
        	</td>
        	
        	<td style="padding-top: 30px;">
        		<h4>Flight No.</h4>
        		<span>{{ $flight->flight_number }}</span>
            </td>
            <td style="padding-top: 30px;">
                <h4>Departure - Arrival Time</h4>
                <span>{{ $flight->departureTime() }} - {{ $flight->arrivalTime() }}</span>
        	</td>
        </tr>

        <tr>
            <td style="padding-top: 30px;">
            	<h4>Message</h4>
            	<p>{{ $notification }}</p>
            </td>
        </tr>
    </table>
</body>
</html>