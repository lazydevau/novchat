<!-- resources/views/menu.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
    .pagination .page-link {
        font-size: 0.875rem;
        line-height: 1.25rem;
        padding: 0.5rem 0.75rem;
    }

    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    .pagination .page-item .page-link svg {
        width: 1rem;
        height: 1rem;
    }
    svg {
        width: 1.2em;
        height: 1.2em;
    }

</style>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('feeds.index') }}">NOVINARKO</a>
        <form class="d-flex" action="{{ route('feeds.search') }}" method="GET">
            <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        @auth
            <div class="d-flex">
                <a href="{{ route('profile.edit') }}">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; margin-left: 10px;">
                        <span>{{ Auth::user()->name[0] }}</span>
                    </div>
                </a>
            </div>
        @else
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
            </div>
        @endauth
    </div>
</nav>
