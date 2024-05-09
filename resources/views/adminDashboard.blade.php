@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('sidebar')
            <div class="col-md-9 append"></div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.list-group-item').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: $(this).data('link'),
                    success: function(response) {
                        $('.append').html(response.data)
                        mainDataTable();
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            })

            function mainDataTable() {
                const tableObj = $("#ajaxDataTable").DataTable({
                    processing: false,
                    serverSide: true,
                    cache: true,
                    ajax: {
                        url: $("#ajaxDataTable").data("url"),
                        beforeSend: function() {
                            // loaderShow();
                        },
                        complete: function() {
                            // loaderHide();
                        },
                    },
                    searchDelay: 350,
                    columns: $("#ajaxDataTable").data("columns"),
                });
            }
        });
    </script>
@endpush
