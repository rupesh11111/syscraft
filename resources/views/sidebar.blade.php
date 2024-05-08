<!-- Sidebar -->
<div class="col-md-3">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            Sidebar
        </div>
        <div class="card-body">
            <!-- Sidebar Content -->
            <ul class="list-group">
                <li class="list-group-item" data-link="customers"><a href="#">Customers</a></li>
                <li class="list-group-item" data-link="vendors"><a href="#">Venders</a></li>
                <li class="list-group-item" data-link="products"><a href="#">Products</a></li>
                <li class="list-group-item" data-link="orders"><a href="#">Orders</a></li>
                <li class="list-group-item" data-link="transactions"><a href="#">Transactions</a></li>
            </ul>
        </div>
    </div>
</div>

@push('style')
<style>
    a {
        text-decoration: none;
    }
</style>
@endpush
