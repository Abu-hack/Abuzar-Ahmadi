
<!-- Show the number of courses registered by the student. -->
<h2>My Registered Courses ({{ $courses->count() }})</h2>

<p class="muted">
    Use View, Edit, or Delete beside a course.
</p>

<!-- Allow the table to scroll on small screens. -->
<div class="table-wrap">

    <table>
        <thead>
            <tr>
                <th>Code / Course</th>
                <th>Credits</th>
                <th>Semester</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <!-- Display each course in a separate row. -->
            @forelse ($courses as $course)

                <!-- Highlight the course being edited. -->
                <tr class="{{ $editing && $editing->id == $course->id ? 'editing-row' : '' }}">

                    <!-- Course code and name. -->
                    <td>
                        <strong>{{ $course->course_code }}</strong>

                        <span class="course-title">
                            {{ $course->course_name }}
                        </span>
                    </td>

                    <!-- Credit hours. -->
                    <td>{{ $course->credit_hours }}</td>

                    <!-- Semester. -->
                    <td>{{ $course->semester }}</td>

                    <!-- Actions for this course. -->
                    <td>
                        <div class="table-actions">

                            <!-- View course details. -->
                            <a
                                href="{{ route('courses.show', $course->id) }}"
                                class="btn btn-small btn-light"
                            >
                                View
                            </a>

                            <!-- Edit this course. -->
                            <a
                                href="{{ route('courses.edit', $course->id) }}"
                                class="btn btn-small btn-primary"
                            >
                                Edit
                            </a>

                            <!-- Delete this course. -->
                            <form
                                method="POST"
                                action="{{ route('courses.destroy', $course->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this course?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-small btn-danger"
                                >
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            <!-- Display a message if the list is empty. -->
            @empty
                <tr>
                    <td colspan="4">
                        No courses registered yet.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>
