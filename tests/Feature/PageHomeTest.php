<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use function Pest\Laravel\get;

//database refresh
uses(RefreshDatabase::class);

/**
 * @test
 */
it('shows courses overview', function () {
    //Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $lastCourse = Course::factory()->released()->create();

    //Act & assert
    get(route('home'))->assertSeeText([
        $firstCourse->title,
        $firstCourse->description,
        $secondCourse->title,
        $secondCourse->description,
        $lastCourse->title,
        $lastCourse->description,
    ]);
});

/**
 * @test
 */
it('shows only released courses', function () {
    $releasedCourse = Course::factory()->released()->create();
    $notReleasedCourse = Course::factory()->create();

    get(route('home'))
        ->assertSeeText(
            $releasedCourse->title
        )
        ->assertDontSeeText(
            $notReleasedCourse->title
        );
});

/**
 * @test
 */
it('show courses by released date', function () {
    $releasedCourse = Course::factory()->released(Carbon::yesterday())->create();
    $newestReleasedCourse = Course::factory()->released()->create();

    //Act & assert
    get(route('home'))->assertSeeTextInOrder([
        $newestReleasedCourse->title,
        $releasedCourse->title,
    ]);
});
