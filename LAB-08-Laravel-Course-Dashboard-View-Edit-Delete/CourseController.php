<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    // Show the dashboard page.
    public function index(Request $request)
    {
        return $this->dashboard($request);
    }

    // Save a new course.
    public function store(Request $request)
    {
        // Check the course information.
        $data = $this->validatedData($request);

        // Get the ID of the logged-in user.
        $data['user_id'] = $request->user()->id;

        // Save the course in the database.
        Course::create($data);

        // Go back to the dashboard.
        return redirect()->route('dashboard')
            ->with('success', 'Course registered.');
    }

    // Show the details of a selected course.
    public function show(Request $request, int $course)
    {
        // Find the course that belongs to the logged-in user.
        $record = $this->ownedCourse($request, $course);

        // Open the dashboard and show the selected course.
        return $this->dashboard($request, null, $record);
    }

    // Open a course for editing.
    public function edit(Request $request, int $course)
    {
        // Find the selected course.
        $record = $this->ownedCourse($request, $course);

        // Open the dashboard with the course information.
        return $this->dashboard($request, $record);
    }

    // Update the information of an existing course.
    public function update(Request $request, int $course)
    {
        // Find the course that belongs to the logged-in user.
        $record = $this->ownedCourse($request, $course);

        // Check the new course information.
        $data = $this->validatedData($request, $record);

        // Save the changes in the database.
        $record->update($data);

        // Return to the dashboard.
        return redirect()->route('dashboard')
            ->with('success', 'Course updated.');
    }

    // Delete a course.
    public function destroy(Request $request, int $course)
    {
        // Find the selected course.
        $record = $this->ownedCourse($request, $course);

        // Remove the course from the database.
        $record->delete();

        // Return to the dashboard.
        return redirect()->route('dashboard')
            ->with('success', 'Course deleted.');
    }

    // Get the courses of the logged-in user.
    private function dashboard(
        Request $request,
        ?Course $editing = null,
        ?Course $viewing = null
    ) {
        // Get all courses added by the current user.
        // Show the newest courses first.
        $courses = Course::where(
            'user_id', $request->user()->id
        )->latest()->get();

        // Send the course information to the dashboard page.
        return view('dashboard', [
            'courses' => $courses,
            'editing' => $editing,
            'viewing' => $viewing,
        ]);
    }

    // Find a course using its ID and the user's ID.
    private function ownedCourse(
        Request $request,
        int $course
    ): Course {
        return Course::where(
            'user_id', $request->user()->id
        )->findOrFail($course);
    }

    // Check the course information before saving it.
    private function validatedData(
        Request $request,
        ?Course $course = null
    ): array {

        // Get the course code entered by the user.
        $code = $request->input('course_code');

        // Remove extra spaces and change the code to uppercase.
        if (is_string($code)) {
            $request->merge([
                'course_code' => strtoupper(trim($code)),
            ]);
        }

        // Make sure the course code is not used by the same user.
        $unique = Rule::unique('courses', 'course_code')
            ->where('user_id', $request->user()->id);

        // When editing, ignore the current course code.
        if ($course !== null) {
            $unique->ignore($course);
        }

        // Check all the information entered in the course form.
        return $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:20',
                $unique,
            ],

            'course_name' => [
                'required',
                'string',
                'max:150',
            ],

            'credit_hours' => [
                'required',
                'integer',
                'between:1,6',
            ],

            'semester' => [
                'required',
                Rule::in(['Spring 2026', 'Fall 2026']),
            ],
        ]);
    }
}
