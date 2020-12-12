<x-frontpage-master>
    @section('content')
    <h1>List Misa Harian</h1>
    <div class="accordion" id="accordionSchedules">
        <?php $i = 0; ?>
        @foreach($massSchedules as $schedule)

        <div class="card">
            <div class="card-header" id="heading{{$schedule->id}}">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$schedule->id}}" aria-expanded="true" aria-controls="collapse{{$schedule->id}}">
                        {{$schedule->mass_title . '; Tanggal : '. $schedule->schedule_time}}
                    </button>
                </h2>
            </div>

            <div id="collapse{{$schedule->id}}" class="collapse <?php if ($i == 0) echo 'show' ?>" aria-labelledby="heading{{$schedule->id}}" data-parent="#accordionSchedules">
                <div class="card-body">
                    Lagu Pembukaan : {{$schedule->entrance_song}} <br>
                    Aleluya : {{$schedule->alleluia_song}} <br>
                    Lagu Penutup : {{$schedule->recessional_song}} <br>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @endforeach

    </div>
    @endsection
</x-frontpage-master>