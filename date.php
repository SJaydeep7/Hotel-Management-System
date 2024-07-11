<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Picker Example</title>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .date-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="date-container">
    <!-- Date Picker 1 -->
    <label for="datepicker1">Check-in Date:</label>
    <input type="text" id="datepicker1" name="checkin_date">
</div>

<div class="date-container">
    <!-- Date Picker 2 -->
    <label for="datepicker2">Check-out Date:</label>
    <input type="text" id="datepicker2" name="checkout_date">
</div>

<script>
    // Initialize datepicker for each input field
    $(function () {
        // Date Picker 1
        $("#datepicker1").datepicker({
            dateFormat: "yy-mm-dd", // Set desired date format
            minDate: 0, // Set minimum date to today
            onSelect: function (selectedDate) {
                // Set the minimum date for the second date picker
                $("#datepicker2").datepicker("option", "minDate", selectedDate);
            }
        });

        // Date Picker 2
        $("#datepicker2").datepicker({
            dateFormat: "yy-mm-dd", // Set desired date format
            minDate: 0, // Set minimum date to today
            onSelect: function (selectedDate) {
                // Set the maximum date for the first date picker
                $("#datepicker1").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>

</body>
</html>
