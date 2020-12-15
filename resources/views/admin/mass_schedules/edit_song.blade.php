<x-admin-master>
    @section('title', 'Jadwal Misa')

    @section('styles')
    <style>

    </style>

    @endsection

    @section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">{{($massSchedule->holy_day_of_obligation)?$massSchedule->holy_day_of_obligation:$massSchedule->mass_title}}</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Isi Susunan Lagu</h3>
                        <p>Isi dengan nomor PS dan judul lagu<br>
                            Contoh: 'PS 443 : O Datanglah Imanuel'

                        </p>
                    </div>
                    <hr>
                    <form method="post" action="{{route('mass_schedules.update_song', $massSchedule->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="schedule_time" class="control-label mb-1">Jadwal</label>
                            <input id="schedule_time" name="schedule_time" type="text" class="form-control" value="{{$massSchedule->schedule_time}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="entrance_song" class="control-label mb-1">Pembukaan</label>
                            <input id="entrance_song" name="entrance_song" type="text" class="form-control" value="{{$massSchedule->entrance_song}}">
                        </div>
                        <div class="form-group">
                            <label for="gloria_song" class="control-label mb-1">Kemuliaan</label>
                            <input id="gloria_song" name="gloria_song" type="text" class="form-control" value="{{$massSchedule->gloria_song}}">
                        </div>
                        <div class="form-group">
                            <label for="alleluia_song" class="control-label mb-1">Aleluya</label>
                            <input id="alleluia_song" name="alleluia_song" type="text" class="form-control" value="{{$massSchedule->alleluia_song}}">
                        </div>

                        @if ($massSchedule->is_daily_mass == 0)
                        <div class="form-group">
                            <label for="offertory_song" class="control-label mb-1">Persembahan</label>
                            <input id="offertory_song" name="offertory_song" type="text" class="form-control" value="{{$massSchedule->offertory_song}}">
                        </div>

                        <div class="form-group">
                            <label for="sanctus_song" class="control-label mb-1">Kudus</label>
                            <input id="sanctus_song" name="sanctus_song" type="text" class="form-control" value="{{$massSchedule->sanctus_song}}">
                        </div>

                        <div class="form-group">
                            <label for="communion_song" class="control-label mb-1">Komuni</label>
                            <input id="communion_song" name="communion_song" type="text" class="form-control" value="{{$massSchedule->communion_song}}">
                        </div>

                        <div class="form-group">
                            <label for="song_of_praise" class="control-label mb-1">Komuni 2</label>
                            <input id="song_of_praise" name="song_of_praise" type="text" class="form-control" value="{{$massSchedule->song_of_praise}}">
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="recessional_song" class="control-label mb-1">Penutup</label>
                            <input id="recessional_song" name="recessional_song" type="text" class="form-control" value="{{$massSchedule->recessional_song}}">
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
    @endsection


</x-admin-master>