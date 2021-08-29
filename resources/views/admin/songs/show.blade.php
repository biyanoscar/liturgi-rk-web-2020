<x-admin-master>
    @section('title', 'Song')

    @section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 mb-3">{{ $song->title }}</h3>
                    </div>
                    <hr>
                    <p>{!! nl2br(e($song->info)) !!}</p>
                    <br>
                    <p>{!! nl2br(e($song->lyrics)) !!}</p>
                </div>
            </div>
        </div>

    </div>
    @endsection


</x-admin-master>
