<x-frontpage-master>
    @section('content')


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>List Petugas</h2>
            </div>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Misa</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Paduan Suara</th>
                    <th scope="col">Organis</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($massSchedules as $schedule)
                    <?php $scheduleTime = \Carbon\Carbon::parse($schedule->schedule_time); ?>
                    <tr>
                        <td>{{$schedule->mass_title}}</td>
                        <td>{{$scheduleTime->isoFormat('dddd, D MMM Y HH:mm')}}</td>
                        <th>{{$schedule->choir_name}}</th>
                        <th>{{$schedule->organist_name}}</th>
                    </tr>

                    <tr class="blank_row">
                        <td colspan="5"></td>
                    </tr>
                    @endforeach

                </tbody>
              </table>

        </div>
    </section><!-- End Frequently Asked Questions Section -->
    @endsection
</x-frontpage-master>
