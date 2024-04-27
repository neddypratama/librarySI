<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <!-- Include necessary libraries -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div>
        <label for="result">Scanned Result:</label>
        <input type="text" id="result" name="result" readonly>
    </div>
    <div id="scanner-container"></div>
    
    <script>
        // Function to handle successful scan
        function onScanSuccess(decodedText, decodedResult) {
            // Perform validation (example: check if the scanned text contains only digits)
            let id = decodedText;                
            // Send the scanned data to the server
            saveToDatabase(id);
        }
    
        // Function to send the scanned data to the server
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
                        $('#result').val(scannedData); // Update input field with scanned result
                        html5QrcodeScanner.clear();
                        alert('Data saved successfully!');
                    } else {
                        alert('Failed to save data!');

                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
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
            { fps: 10, qrbox: {width: 400, height: 400} }, // Scanner configuration
            false // Verbose mode
        );
    
        // Render the scanner
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
    
    </script>
</body>
</html>
