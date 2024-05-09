@extends('layout')
@section('content')
    <header class="bg-dark text-white py-4 order">
        <div class="container text-center">
            <h1>Shopping Cart</h1>
        </div>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr class="cartItem">
                                <td>{{ $cartItem->product->name }}</td>
                                <td>${{ $cartItem->product->price }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>${{ intval($cartItem->quantity) * floatval($cartItem->product->price) }}</td>
                                <td>
                                    <button class="btn btn-danger removeItem"
                                        data-link="{{ route('cart.destroy', ['id' => $cartItem->id]) }}">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="text-right">
                    <h4 id="total">Total: ${{ $total }}</h4>
                    <div id="checkout-buttons">
                    <button id="checkout" class="btn btn-primary">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<div>
</div>

{{-- @include('modal',['html' => $html ?? '']) --}}

@push('script')
    <script>
        $(document).ready(function() {

            $('#checkout').on('click', function() {
                // $('#modal').modal('show');
                $('#checkout-buttons').html("<button id='pay-now' class='btn btn-primary'>Pay Now</button>"
                + "<button id='cod' data-link='orders/{!! $cart->id !!}' class='btn btn-primary'>Cash On Deilvery</button>")
            })

            $('body').on('click','#cod', function () {
                $.ajax({
                    type: "POST",
                    url: $(this).data('link'),
                    success: function(response) {
                        if(response.status) {
                            $('#content').html(response.data.html);
                            setTimeout(() => {
                                window.location.href = "/";
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });                
            })

            $('.removeItem').on('click', function() {
                let id = $(this).data('id')
                let thisValue = $(this)
                $.ajax({
                    type: "DELETE",
                    url: $(this).data('link'),
                    success: function(response) {
                        thisValue.closest('.cartItem').remove();
                        $('#total').html(`Total: $${response?.data?.total ?? 0}`)
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            })
        })
    </script>
@endpush
