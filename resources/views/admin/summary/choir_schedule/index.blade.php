<x-admin-master>
    @section('title', 'Jadwal Paduan Suara')

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
            <h3 class="title-5 m-b-35">Jadwal Paduan Suara</h3>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            
                            <th>misa</th>
                            <th>waktu</th>
                            <th>paduan suara</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($massSchedules as $schedule)
                            <tr class="tr-shadow">
                                <td>{{$schedule->mass_title}}</td>
                                <td>
                                    <span class="block-email">{{$schedule->getScheduleTimeFormatted('dddd, D MMM Y HH:mm')}}</span>
                                </td>
                                <td><b>{{$schedule->choir_name}}</b></td>
                                <td></td>
                            </tr>

                            @if($schedule->choir_members)
                                @foreach($schedule->choir_members  as $member)
                                <tr>
                                    <td></td>
                                    <td>{{$member->name}}</td>
                                    <td>{{$member->no_kk}}</td>
                                    <td>{{($member->pivot->updated_at) ? $member->pivot->updated_at->diffForHumans() : ''}}</td>
                                </tr>
                                @endforeach
                            @endif

                            <tr class="spacer"></tr>
                            
                        @endforeach
                    </tbody>
                </table>
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
