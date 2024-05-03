@extends('layout.template')

@section('content')
<div class="card card-outline"> 
    <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools">
            <button id="scanAgainBtn" style="display: none;" class="btn btn-primary btn-block">Scan Again</button>
        </div> 
    </div> 
    <div class="card-body d-flex justify-content-center" > 
        <div class="d-block">
            <div class="text-center" >
                <div id="scanner" width="400px" height="400px">
                <!-- Scanner -->
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/action/store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Nama Peminjam</span>
                    </div>
                    <input type="text" class="form-control" name="nama" value="{{auth()->user()->nama}}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Judul Buku</span>
                    </div>
                    <input type="text" class="form-control" id="judul" name="judul" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Penulis</span>
                    </div>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Penerbit</span>
                    </div>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" readonly>
                </div>
                <button class="btn font-weight-bold btn-block mt-3 mb-3" style="height: 50px; background-color: #D9D9D9; font-size: 20px; border-radius:20px">PINJAM</button>
            </form>
        </div>
    </div>
</div>

    <script>
        // Function to send the scanned data to the server
        function onScanSuccess(decodedText, decodedResult) {
            $('#result').val(decodedText); // Update input field with scanned result
    
            // Send the scanned barcode to backend API
            $.ajax({
                url: `/action/validasi/${decodedText}`,
                method: 'GET',
                success: function(response) {
                    html5QrcodeScanner.clear();
                    // Update input field with product information
                    $('#judul').val(response.judul);
                    $('#pengarang').val(response.pengarang);
                    $('#penerbit').val(response.penerbit);

                    // Show the scan again button
                    $('#scanAgainBtn').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Product not found');
                }
            });
        }

        // Initialize the barcode scanner
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "scanner", // Container ID for the scanner
            { fps: 10, qrbox: {width: 150, height: 150} }, // Scanner configuration
            false // Verbose mode
        );
    
        // Render the scanner
        html5QrcodeScanner.render(onScanSuccess);

        $('#scanAgainBtn').click(function() {
            html5QrcodeScanner.render(onScanSuccess);
            // Hide the scan again button
            $('#scanAgainBtn').hide();
        });
    </script>
@endsection