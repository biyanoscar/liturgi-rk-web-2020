<x-admin-master>
    @section('title', 'Jadwal Misa')

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

        @if(session()->has('schedule-deleted'))
            <div class="alert alert-danger">
                {{session('schedule-deleted')}}
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
                    <i class="zmdi zmdi-calendar-alt"></i></i>Jadwal Misa
                </h3>

                <div class="tool-3 table-data__tool">
                    <div class="table-data__tool-left">
                        <form action="">
                            <div class="rs-select2--light">
                                <label for="start_date" class="control-label">Tanggal Awal</label>
                                <input id="start_date" name="start_date" value="{{ request()->get('start_date') }}" />
                            </div>
                            <div class="rs-select2--light">
                                <label for="end_date" class="control-label">Tanggal Akhir</label>
                                <input id="end_date" name="end_date" value="{{ request()->get('end_date') }}" />
                            </div>
                            <button class="btn btn-warning" type="submit">Filter</button>
                        </form>
                    </div>

                    <div class="table-data__tool-right">
                        <a class="btn btn-success" href="{{route('mass_schedules_all.create') }}">Tambah Jadwal</a>
                        <a class="btn btn-primary" href="{{route('mass_schedules_all.create_by_date_range') }}" role="button">Tambah by Range</a>
                    </div>

                </div>


                <div class="tool-3 table-responsive table-data m-b-40">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td>Misa</td>
                                <td>Waktu</td>
                                <td>Padus</td>
                                <td>Action</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($massSchedules as $schedule)
                            <tr>
                                <td>{{ $schedule->schedule_time }}</td>
                                <td>{{ Str::limit($schedule->mass_title, 20) }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->schedule_time)->isoFormat('DD MMM Y HH:mm') }}</td>
                                <td>{{ ($schedule->ministrySchedule) ? $schedule->ministrySchedule->choir->name : '' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('mass_schedules_all.edit', $schedule->id) }}">Edit</a>
                                    <a class="btn btn-info" href="{{route('mass_schedules.edit_song', $schedule->id) }}">Isi lagu</a>
                                    <a class="btn btn-secondary" href="{{route('ministry_schedules.fill_by_mass_schedule', $schedule->id) }}">Petugas</a>

                                </td>
                                <td>
                                    <form method="POST" action="{{route('mass_schedules_all.destroy', $schedule->id) }}">
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "scrollX": false,
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }]
            });
        });
    </script>

    <script>
        $('#start_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });

        $('#end_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
    @endsection


</x-admin-master>
