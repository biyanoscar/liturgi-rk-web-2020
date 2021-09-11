<x-admin-master>
    @section('title', 'Organis')

    @section('styles')
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .user-data .tool-3 {
            padding-left: 40px;
            padding-right: 55px;
        }
    </style>

    @endsection

    @section('content')

    @if(session('success-message'))
    <div class="alert alert-success" role="alert">
        {{session('success-message')}}
    </div>
    @endif

    @if(session()->has('error-message'))
    <div class="alert alert-danger">
        {{session('error-message')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <!-- USER DATA-->
            <div class="user-data m-b-30">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-collection-music"></i></i>Organis
                </h3>

                <div class="tool-3 table-data__tool">
                    <div class="table-data__tool-left">
                        <h3></h3>
                    </div>

                    <div class="table-data__tool-right">
                        <a class="btn btn-success" href="{{route('organists.create') }}">Tambah Organis</a>
                    </div>

                </div>


                <div class="tool-3 table-responsive table-data m-b-40">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>No KK</td>
                                <td>Action</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organists as $organist)
                            <tr>
                                <td>{{$organist->name}}</td>
                                <td>{{$organist->no_kk}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('organists.edit', $organist->id) }}">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('organists.destroy', $organist->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

            </div>
            <!-- END USER DATA-->
        </div>

    </div>
    @endsection

    @section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "scrollX": false,
                "order": [
                    [0, "asc"]
                ],

            });
        });
    </script>
    @endsection


</x-admin-master>
