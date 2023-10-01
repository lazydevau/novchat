<!-- resources/views/feeds/index.blade.php -->

@include('menu')

<div class="row row-cols-1 row-cols-md-5 g-md-4 grid gap-1 flex-nowrap justify-content-center">
    @foreach ($feeds as $feed)
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 rounded-3 p-2 ">
            <div class="card h-100">
                <img src="{{ $feed->img }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('feeds.show', $feed) }}"
                                              class="link-secondary text-decoration-none">{{ $feed->title }} </a></h5>
                    <a href="{{ route('feeds.show', $feed) }}" class="btn btn-primary position-absolute bottom-0 end-0">Read
                        more</a>
                </div>
            </div>
        </div>
        @if ($loop->iteration % 5 == 0)
</div>
@if ($loop->last)
@else
    <div class="row row-cols-1 row-cols-md-{{ ceil(20 / $loop->remaining + 1) }} g-md-4 grid gap-1 flex-nowrap justify-content-center">
        @endif
        @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $feeds->links('pagination::bootstrap-4') }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
