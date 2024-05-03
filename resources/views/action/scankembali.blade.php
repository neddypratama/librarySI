@extends('layout.template')

@section('content')
<div class="card card-outline"> 
    <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3>  
    </div> 
    <div class="card-body d-flex justify-content-center" > 
        <div class="d-block">
            <div class="text-center" >
                <div id="scanner" width="400px" height="400px">
                <!-- Scanner -->
            </div>
        </div>
        <div class="card-body">
            {{-- <form method="POST" action="{{ url('/action/kembali/'.$transaksi->transaksi_id) }}" > --}}
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Nama Peminjam</span>
                    </div>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $transaksi->user->nama) }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Judul Buku</span>
                    </div>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $transaksi->buku->judul) }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Penulis</span>
                    </div>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang', $transaksi->buku->pengarang) }}" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text" style="width: 135px">
                        <span>Penerbit</span>
                    </div>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit', $transaksi->buku->penerbit) }}" readonly>
                </div>
                {{-- <button class="btn font-weight-bold btn-block mt-3 mb-3" style="height: 50px; background-color: #D9D9D9; font-size: 20px; border-radius:20px">PINJAM</button>
            </form> --}}
        </div>
    </div>
</div>

    <script>
        var transaksiId = "{{ $transaksi->transaksi_id }}";
        // Function to send the scanned data to the server
        function onScanSuccess(decodedText, decodedResult) {

            $('#result').val(decodedText); // Update input field with scanned result
    
            // Send the scanned barcode to backend API
            $.ajax({
                url: `/action/kembali/${transaksiId}/${decodedText}`,
                method: 'GET',
                success: function(response) {
                    // Redirect to the specified URL after successful request
                    window.location.href = `/action/kembali/${transaksiId}/${decodedText}`;
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Buku tidak tersedia');
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
        html5QrcodeScanner.render(onScanSuccess);;
    </script>
@endsection