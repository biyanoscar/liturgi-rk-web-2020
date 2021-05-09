<x-admin-master>
    @section('title', 'Jadwal Misa')

    @section('styles')
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .user-data .tool-3 {
            padding-left: 40px;
            padding-right: 55px;
        }

        body{
            font-size: 0.8rem;
        }

        .table-data .table td {
            padding-left: 10px;
        }

        @media only screen and (min-width: 600px) {
            body{
                font-size: 16px;
            }

            .table-data .table td {
                padding-left: 40px;
            }
        }
    </style>

    @endsection

    @section('content')

    @if(session('schedule-updated-message'))
    <div class="alert alert-success" role="alert">
        {{session('schedule-updated-message')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <!-- USER DATA-->
            <div class="user-data m-b-30">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-calendar-alt"></i></i>Misa Harian
                </h3>

                <div class="tool-3 table-data__tool">
                    <div class="table-data__tool-left">

                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pilih Hari
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('mass_schedules.index' )}}">All</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 0 )}}">Senin</a>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 1 )}}">Selasa</a>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 2 )}}">Rabu</a>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 3 )}}">Kamis</a>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 4 )}}">Jumat</a>
                                <a class="dropdown-item" href="{{route('mass_schedules.day', 5 )}}">Sabtu</a>


                            </div>
                        </div>
                        <div class="rs-select2--dark">
                            <span class="badge badge-primary">{{$dayName}}</span>
                        </div>

                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('mass_schedules.sunday_masses')}}" class="btn btn-success">Misa Hari Minggu</a>
                    </div>

                </div>


                <div class="tool-3 table-responsive table-data m-b-40">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td>Misa</td>
                                <td>Waktu</td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($massSchedules as $schedule)
                            <tr>
                                <td>{{$schedule->schedule_time}}</td>
                                <td>{{$schedule->mass_title}}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->schedule_time)->isoFormat('DD MMM Y HH:mm') }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('mass_schedules.edit_song', $schedule->id) }}">Isi lagu</a>
                                    @if(auth()->user()->userHasRole('Liturgi'))
                                    <a class="btn btn-info" href="{{route('mass_schedules.edit_reading', $schedule->id) }}">Isi Bacaan</a>
                                    @endif
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
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }]
            });
        });
    </script>
    @endsection


</x-admin-master>
