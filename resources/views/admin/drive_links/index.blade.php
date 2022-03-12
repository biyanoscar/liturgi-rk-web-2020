<x-admin-master>
    @section('title', 'Drive Links')

    @section('styles')
        <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <style>
            .user-data .tool-3 {
                padding-left: 40px;
                padding-right: 55px;
            }

        </style>
    @endsection

    @section('alert')
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <!-- USER DATA-->
                <div class="user-data m-b-30">
                    <h3 class="title-3 m-b-30">
                        <i class="fa fa-link"></i></i>Drive Links
                    </h3>

                    <div class="tool-3 table-data__tool">
                        <div class="table-data__tool-left">
                            <h3></h3>
                        </div>

                        <div class="table-data__tool-right">
                            <a class="btn btn-success" href="{{ route('drive-links.create') }}">Tambah Link</a>
                        </div>
                    </div>

                    <div class="tool-3 table-responsive table-data m-b-40">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <td>Link</td>
                                    <td>Id</td>
                                    <td>No Urut</td>
                                    <td>Active</td>
                                    <td>Action</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $link)
                                    <tr>
                                        <td>{{ $link->name }}</td>
                                        <td>{{ $link->link_id }}</td>
                                        <td>{{ $link->order_num }}</td>
                                        <td>
                                            @if ($link->active == 1)
                                                &#10004;
                                            @else
                                                &#10006;
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ route('drive-links.edit', $link->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{route('drive-links.destroy', $link->id) }}">
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
                        [2, "asc"]
                    ],

                });
            });
        </script>
    @endsection


</x-admin-master>
