<x-admin-master>
    @section('title', 'Paduan Suara')

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
                        <h3 class="text-center title-2 mb-3">Input Paduan Suara baru</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('choirs.store')}}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Nama</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="row form-group">
                            <div class="col">
                                <label for="user_id" class=" form-control-label">User</label>
                            </div>
                            <div class="col-12">
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
