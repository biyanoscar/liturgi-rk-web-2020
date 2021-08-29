<x-admin-master>
    @section('title', 'Lagu')

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

    @if(session()->has('error-message'))
    <div class="alert alert-danger">
        {{session('error-message')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Input Lagu baru</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('songs.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="no" class="control-label mb-1">No</label>
                            <input id="no" name="no" type="text" class="form-control @error('no') is-invalid @enderror" value="{{ old('no') }}">
                            @error('no')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title" class="control-label mb-1">Judul</label>
                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="link" class="control-label mb-1">Link sumber lirik</label>
                            <input id="link" name="link" type="text" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                            @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lyrics" class="control-label mb-1">Lirik Lagu</label>
                            <textarea rows="4" id="lyrics" name="lyrics" type="text" class="form-control @error('lyrics') is-invalid @enderror">{{ old('lyrics') }}</textarea>

                            @error('lyrics')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="info" class="control-label mb-1">Info Tambahan</label>
                            <textarea rows="3" id="info" name="info" type="text" class="form-control @error('info') is-invalid @enderror">{{ old('info') }}</textarea>

                            @error('info')
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
