<x-admin-master>
    @section('title', 'Anggota Bertugas')

    @section('styles')
    <style>
        body{
            font-size: 0.8rem;
        }

        .btn {
            font-size: 0.8rem;
        }

        .table-data .table td {
            padding-left: 10px;
        }

        .select2 {
            width:100%!important;
        }


        @media only screen and (min-width: 600px) {
            body{
                font-size: 16px;
            }
            .btn {
                font-size: 1rem;
            }

            .table-data .table td {
                padding-left: 40px;
            }
        }

        @media all and (max-width: 767px) {
            td.col_2{
                display:none;
                width:0;
                height:0;
                opacity:0;
                visibility: collapse
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    @endsection


    @section('content')
    @if(session()->has('msg-success'))
    <div class="alert alert-success">
        {{session('msg-success')}}
    </div>
    @endif

    @if(session()->has('msg-error'))
    <div class="alert alert-danger">
        {{session('msg-error')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{$ministrySchedule->massSchedule->mass_title}}</div>
                <div class="card-body">
                    <form method="post" action="{{route('ministry_schedules.updated_by_choir', $ministrySchedule->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <input type="hidden" id="mass_schedule_id" name="mass_schedule_id" value="{{$ministrySchedule->mass_schedule_id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label for="organist_id" class=" form-control-label">Organis</label>
                            </div>
                            <div class="col-12">
                                <select name="organist_id" id="organist_id" class="select2-single form-control @error('organist_id') is-invalid @enderror">
                                    <option disabled selected value>Please select</option>
                                    @foreach ($organists as $organist)
                                    <option value="{{$organist->id}}"
                                        @if ($organist->id == $ministrySchedule->organist_id)
                                            selected
                                        @endif>
                                        {{$organist->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('organist_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>



                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-save fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Simpan</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            @if($choirMembers->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <strong class="card-title mb-3">Petugas Koor {{$ministrySchedule->massSchedule->mass_title}}</strong>
                </div>
                <div class="card-body">
                    <div class="tool-3 table-responsive table-data m-b-40">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <td>Nama</td>
                                    <td class="col_2">No KK</td>
                                    <td>Tugasin</td>
                                    <td>Liburin</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($choirMembers as $choirMember)
                                <tr>
                                    <td>{{$choirMember->name}} </td>
                                    <td class="col_2">{{$choirMember->no_kk}}</td>
                                    <td>
                                        <form method="post" action="{{route('ministry_schedules.choirMember.attach', $ministrySchedule) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="choir_member" value="{{$choirMember->id}}">
                                            <button type="submit" class="btn btn-primary" @if($ministrySchedule->choirMember->contains($choirMember))
                                                disabled
                                                @endif
                                                >Tugasin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('ministry_schedules.choirMember.detach', $ministrySchedule) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="choir_member" value="{{$choirMember->id}}">
                                            <button type="submit" class="btn btn-danger" @if(!$ministrySchedule->choirMember->contains($choirMember))
                                                disabled
                                                @endif
                                                >Liburin</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    @endsection


    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-single').select2({
                theme: "bootstrap4"
            });
        });
    </script>
    @endsection


</x-admin-master>
