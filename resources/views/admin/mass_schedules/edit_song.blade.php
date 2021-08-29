<x-admin-master>
    @section('title', 'Jadwal Misa')

    @section('styles')
    <style>

    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">


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
                            <input id="entrance_song" name="entrance_song" type="hidden" class="form-control" value="{{$massSchedule->entrance_song}}">

                            <select name="entrance_song_id" id="entrance_song_id" onchange="setSongText(this, 'entrance_song')" class="select2-single form-control @error('entrance_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->entrance_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                        @if ($massSchedule->is_daily_mass == 0)
                        <div class="form-group">
                            <label for="kyrie_song" class="control-label mb-1">Tuhan Kasihanilah Kami</label>
                            <input id="kyrie_song" name="kyrie_song" type="hidden" class="form-control" value="{{$massSchedule->kyrie_song}}">

                            <select name="kyrie_song_id" id="kyrie_song_id" onchange="setSongText(this, 'kyrie_song')" class="select2-single form-control @error('kyrie_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->kyrie_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gloria_song" class="control-label mb-1">Kemuliaan</label>
                            <input id="gloria_song" name="gloria_song" type="hidden" class="form-control" value="{{$massSchedule->gloria_song}}">

                            <select name="gloria_song_id" id="gloria_song_id" onchange="setSongText(this, 'gloria_song')" class="select2-single form-control @error('gloria_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->gloria_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="alleluia_song" class="control-label mb-1">Aleluya</label>
                            <input id="alleluia_song" name="alleluia_song" type="text" class="form-control" value="{{$massSchedule->alleluia_song}}">
                        </div>

                        @if ($massSchedule->is_daily_mass == 0)
                        <div class="form-group">
                            <label for="offertory_song" class="control-label mb-1">Persembahan</label>
                            <input id="offertory_song" name="offertory_song" type="hidden" class="form-control" value="{{$massSchedule->offertory_song}}">

                            <select name="offertory_song_id" id="offertory_song_id" onchange="setSongText(this, 'offertory_song')" class="select2-single form-control @error('offertory_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->offertory_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sanctus_song" class="control-label mb-1">Kudus</label>
                            <input id="sanctus_song" name="sanctus_song" type="hidden" class="form-control" value="{{$massSchedule->sanctus_song}}">

                            <select name="sanctus_song_id" id="sanctus_song_id" onchange="setSongText(this, 'sanctus_song')" class="select2-single form-control @error('sanctus_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->sanctus_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lords_prayer_song" class="control-label mb-1">Bapa Kami</label>
                            <input id="lords_prayer_song" name="lords_prayer_song" type="text" class="form-control" value="{{$massSchedule->lords_prayer_song}}">
                        </div>

                        <div class="form-group">
                            <label for="agnus_dei_song" class="control-label mb-1">Anak Domba Allah</label>
                            <input id="agnus_dei_song" name="agnus_dei_song" type="hidden" class="form-control" value="{{$massSchedule->agnus_dei_song}}">

                            <select name="agnus_dei_song_id" id="agnus_dei_song_id" onchange="setSongText(this, 'agnus_dei_song')" class="select2-single form-control @error('agnus_dei_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->agnus_dei_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="communion_song" class="control-label mb-1">Komuni</label>
                            <input id="communion_song" name="communion_song" type="hidden" class="form-control" value="{{$massSchedule->communion_song}}">

                            <select name="communion_song_id" id="communion_song_id" onchange="setSongText(this, 'communion_song')" class="select2-single form-control @error('communion_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->communion_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="song_of_praise" class="control-label mb-1">Madah Syukur</label>
                            <input id="song_of_praise" name="song_of_praise" type="hidden" class="form-control" value="{{$massSchedule->song_of_praise}}">

                            <select name="song_of_praise_id" id="song_of_praise_id" onchange="setSongText(this, 'song_of_praise')" class="select2-single form-control @error('song_of_praise_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->song_of_praise_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="recessional_song" class="control-label mb-1">Penutup</label>
                            <input id="recessional_song" name="recessional_song" type="hidden" class="form-control" value="{{$massSchedule->recessional_song}}">

                            <select name="recessional_song_id" id="recessional_song_id" onchange="setSongText(this, 'recessional_song')" class="select2-single form-control @error('recessional_song_id') is-invalid @enderror">
                                <option disabled selected value>Please select</option>
                                @foreach ($songs as $key => $song)
                                    <option value="{{ $key }}"
                                        @if ($key == $massSchedule->recessional_song_id)
                                            selected
                                        @endif>
                                        {{ $song }}
                                    </option>
                                @endforeach
                            </select>
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

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-single').select2({
                theme: "bootstrap4"
            });
        });

        function setSongText(sel, inputId) {
            comboText = sel.options[sel.selectedIndex].text;
            document.getElementById(inputId).value = comboText;
        }
    </script>
    @endsection


</x-admin-master>