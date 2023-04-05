<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

//database refresh
uses(RefreshDatabase::class);

test('gives back successful response for home page', function () {
    get(route('home'))->assertOk();
});

it('gives back successfull response for course details page', function () {
    //arrange
    $course = Course::factory()->create();

    //act && assert
    get(route('course-details', $course))
        ->assertOk();
});
