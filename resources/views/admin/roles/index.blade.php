<x-admin-master>
    @section('title', 'Roles')


    @section('content')

    @if(session()->has('role-deleted'))
    <div class="alert alert-danger">
        {{session('role-deleted')}}
    </div>
    @endif

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Create</button>
                    </form>
                </div>

            </div>

        </div>

        <div class="col-sm-9">
            <!-- USER DATA-->
            <div class="user-data m-b-30">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-calendar-alt"></i></i>Roles</h3>



                <div class="tool-3 table-responsive table-data m-b-40">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>

                                <td>Nama</td>
                                <td>Slug</td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td> <a href="{{route('roles.edit', $role->id) }}">{{$role->name}}</a> </td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="POST" action="{{route('roles.destroy', $role->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

            </div>
            <!-- END USER DATA-->
        </div>

    </div>
    @endsection




</x-admin-master>