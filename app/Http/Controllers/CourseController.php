<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::released()->orderByDesc('released_at')->get();

        return view('home', compact('courses'));
    }

    public function show(Course $course)
    {
        return view('course-details', compact('course'));
    }
}
