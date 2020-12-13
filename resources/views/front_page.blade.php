<x-frontpage-master>
    @section('content')


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>List Misa</h2>
            </div>

            <ul class="faq-list" data-aos="fade-up">

                @foreach($massSchedules as $schedule)
                <?php
                $scheduleTime = \Carbon\Carbon::parse($schedule->schedule_time);
                if ($schedule->holy_day_of_obligation) {
                    $title = 'Misa ' . $schedule->holy_day_of_obligation;
                } elseif ($schedule->is_daily_mass == 0) {
                    $title = 'Misa hari ' . $scheduleTime->isoFormat('dddd') . ' ' . $schedule->mass_title;
                } else {
                    $title = 'Misa hari ' . $scheduleTime->isoFormat('dddd') . ', ' . $schedule->mass_title;
                }



                ?>
                <li>
                    <a data-toggle="collapse" class="collapsed" href="#faq{{$schedule->id}}">{{$schedule->mass_title . '; '. $scheduleTime->isoFormat('dddd, D MMM Y HH:mm')}} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq{{$schedule->id}}" class="collapse" data-parent=".faq-list">
                        <h4 class="text-center text-uppercase mt-3">{{$title}} : {{$scheduleTime->isoFormat('D MMMM Y')}}</h4>
                        <table>
                            <thead>
                                <th>
                                    <span class="text-danger font-italic">
                                        Ditayangkan sebelum misa berlangsung
                                    </span>
                                </th>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="text-uppercase">
                                            PERAYAAN EKARISTI (ONLINE)<br>
                                            <b>
                                                {{$title}}<br>
                                                {{$scheduleTime->isoFormat('D MMMM Y')}}<br>
                                            </b>
                                            <br>
                                            DISIARKAN LANGSUNG DARI<br>
                                            GEREJA KATOLIK PAROKI ROH KUDUS PURIMAS SURABAYA<br><br>

                                            DOA MALAIKAT TUHAN<br>

                                        </p>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                        <br>


                        <table class="table table-sm table-hover">
                            <thead>
                                <th class="table-primary" colspan="2">
                                    <span class="text-danger font-italic">
                                        Ditayangkan saat misa berlangsung
                                    </span>
                                </th>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>Lagu Pembukaan</td>
                                    <td>{{$schedule->entrance_song}}</td>
                                </tr>
                                <tr>
                                    <td>Ordinarium</td>
                                    <td>{{($schedule->kyrie_song)?$schedule->kyrie_song:'Tuhan kasihanilah kami'}}</td>
                                </tr>

                                @if ($schedule->gloria_song)
                                <tr>
                                    <td>Kemuliaan</td>
                                    <td>{{$schedule->gloria_song }}</td>
                                </tr>
                                @endif

                                <tr>
                                    <td>Liturgi Sabda: Bacaan 1</td>
                                    <td>{{$schedule->first_reading}}</td>
                                </tr>
                                <tr>
                                    <td>Mazmur Tanggapan</td>
                                    <td>U: {{$schedule->psalm_song}}</td>
                                </tr>
                                @if ($schedule->is_daily_mass == 0)
                                <tr>
                                    <td>Liturgi Sabda: Bacaan 2</td>
                                    <td>{{$schedule->second_reading}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Bait Pengantar Injil</td>
                                    <td>{{$schedule->alleluia_song}} Alleluya</td>
                                </tr>
                                <tr>
                                    <td>Bacaan Injil</td>
                                    <td>{{$schedule->gospel_reading}}</td>
                                </tr>

                                @if ($schedule->prayer_of_the_faithful)
                                <tr>
                                    <td>Doa Umat</td>
                                    <td>U: {{$schedule->prayer_of_the_faithful }}</td>
                                </tr>
                                @endif

                                @if ($schedule->is_daily_mass == 0)
                                <tr>
                                    <td>Persembahan</td>
                                    <td>{{$schedule->offertory_song}}</td>
                                </tr>
                                <tr>
                                    <td>Kudus</td>
                                    <td>{{$schedule->sanctus_song}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>Ordinarium</td>
                                    <td>Kudus</td>
                                </tr>
                                @endif


                                <tr>
                                    <td>Bapa Kami</td>
                                    <td>Bapa Kami</td>
                                </tr>
                                <tr>
                                    <td>Ordinarium</td>
                                    <td>{{($schedule->agnus_dei_song)?$schedule->agnus_dei_song:'Anak Domba Allah'}}</td>
                                </tr>

                                @if ($schedule->is_daily_mass == 0)
                                <tr>
                                    <td>Saat penerimaan komuni</td>
                                    <td>{{$schedule->communion_song}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>{{$schedule->song_of_praise}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>Saat penerimaan komuni</td>
                                    <td>Saat penerimaan komuni Lagu Komuni Batin <span class="text-danger font-italic">(diperdengarkan sayup-sayup)</span>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td></td>
                                    <td><span class="text-danger font-italic">Ditayangkan Doa Komuni Batin</span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><span class="text-danger font-italic">Mendaraskan doa pembangunan pastoran gereja</span></td>
                                </tr>
                                <tr>
                                    <td>Lagu Penutup</td>
                                    <td>{{$schedule->recessional_song}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                @endforeach



            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->
    @endsection
</x-frontpage-master>