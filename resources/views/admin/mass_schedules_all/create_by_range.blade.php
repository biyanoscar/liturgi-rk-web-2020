<x-admin-master>
    @section('title', 'Jadwal Misa')


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
                <!-- <div class="card-header">Tambah range tanggal</div> -->
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Tambah range tanggal</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('mass_schedules_all.store_by_date_range')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="start_date" class="control-label mb-1">Tanggal Awal</label>
                            <input id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" />
                            @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="end_date" class="control-label mb-1">Tanggal Akhir</label>
                            <input id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" />
                            @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mass_type" class=" form-control-label">Tipe Misa</label>

                            <select name="mass_type" id="mass_type" class="form-control">
                                <option value="daily">Harian</option>
                                <option value="sunday" selected>Hari Minggu</option>
                                <option value="all">All</option>
                            </select>
                        </div>




                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-save fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Tambah</span>
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