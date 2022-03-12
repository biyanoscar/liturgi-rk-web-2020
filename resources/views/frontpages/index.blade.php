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
                        <a href="{{ route('lyrics', $schedule->id) }}">
                            <h4 class="text-center text-uppercase mt-3">{{$title}} : {{$scheduleTime->isoFormat('D MMMM Y')}}</h4>
                        </a>
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
                                    <td>{{($schedule->kyrie_song)?'Tuhan kasihanilah kami':'Ordinarium'}}</td>
                                    <td>{{($schedule->kyrie_song)?$schedule->kyrie_song:'Tuhan kasihanilah kami'}}</td>
                                </tr>

                                @if ($schedule->show_gloria == 1)
                                <tr>
                                    <td>{{($schedule->gloria_song)?'Kemuliaan':'Ordinarium'}}</td>
                                    <td>{{($schedule->gloria_song)?$schedule->gloria_song:'Kemuliaan'}}</td>
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
                                @if ($schedule->second_reading)
                                <tr>
                                    <td>Liturgi Sabda: Bacaan 2</td>
                                    <td>{{$schedule->second_reading}}</td>
                                </tr>
                                @endif

                                @if ($schedule->reading_01)
                                <tr>
                                    <td>{{$schedule->reading_01_notes}}</td>
                                    <td>{{$schedule->reading_01}}</td>
                                </tr>
                                @endif

                                @if ($schedule->reading_02)
                                <tr>
                                    <td>{{$schedule->reading_02_notes}}</td>
                                    <td>{{$schedule->reading_02}}</td>
                                </tr>
                                @endif

                                @if ($schedule->reading_03)
                                <tr>
                                    <td>{{$schedule->reading_03_notes}}</td>
                                    <td>{{$schedule->reading_03}}</td>
                                </tr>
                                @endif

                                @if ($schedule->reading_04)
                                <tr>
                                    <td>{{$schedule->reading_04_notes}}</td>
                                    <td>{{$schedule->reading_04}}</td>
                                </tr>
                                @endif

                                @if ($schedule->reading_05)
                                <tr>
                                    <td>{{$schedule->reading_05_notes}}</td>
                                    <td>{{$schedule->reading_05}}</td>
                                </tr>
                                @endif
                                
                                <tr>
                                    <td>Bait Pengantar Injil</td>
                                    <td>{{$schedule->alleluia_song}}</td>
                                </tr>
                                <tr>
                                    <td>Bacaan Injil</td>
                                    <td>{{$schedule->gospel_reading}}</td>
                                </tr>

                                @if ($schedule->is_daily_mass == 0 and $schedule->prayer_of_the_faithful)
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
                                    <td>{{($schedule->sanctus_song)?$schedule->sanctus_song:'Kudus'}}</td>
                                </tr>
                                @endif


                                <tr>
                                    <td>Bapa Kami</td>
                                    <td>{{ ($schedule->lords_prayer_song) ? $schedule->lords_prayer_song: 'Bapa Kami' }}</td>
                                </tr>


                                @if ($schedule->is_daily_mass == 0)
                                <tr>
                                    <td>Anak Domba Allah</td>
                                    <td>{{($schedule->agnus_dei_song)?$schedule->agnus_dei_song:'Anak Domba Allah'}}</td>
                                </tr>
                                <tr>
                                    <td>Saat penerimaan komuni</td>
                                    <td>{{$schedule->communion_song?$schedule->communion_song:'Lagu Komuni Batin (diperdengarkan sayup-sayup)'}}</td>
                                </tr>
                                <?php if ($schedule->song_of_praise) : ?>
                                    <tr>
                                        <td></td>
                                        <td>{{$schedule->song_of_praise}}</td>
                                    </tr>
                                <?php endif ?>
                                @else
                                <tr>
                                    <td>Ordinarium</td>
                                    <td>Anak Domba Allah</td>
                                </tr>
                                <tr>
                                    <td>Saat penerimaan komuni</td>
                                    <td>Lagu Komuni Batin <span class="text-danger font-italic">(diperdengarkan sayup-sayup)</span>
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

                                @if ($schedule->song01)
                                <tr>
                                    <td>{{$schedule->song_01_notes}}</td>
                                    <td>{{$schedule->song01->title}}</td>
                                </tr>
                                @endif

                                @if ($schedule->song02)
                                <tr>
                                    <td>{{$schedule->song_02_notes}}</td>
                                    <td>{{$schedule->song02->title}}</td>
                                </tr>
                                @endif

                                @if ($schedule->song03)
                                <tr>
                                    <td>{{$schedule->song_03_notes}}</td>
                                    <td>{{$schedule->song03->title}}</td>
                                </tr>
                                @endif

                                @if ($schedule->song04)
                                <tr>
                                    <td>{{$schedule->song_04_notes}}</td>
                                    <td>{{$schedule->song04->title}}</td>
                                </tr>
                                @endif

                                @if ($schedule->song05)
                                <tr>
                                    <td>{{$schedule->song_05_notes}}</td>
                                    <td>{{$schedule->song05->title}}</td>
                                </tr>
                                @endif
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