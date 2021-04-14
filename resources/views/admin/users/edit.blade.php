<x-admin-master>
    @section('title', 'users')

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

    @if(session()->has('user-updated'))
    <div class="alert alert-success">
        {{session('user-updated')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Edit User</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input type="email"  id="email" name="email"class="form-control" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label mb-1">Password</label>
                            <input type="password" id="password" name="password" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="control-label mb-1">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
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
