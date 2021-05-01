<x-admin-master>
    @section('title', 'Anggota Paduan Suara')

    @section('styles')
    <style>

    </style>

    @endsection

    @section('content')
    @if ($errors->any())
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
                        <h3 class="text-center title-2 mb-3">Input Paduan Suara</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('choir_members.update', $choirMember->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <input type="hidden" id="choir_id" name="choir_id" value="{{$choirMember->choir_id}}">
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Nama</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$choirMember->name}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_kk" class="control-label mb-1">No KK</label>
                            <input id="no_kk" name="no_kk" type="text" class="form-control @error('no_kk') is-invalid @enderror" value="{{$choirMember->no_kk}}">
                            @error('no_kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group form-check-inline form-check">
                            <label for="check_is_default" class="form-check-label ">
                                <input type="checkbox" id="check_is_default" name="check_is_default" class="form-check-input" <?php if ($choirMember->is_default == 1) echo 'checked' ?>>Default
                            </label>
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
