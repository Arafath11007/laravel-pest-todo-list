<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('does not find unreleased courses', function () {

    //arrange
    $course = Course::factory()->create();

    //act and assert
    get(route('course-details', $course))
        ->assertNotFound();
});


it('shows course details', function () {
    // arrange
    $course = Course::Factory()->create();

    //act andassert
    get(route('course-details', $course))
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagLine,
            ...$course->learnings,
        ])
        ->assertSee(asset("images/$course->image_name"));
});

it('show course video count', function () {
    //arrange
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->create();
    // Video::factory()->count(3)->create(['course_id' => $course->id]);

    // act & assert
    get(route('course-details', $course))
        ->assertSeeText('3 videos');
});

it('has videos', function () {
    //arrange
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    //act and assert
    expect($course->videos)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Video::class);
});
