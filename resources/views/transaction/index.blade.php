<x-app-layout>

    @include('home.css')

    @include("home.header")
    @include('home.slider')

        <div class="container my-4">
            <div class="row">
                <!-- Left Column: Order Summary -->
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Barang yang dibeli</h5>
                            <div class="d-flex align-items-start mb-3">
                                <img src="https://via.placeholder.com/150" alt="Product Image" class="img-thumbnail mr-3" style="width: 100px;">
                                <div>
                                    <p class="mb-0 font-weight-bold">{{ $product->name }}</p>
                                    <p class="mb-0 text-muted">Rp {{ number_format($product->price, 0, '', '.') }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-link">Tulis Catatan</button>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm">-</button>
                                    <span class="mx-2">1</span>
                                    <button class="btn btn-outline-secondary btn-sm">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Belanja</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Harga (1 Barang)</span>
                                    <span>Rp49.000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Biaya Layanan</span>
                                    <span>Rp1.000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Biaya Jasa Aplikasi</span>
                                    <span>Rp-</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between font-weight-bold">
                                    <span>Total Tagihan</span>
                                    <span>Rp50.000</span>
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-block mt-3" disabled>Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("home.footer")

</x-app-layout>

