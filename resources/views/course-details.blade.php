<h2>{{ $course->title }}</h2>
<h3>{{ $course->tagLine }}</h3>
<p>{{ $course->description }}</p>
<p>{{ count($course->videos) }} videos</p>

<ul>
    @foreach ($course->learnings as $learning)
        <li>{{ $learning }}</li>
    @endforeach
</ul>

<img src="{{ asset("images/$course->image_name") }}" alt="image of the course {{ $course->title }}">
