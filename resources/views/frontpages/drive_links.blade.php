<x-frontpage-master>
    @section('content')
        <div class="container">
            <div class="col-12">
                @foreach ($driveLinks as $link)
                    <iframe src="https://drive.google.com/file/d/{{ $link->link_id }}/preview" width="100%" height="480"
                        allow="autoplay"></iframe>
                @endforeach
            </div>
        </div>
    @endsection
</x-frontpage-master>
