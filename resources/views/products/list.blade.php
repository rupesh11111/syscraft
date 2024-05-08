<header class="bg-dark text-white py-4">
    <div class="container text-center">
        <h1>Products</h1>
    </div>
</header>

<div class="container my-4">
    <div class="row">
        <!-- Product 1 -->
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body ">
                        <a href="#">
                            <img src="{{ $product->image }}" data-id="{{ $product->id }}"
                                class="product card-img-top product-img" alt="Product 1">
                        </a>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                    </div>
                    <a href="#" data-link="{{ route('addToCart') }}" data-id={{ $product->id }}
                        class="btn btn-primary add-to-cart">Add to Cart</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('style')
    <style>
        .product-img {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@push('script')
    <script>
        $('.product').on('click', function(e) {
            console.log($(this).data('id'));
        })

        $('.add-to-cart').on('click', function(e) {
            let id = $(this).data('id')
            $.ajax({
                type: "POST",
                url: $(this).data('link'),
                data: {
                    'product_id': id
                },
                success: function(response) {
                    toastr.success(response.message);
                    $('#cartCount').html(`Cart (${response.data.cart_count})`)
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });

        })
    </script>
@endpush
