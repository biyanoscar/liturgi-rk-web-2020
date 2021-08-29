<x-frontpage-master>
    @section('styles')
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family: "Playfair Display", Georgia, "Times New Roman", serif;
        }
        
        /*
        * Blog posts
        */
        .blog-post {
            margin-bottom: 4rem;
        }
        .blog-post-title {
            margin-bottom: .25rem;
            font-size: 2.5rem;
        }
        .blog-post-meta {
            margin-bottom: 1.25rem;
            color: #999;
        }
    </style>
    @endsection

    @section('content')

    @php
        $scheduleTime = \Carbon\Carbon::parse($massSchedule->schedule_time);

        $entranceSongLyrics = ($massSchedule->entranceSong)? $massSchedule->entranceSong->lyrics : '';
        $kyrieSongLyrics = ($massSchedule->kyrieSong)? $massSchedule->kyrieSong->lyrics : '';
        $gloriaSongLyrics = ($massSchedule->gloriaSong)? $massSchedule->gloriaSong->lyrics : '';
        $offertorySongLyrics = ($massSchedule->offertorySong)? $massSchedule->offertorySong->lyrics : '';
        $sanctusSongLyrics = ($massSchedule->sanctusSong)? $massSchedule->sanctusSong->lyrics : '';
        $lordsPrayerSongLyrics = ($massSchedule->lordsPrayerSong)? $massSchedule->lordsPrayerSong->lyrics : '';
        $agnusDeiSongLyrics = ($massSchedule->agnusDeiSong)? $massSchedule->agnusDeiSong->lyrics : '';
        $communionSongLyrics = ($massSchedule->communionSong)? $massSchedule->communionSong->lyrics : '';
        $songOfPraiseLyrics = ($massSchedule->songOfPraise)? $massSchedule->songOfPraise->lyrics : '';
        $recessionalSongLyrics = ($massSchedule->recessionalSong)? $massSchedule->recessionalSong->lyrics : '';
    @endphp

    <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $massSchedule->mass_title . '; '. $scheduleTime->isoFormat('dddd, D MMM Y HH:mm') }}
          </h3>

          <div class="blog-post">
            <h2 class="blog-post-title">{{ $massSchedule->mass_title }}</h2>
            <br>

            <h3>Pembukaan : {{ $massSchedule->entrance_song }}</h3>
            <p>{!! nl2br(e($entranceSongLyrics)) !!}</p>
            <br>
            
            <h3>Tuhan kasihanilah kami : {{ $massSchedule->kyrie_song }}</h3>
            <p>{!! nl2br(e($kyrieSongLyrics)) !!}</p>
            <br>
            
            <h3>Kemuliaan : {{ $massSchedule->gloria_song }}</h3>
            <p>{!! nl2br(e($gloriaSongLyrics)) !!}</p>
            <br>

            <h3>Persembahan : {{ $massSchedule->offertory_song }}</h3>
            <p>{!! nl2br(e($offertorySongLyrics)) !!}</p>
            <br>

            <h3>Kudus : {{ $massSchedule->sanctus_song }}</h3>
            <p>{!! nl2br(e($sanctusSongLyrics)) !!}</p>
            <br>

            <h3>Bapa Kami : {{ $massSchedule->lords_prayer_song }}</h3>
            <p>{!! nl2br(e($lordsPrayerSongLyrics)) !!}</p>
            <br>

            <h3>Anak Domba Allah: {{ $massSchedule->agnus_dei_song }}</h3>
            <p>{!! nl2br(e($agnusDeiSongLyrics)) !!}</p>
            <br>

            <h3>Komuni : {{ $massSchedule->communion_song }}</h3>
            <p>{!! nl2br(e($communionSongLyrics)) !!}</p>
            <br>

            <h3>Madah Syukur : {{ $massSchedule->song_of_praise }}</h3>
            <p>{!! nl2br(e($songOfPraiseLyrics)) !!}</p>
            <br>

            <h3>Penutup: {{ $massSchedule->recessional_song }}</h3>
            <p>{!! nl2br(e($recessionalSongLyrics)) !!}</p>
            <br>
            
          </div><!-- /.blog-post -->
          
        </div><!-- /.blog-main -->
      </div><!-- /.row -->

    @endsection
</x-frontpage-master>