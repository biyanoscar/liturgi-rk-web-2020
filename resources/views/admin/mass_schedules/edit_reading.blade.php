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
                        <h3 class="text-center title-2 mb-3">Input Bacaan</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('mass_schedules.update', $massSchedule->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="schedule_time" class="control-label mb-1">Jadwal</label>
                            <input id="schedule_time" name="schedule_time" type="text" class="form-control" value="{{$massSchedule->schedule_time}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="mass_title" class="control-label mb-1">Judul</label>
                            <input id="mass_title" name="mass_title" type="text" class="form-control" value="{{$massSchedule->mass_title}}">
                        </div>
                        <div class="form-group">
                            <label for="holy_day_of_obligation" class="control-label mb-1">Nama HR / Pesta/ Peringatan</label>
                            <input id="holy_day_of_obligation" name="holy_day_of_obligation" type="text" class="form-control" value="{{$massSchedule->holy_day_of_obligation}}">
                        </div>
                        <div class="form-group form-check-inline form-check">
                            <label for="check_gloria" class="form-check-label ">
                                <input type="checkbox" id="check_gloria" name="check_gloria" class="form-check-input" <?php if ($massSchedule->show_gloria == 1) echo 'checked' ?>>Tampilkan Kemuliaan
                            </label>
                        </div>


                        <div class="form-group">
                            <label for="first_reading" class="control-label mb-1">Bacaan 1</label>
                            <input id="first_reading" name="first_reading" type="text" class="form-control" value="{{$massSchedule->first_reading}}">
                        </div>
                        <div class="form-group">
                            <label for="psalm_song" class="control-label mb-1">Mazmur</label>
                            <input id="psalm_song" name="psalm_song" type="text" class="form-control" value="{{$massSchedule->psalm_song}}">
                        </div>
                        @if ($massSchedule->is_daily_mass == 0)
                        <div class="form-group">
                            <label for="second_reading" class="control-label mb-1">Bacaan 2</label>
                            <input id="second_reading" name="second_reading" type="text" class="form-control" value="{{$massSchedule->second_reading}}">
                        </div>

                        <div class="form-group">
                            <label for="alleluia_song" class="control-label mb-1">Aleluya</label>
                            <input id="alleluia_song" name="alleluia_song" type="text" class="form-control" value="{{$massSchedule->alleluia_song}}">
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="gospel_reading" class="control-label mb-1">Injil</label>
                            <input id="gospel_reading" name="gospel_reading" type="text" class="form-control" value="{{$massSchedule->gospel_reading}}">
                        </div>

                        @if ($massSchedule->is_daily_mass == 0)
                        <div class="form-group">
                            <label for="prayer_of_the_faithful" class="control-label mb-1">Doa Umat</label>
                            <input id="prayer_of_the_faithful" name="prayer_of_the_faithful" type="text" class="form-control" value="{{$massSchedule->prayer_of_the_faithful}}">
                        </div>
                        @endif

                        @if ($massSchedule->has_additional_reading == 1)
                            <div class="form-group">
                                <label for="reading_01" class="control-label mb-1">Bacaan Tambahan 1</label>
                                <input type="text" id="reading_01_notes" name="reading_01_notes" placeholder="Enter label bacaan 1" class="form-control" value="{{$massSchedule->reading_01_notes}}">
                                <input id="reading_01" name="reading_01" type="text" class="form-control" value="{{$massSchedule->reading_01}}">
                            </div>

                            <div class="form-group">
                                <label for="reading_02" class="control-label mb-1">Bacaan Tambahan 2</label>
                                <input type="text" id="reading_02_notes" name="reading_02_notes" placeholder="Enter label bacaan 2" class="form-control" value="{{$massSchedule->reading_02_notes}}">
                                <input id="reading_02" name="reading_02" type="text" class="form-control" value="{{$massSchedule->reading_02}}">
                            </div>

                            <div class="form-group">
                                <label for="reading_03" class="control-label mb-1">Bacaan Tambahan 3</label>
                                <input type="text" id="reading_03_notes" name="reading_03_notes" placeholder="Enter label bacaan 3" class="form-control" value="{{$massSchedule->reading_03_notes}}">
                                <input id="reading_03" name="reading_03" type="text" class="form-control" value="{{$massSchedule->reading_03}}">
                            </div>

                            <div class="form-group">
                                <label for="reading_04" class="control-label mb-1">Bacaan Tambahan 4</label>
                                <input type="text" id="reading_04_notes" name="reading_04_notes" placeholder="Enter label bacaan 4" class="form-control" value="{{$massSchedule->reading_04_notes}}">
                                <input id="reading_04" name="reading_04" type="text" class="form-control" value="{{$massSchedule->reading_04}}">
                            </div>

                            <div class="form-group">
                                <label for="reading_05" class="control-label mb-1">Bacaan Tambahan 5</label>
                                <input type="text" id="reading_05_notes" name="reading_05_notes" placeholder="Enter label bacaan 5" class="form-control" value="{{$massSchedule->reading_05_notes}}">
                                <input id="reading_05" name="reading_05" type="text" class="form-control" value="{{$massSchedule->reading_05}}">
                            </div>
                        @endif


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