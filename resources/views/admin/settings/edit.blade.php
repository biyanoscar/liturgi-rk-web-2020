<x-admin-master>
    @section('title', 'Setting')

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
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Setting</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('settings.update', $setting->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="drive_link_id" class="control-label mb-1">Drive Link ID</label>
                            <input id="drive_link_id" name="drive_link_id" type="text" class="form-control @error('drive_link_id') is-invalid @enderror" value="{{old('drive_link_id') ? old('drive_link_id') :$setting->drive_link_id}}">
                            @error('drive_link_id')
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
