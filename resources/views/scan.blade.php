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
        <h2>Product Information</h2>
        <p><strong>Name:</strong> <span id="productName"></span></p>
        <p><strong>Description:</strong> <span id="productDescription"></span></p>

    </div>
    <div id="scanner-container"></div>

    <script>
        // Function to handle successful scan
        function onScanSuccess(decodedText, decodedResult) {
            $('#result').val(decodedText); // Update input field with scanned result
    
            // Send the scanned barcode to backend API
            $.ajax({
                url: `/action/validasi/${decodedText}`,
                method: 'GET',
                success: function(response) {
                    // Update input field with product information
                    $('#productName').text(response.name);
                    $('#productDescription').text(response.description);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Product not found');
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
            { fps: 10, qrbox: {width: 500, height: 500} }, // Scanner configuration
            false // Verbose mode
        );
    
        // Render the scanner
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
    
</body>
</html>
