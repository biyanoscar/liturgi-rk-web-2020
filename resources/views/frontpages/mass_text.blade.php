<x-frontpage-master>
    @section('content')

    <div class="container">
        <div class="col-12 my-2">
            <a class="btn btn-primary" href="https://drive.google.com/uc?export=download&id={{$driveLinkId}}" role="button">Download</a>
        </div>
        <div class="col-12">
            <iframe src="https://drive.google.com/file/d/{{$driveLinkId}}/preview" width="100%" height="480" allow="autoplay"></iframe>
        </div>
    </div>
    @endsection
</x-frontpage-master>
