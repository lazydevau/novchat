<!-- resources/views/feeds/index.blade.php -->

@include('menu')

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        @foreach ($feeds as $feed)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $feed->img }}" class="card-img-top" alt="{{ $feed->title }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('feeds.show', $feed) }}" class="link-secondary text-decoration-none">
                                {{ $feed->title }}
                            </a>
                        </h5>
                        <a href="{{ route('feeds.show', $feed) }}" class="btn btn-primary">
                            Read more
                        </a>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 5 == 0)
                <div class="w-100"></div>
            @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $feeds->links('pagination::bootstrap-4') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>