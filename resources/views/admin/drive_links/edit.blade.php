<x-admin-master>
    @section('title', 'Drive Links')

    @section('alert')
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
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
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 mb-3">Drive Link</h3>
                        </div>
                        <hr>
                        <form method="post" action="{{ route('drive-links.update', $driveLink->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Nama</label>
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') ?? $driveLink->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="link_id" class="control-label mb-1">Link Id</label>
                                <input id="link_id" name="link_id" type="text"
                                    class="form-control @error('link_id') is-invalid @enderror"
                                    value="{{ old('link_id') ?? $driveLink->link_id }}">
                                @error('link_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="order_num" class="control-label mb-1">No Urut</label>
                                <input id="order_num" name="order_num" type="number" min="1"
                                    class="form-control @error('order_num') is-invalid @enderror"
                                    value="{{ old('order_num') ?? $driveLink->order_num }}">
                                @error('order_num')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group form-check-inline form-check">
                                <label for="check_active" class="form-check-label ">
                                    <input type="checkbox" id="check_active" name="check_active" class="form-check-input"
                                        {{ $driveLink->active == 1 ? 'checked' : '' }}>Active
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

</x-admin-master>
