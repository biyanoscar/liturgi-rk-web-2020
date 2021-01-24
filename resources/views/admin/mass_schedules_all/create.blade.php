<x-admin-master>
    @section('title', 'Jadwal Misa')

    @section('styles')
    <style>

    </style>

    @endsection

    @section('content')
    @if ($errors->any())
    <?php //print_r($errors) 
    ?>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Input Jadwal baru</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('mass_schedules_all.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="schedule_time" class="control-label mb-1">Jadwal</label>
                            <!-- <input id="schedule_time" name="schedule_time" type="text" class="form-control" value=""> -->
                            <input id="schedule_time" name="schedule_time" class="form-control @error('schedule_time') is-invalid @enderror" />
                            @error('schedule_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mass_title" class="control-label mb-1">Judul</label>
                            <input id="mass_title" name="mass_title" type="text" class="form-control @error('mass_title') is-invalid @enderror" value="">
                            @error('mass_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="holy_day_of_obligation" class="control-label mb-1">Nama HR / Pesta/ Peringatan</label>
                            <input id="holy_day_of_obligation" name="holy_day_of_obligation" type="text" class="form-control" value="">
                        </div>

                        <div class="form-group form-check-inline form-check">
                            <label for="check_is_daily_mass" class="form-check-label ">
                                <input type="checkbox" id="check_is_daily_mass" name="check_is_daily_mass" class="form-check-input" checked>Misa Harian
                            </label>
                        </div>

                        <div class="form-group form-check-inline form-check">
                            <label for="check_gloria" class="form-check-label ">
                                <input type="checkbox" id="check_gloria" name="check_gloria" class="form-check-input" checked>Tampilkan Kemuliaan
                            </label>
                        </div>


                        <div class="form-group">
                            <label for="first_reading" class="control-label mb-1">Bacaan 1</label>
                            <input id="first_reading" name="first_reading" type="text" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="psalm_song" class="control-label mb-1">Mazmur</label>
                            <input id="psalm_song" name="psalm_song" type="text" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="second_reading" class="control-label mb-1">Bacaan 2</label>
                            <input id="second_reading" name="second_reading" type="text" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="alleluia_song" class="control-label mb-1">Aleluya</label>
                            <input id="alleluia_song" name="alleluia_song" type="text" class="form-control" value="">
                        </div>


                        <div class="form-group">
                            <label for="gospel_reading" class="control-label mb-1">Injil</label>
                            <input id="gospel_reading" name="gospel_reading" type="text" class="form-control" value="">
                        </div>


                        <div class="form-group">
                            <label for="prayer_of_the_faithful" class="control-label mb-1">Doa Umat</label>
                            <input id="prayer_of_the_faithful" name="prayer_of_the_faithful" type="text" class="form-control" value="">
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#schedule_time').datetimepicker({
            footer: true,
            modal: true,
            format: 'yyyy-mm-dd HH:MM'
        });
    </script>
    @endsection


</x-admin-master>