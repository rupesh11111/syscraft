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

            let columns = [];

            $('.list-group-item').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: $(this).data('link'),
                    success: function(response) {
                        $('.append').html(response.data)
                        columns = mapColummns($("#ajaxDataTable").data("columns"));
                        mainDataTable();
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            })

            function mainDataTable() {
                const tableObj = $("#ajaxDataTable").DataTable({
                    processing: false,
                    serverSide: true,
                    searching: true,
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
                    columns: columns,

                });
            }
        });
    </script>
@endpush
