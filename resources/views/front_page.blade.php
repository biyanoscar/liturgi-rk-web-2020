<x-frontpage-master>
    @section('content')


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>List Misa Harian</h2>
            </div>

            <ul class="faq-list" data-aos="fade-up">

                @foreach($massSchedules as $schedule)
                <li>
                    <a data-toggle="collapse" class="collapsed" href="#faq{{$schedule->id}}">{{$schedule->mass_title . '; Tanggal : '. $schedule->schedule_time}} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq{{$schedule->id}}" class="collapse" data-parent=".faq-list">
                        <p>
                            Lagu Pembukaan : {{$schedule->entrance_song}} <br>
                            Aleluya : {{$schedule->alleluia_song}} <br>
                            Lagu Penutup : {{$schedule->recessional_song}} <br>
                        </p>
                    </div>
                </li>
                @endforeach



            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->
    @endsection
</x-frontpage-master>