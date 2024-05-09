<div class="card border-success">
    <div class="card-body">
        {{-- <h1 class="display-4">{{$heading}}</h1>
        <p class="lead">{{$subHeading}}</p> --}}
    </div>
</div>
<table id="ajaxDataTable" data-columns="{{$columns ?? []}}" data-url="{{$url ?? 'customers'}}?data=1" class="table table-bordered">
    <thead>
        <tr>
            @foreach($tableHeadings as $tableHeading)
            <th>{{$tableHeading}}</th>
            @endforeach
        </tr>
    </thead>
</table>