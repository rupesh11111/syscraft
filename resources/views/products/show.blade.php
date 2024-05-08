<style>
    /* Additional custom styles can be added here */
    .product-img {
        max-height: 200px;
        object-fit: cover;
    }
</style>

<header class="bg-dark text-white py-4">
    <div class="container text-center">
        <h1>My Products</h1>
    </div>
</header>

<div class="container my-4">
    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="product1.jpg" class="card-img-top product-img" alt="Product 1">
                <div class="card-body">
                    <h5 class="card-title">Product 1</h5>
                    <p class="card-text">Description of Product 1</p>
                    <p class="card-text">$19.99</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
                        </div>
                        <input type="number" class="form-control text-center" value="1" min="1"
                            max="10">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
                        </div>
                    </div>
                    <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add
                        to Cart</button>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="product2.jpg" class="card-img-top product-img" alt="Product 2">
                <div class="card-body">
                    <h5 class="card-title">Product 2</h5>
                    <p class="card-text">Description of Product 2</p>
                    <p class="card-text">$29.99</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
                        </div>
                        <input type="number" class="form-control text-center" value="1" min="1"
                            max="10">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
                        </div>
                    </div>
                    <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add
                        to Cart</button>
                </div>
            </div>
        </div>

        <!-- Add more product columns as needed -->
    </div>
</div>

<!-- Modal -->


<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 My Company. All rights reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Quantity Selector
    $(document).ready(function() {
        // Increase quantity
        $(document).on('click', '#plusBtn', function() {
            var $input = $(this).closest('.input-group').find('input');
            var value = parseInt($input.val());
            if (value < 10) {
                value = value + 1;
                $input.val(value);
            }
        });
        // Decrease quantity
        $(document).on('click', '#minusBtn', function() {
            var $input = $(this).closest('.input-group').find('input');
            var value = parseInt($input.val());
            if (value > 1) {
                value = value - 1;
                $input.val(value);
            }
        });
        // Set selected quantity in modal
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var quantity = button.closest('.card-body').find('input').val();
            var modal = $(this);
            modal.find('#selectedQuantity').text(quantity);
        });
    });
</script>
</body>

</html>
