<x-admin-master>
    @section('title', 'Mass Schedules')

    @section('styles')
    <style>

    </style>

    @endsection

    @section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Susunan Lagu</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('mass_schedules.update', $massSchedule->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="entrance_song" class="control-label mb-1">Pembukaan</label>
                            <input id="entrance_song" name="entrance_song" type="text" class="form-control" value="{{$massSchedule->entrance_song}}">
                        </div>
                        <div class="form-group">
                            <label for="alleluia_song" class="control-label mb-1">Aleluya</label>
                            <input id="alleluia_song" name="alleluia_song" type="text" class="form-control" value="{{$massSchedule->alleluia_song}}">

                        </div>
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