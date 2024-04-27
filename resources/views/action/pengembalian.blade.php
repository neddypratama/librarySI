@extends('layout.template')

@section('content')
    <div class="card">
      <div class="card-body d-flex justify-content-center" >
        <div class="d-block">
            <div class="pt-1 px-4 text-center" >
                <div id="scanner" width="400px" height="400px">
                    <!-- Scanner -->
                </div>
            </div>
            <div class="card-body mt-3">
                <form action="../../index3.html" method="post">
                    <label for="result">Scanned Result:</label>
                    <input type="text" id="result" name="result" readonly>
                    <div class="input-group mb-3">
                        <div class="input-group-text" style="width: 135px">
                            <span>Nama Pengembali</span>
                        </div>
                        <input type="text" class="form-control" value="" name="" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text" style="width: 135px">
                            <span>Judul Buku</span>
                        </div>
                        <input type="text" class="form-control" value="" name="" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text" style="width: 135px">
                            <span>Penulis</span>
                        </div>
                        <input type="text" class="form-control" value="" name="" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text" style="width: 135px">
                            <span>Penerbit</span>
                        </div>
                        <input type="text" class="form-control" value="" name="" readonly>
                    </div>
                    <button class="btn font-weight-bold btn-block mt-3 mb-3" style="height: 50px; background-color: #D9D9D9; font-size: 20px; border-radius:20px">PINJAM</button>
                </form>
            </div>
        </div>
      </div>
    </div>

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
            "scanner", // Container ID for the scanner
            { fps: 10, qrbox: {width: 150, height: 150} }, // Scanner configuration
            false // Verbose mode
        );
    
        // Render the scanner
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection