
<!-- Display the details of the selected course. -->
<section class="card details-card">

    <h2>Course Details</h2>

    <!-- Show the course information in a read-only format. -->
    <dl class="details-grid">

        <!-- Course code. -->
        <div>
            <dt>Course Code</dt>
            <dd>{{ $viewing->course_code }}</dd>
        </div>

        <!-- Course name. -->
        <div>
            <dt>Course Name</dt>
            <dd>{{ $viewing->course_name }}</dd>
        </div>

        <!-- Number of credit hours. -->
        <div>
            <dt>Credit Hours</dt>
            <dd>{{ $viewing->credit_hours }}</dd>
        </div>

        <!-- Semester of the course. -->
        <div>
            <dt>Semester</dt>
            <dd>{{ $viewing->semester }}</dd>
        </div>

        <!-- Date and time when the course was registered. -->
        <div>
            <dt>Registered On</dt>
            <dd>{{ $viewing->created_at->format('d M Y, H:i') }}</dd>
        </div>

    </dl>

    <!-- Buttons for editing the course or closing its details. -->
    <div class="form-actions">

        <!-- Open the edit form for this course. -->
        <a href="{{ route('courses.edit', $viewing->id) }}"
           class="btn btn-primary">
            Edit This Course
        </a>

        <!-- Return to the dashboard without showing course details. -->
        <a href="{{ route('dashboard') }}"
           class="btn btn-light">
            Close Details
        </a>

    </div>

</section>
