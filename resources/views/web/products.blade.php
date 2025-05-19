<x-layout>
    <div class="container mt-4">

        {{-- Tampilkan judul pencarian jika ada --}}
        @if(request('q'))
            <h5 class="mb-3 mt-5">Hasil pencarian untuk: <strong>{{ request('q') }}</strong></h5>
        @else
            <h3 class="mb-3 mt-5">All Products</h3>
        @endif

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 d-flex flex-column shadow-sm">
                        <img src="{{ asset($product->image_url) }}" 
                             alt="{{ $product->name }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover; object-position: center;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                            <div class="mt-auto">
                                <a href="{{ route('product', $product->slug) }}" class="btn btn-success w-100">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No products available.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
