
<!-- Show whether the student is adding or editing a course. -->
<h2>{{ $editing ? 'Edit Course' : 'Register a Course' }}</h2>

<p class="muted">Fields marked * are required.</p>

<!-- Display validation errors if there are any. -->
@if ($errors->any())
    <div class="notice error" role="alert">
        <strong>Please correct the following:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Send the form to the correct route. -->
<form method="POST"
      action="{{ $editing
          ? route('courses.update', $editing->id)
          : route('courses.store') }}">

    @csrf

    <!-- Use PUT when updating an existing course. -->
    @if ($editing)
        @method('PUT')
    @endif

    <!-- Course code field. -->
    <div class="form-group">
        <label for="course_code">Course Code *</label>

        <input
            type="text"
            id="course_code"
            name="course_code"
            value="{{ old('course_code', $editing?->course_code) }}"
            maxlength="20"
            required
        >
    </div>

    <!-- Course name field. -->
    <div class="form-group">
        <label for="course_name">Course Name *</label>

        <input
            type="text"
            id="course_name"
            name="course_name"
            value="{{ old('course_name', $editing?->course_name) }}"
            maxlength="150"
            required
        >
    </div>

    <!-- Credit hours field. -->
    <div class="form-group">
        <label for="credit_hours">Credit Hours *</label>

        <input
            type="number"
            id="credit_hours"
            name="credit_hours"
            value="{{ old('credit_hours', $editing?->credit_hours) }}"
            min="1"
            max="6"
            step="1"
            required
        >
    </div>

    <!-- Semester dropdown. -->
    <div class="form-group">
        <label for="semester">Semester *</label>

        <select id="semester" name="semester" required>
            <option value="">Select semester</option>

            @foreach (['Spring 2026', 'Fall 2026'] as $term)
                <option
                    value="{{ $term }}"
                    @selected(old('semester', $editing?->semester) === $term)
                >
                    {{ $term }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Save or cancel the form. -->
    <div class="form-actions">

        <button type="submit" class="btn btn-primary">
            {{ $editing ? 'Save Changes' : 'Register Course' }}
        </button>

        @if ($editing)
            <a href="{{ route('dashboard') }}" class="btn btn-light">
                Cancel
            </a>
        @endif

    </div>

</form>
