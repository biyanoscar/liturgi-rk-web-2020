<x-admin-master>
    @section('title', 'Setting')

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
                    <i class="zmdi zmdi-settings"></i></i>Setting
                </h3>

                <div class="tool-3 table-data__tool">
                    <div class="table-data__tool-left">
                        <h3></h3>
                    </div>

                    <div class="table-data__tool-right">
                        {{-- <a class="btn btn-success" href="{{route('settings.create') }}">Tambah Setting</a> --}}
                    </div>

                </div>


                <div class="tool-3 table-responsive table-data m-b-40">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <td>Settting</td>
                                <td>Value</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <td>{{$setting->name}}</td>
                                <td>{{$setting->value}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('settings.edit', $setting->id) }}">Edit</a>
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
