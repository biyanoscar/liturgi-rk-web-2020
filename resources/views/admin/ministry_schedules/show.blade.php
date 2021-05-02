<x-admin-master>
    @section('title', 'Anggota Bertugas')

    @section('content')
    @if(session()->has('msg-success'))
    <div class="alert alert-success">
        {{session('msg-success')}}
    </div>
    @endif

    @if(session()->has('msg-deleted'))
    <div class="alert alert-danger">
        {{session('msg-deleted')}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            @if($choirMembers->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <strong class="card-title mb-3">Petugas Koor {{$ministrySchedule->massSchedule->mass_title}}</strong>
                </div>
                <div class="card-body">
                    <div class="tool-3 table-responsive table-data m-b-40">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <td>Nama</td>
                                    <td>No KK</td>
                                    <td>Tugasin</td>
                                    <td>Liburin</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($choirMembers as $choirMember)
                                <tr>
                                    <td>{{$choirMember->name}} </td>
                                    <td>{{$choirMember->no_kk}}</td>
                                    <td>
                                        <form method="post" action="{{route('ministrySchedules.choirMember.attach', $ministrySchedule) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="choir_member" value="{{$choirMember->id}}">
                                            <button type="submit" class="btn btn-primary" @if($ministrySchedule->choirMember->contains($choirMember))
                                                disabled
                                                @endif
                                                >Tugasin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('ministrySchedules.choirMember.detach', $ministrySchedule) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="choir_member" value="{{$choirMember->id}}">
                                            <button type="submit" class="btn btn-danger" @if(!$ministrySchedule->choirMember->contains($choirMember))
                                                disabled
                                                @endif
                                                >Liburin</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    @endsection


</x-admin-master>
