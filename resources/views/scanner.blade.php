<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* CSS styles */
    </style>
</head>
<body class="antialiased">
    <div id="scanner-container" style="display: none;">
        <!-- Scanner container -->
    </div>
    <button id="show-scanner-btn">Show Scanner</button>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Function to handle successful scan
        function onScanSuccess(decodedText, decodedResult) {
            // Perform validation (example: check if the scanned text contains only digits)
            if (/^\d+$/.test(decodedText)) {
                // Send the scanned data to the server to save to the database
                saveToDatabase(decodedText);
            } else {
                alert('Invalid barcode!'); // Show alert for invalid barcode
            }
        }

        // Function to send the scanned data to the server and save to the database
        function saveToDatabase(scannedData) {
            $.ajax({
                url: "{{ route('validasi') }}", // Replace with your Laravel route
                type: 'POST',
                data: {
                    scanned_data: scannedData,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        // Clear the scanner
                        html5QrcodeScanner.clear().then(_ => {
                            console.log('Scanner cleared');
                        }).catch(error => {
                            console.error('Error clearing scanner:', error);
                        });

                        // Update input field with scanned result
                        $('#result').val(scannedData);
                    } else {
                        // Show alert if data couldn't be saved to the database
                        alert('Failed to save data to the database!');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Show alert for any AJAX request error
                    alert('An error occurred while saving data!');
                }
            });
        }

        // Function to handle scan failure
        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
            // You can handle scan failure here, such as displaying an error message
        }

        // Initialize the barcode scanner
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "scanner-container", // Container ID for the scanner
            { fps: 10, qrbox: {width: 250, height: 250} }, // Scanner configuration
            false // Verbose mode
        );

        // Render the scanner
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        // Function to show the scanner when the button is clicked
        $('#show-scanner-btn').click(function() {
            $('#scanner-container').toggle(); // Toggle visibility of the scanner container
        });
    </script>
</body>
</html>
