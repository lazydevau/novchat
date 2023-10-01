<!-- resources/views/feeds/show.blade.php -->
@include('menu')

<div class="row">
    <div class="col-md-4">
        <img src="{{ $feed->img }}" class="img-fluid" alt="...">
    </div>
    <div class="col-md-8">
        <h2>{{ $feed->title }}</h2>
        <p>{{ $feed->description }}</p>
        <p>{{ $feed->content }}</p>
        <p>{{ $feed->pubDate }}</p>
    </div>
</div>

