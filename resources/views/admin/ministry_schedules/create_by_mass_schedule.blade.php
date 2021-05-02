<x-admin-master>
    @section('title', 'Jadwal Petugas')

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
                <div class="card-header">{{$schedule->mass_title}}</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Tambah Jadwal Petugas</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('ministry_schedules.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="hidden" id="mass_schedule_id" name="mass_schedule_id" value="{{$schedule->id}}">
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label for="choir_id" class=" form-control-label">Paduan Suara</label>
                            </div>
                            <div class="col-12">
                                <select name="choir_id" id="choir_id" class="form-control @error('choir_id') is-invalid @enderror">
                                    @foreach ($choirs as $choir)
                                    <option value="{{$choir->id}}">{{$choir->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('choir_id')
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
