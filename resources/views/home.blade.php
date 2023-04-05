@forelse ($courses as $item)
    <h2>{{ $item->title }}</h2>
    <h2>{{ $item->description }}</h2>
    @empty
        <p>No courses found.</p>
@endforelse
