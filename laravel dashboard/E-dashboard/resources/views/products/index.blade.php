@extends('layouts.layout');
@section('title', 'all products');
@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">


@endsection
@section('color-page', 'primary')
@section('content')
@include('includes.message')

    <table id="example1" class="table table-bordered table-striped">
        <thead>

            <tr>
                <th>Id</th>
                <th>Name-en</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Product-code</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $products as $index => $product)
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name_en }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product-> price }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->status == 1 ? 'Active' : 'Not Active' }}</td>


                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning rounded"> edit
                    </a>
                    <form action="{{route('products.destroy', $product->id)}}"
                         method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="image" id="" value="{{$product->image}}">
                        <button class="btn btn-outline-danger rounded">Delete</button>
                    </form>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"> no products</td>
                </tr>
            @endforelse



    </table>
    </div>
    <!-- /.card-body -->
    </div>
@endsection
@section('js')
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

</script>
@endsection