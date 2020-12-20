<x-admin-master>
    @section('title', 'Roles')

    @section('content')
    @if(session()->has('role-updated'))
    <div class="alert alert-success">
        {{session('role-updated')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">Edit Role</h3>
                    </div>
                    <hr>
                    <form method="post" action="{{route('roles.update', $role->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Nama</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$role->name}}">
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

    <div class="row">
        <div class="col-lg-12">
            @if($users->isNotEmpty())
            <div class="tool-3 table-responsive table-data m-b-40">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Email</td>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}} </td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form method="post" action="{{route('roles.user.attach', $role) }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="user" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-primary" @if($role->users->contains($user))
                                        disabled
                                        @endif
                                        >Attach</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('roles.user.detach', $role) }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="user" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-danger" @if(!$role->users->contains($user))
                                        disabled
                                        @endif
                                        >Detach</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
    @endsection


</x-admin-master>