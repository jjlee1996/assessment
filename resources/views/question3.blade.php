<!DOCTYPE html>
<html>

<head>
    <title>Student Test Summary</title>
    <link rel="stylesheet" href="{{ asset('css/question3.css') }}">
</head>

<body>
    <h1>Student Test Summary</h1>
    <div class="fillSampleButton">
        <button type="button" id="fillSample">Fill Sample Data</button>
    </div>
    <form method="POST" action="{{ url('/summary') }}">
        @csrf
        <table id="studentTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Math</th>
                    <th>Science</th>
                    <th>Action</th>
                </tr>
            </thead>

            @php
                $students = old('students', []);
            @endphp

            <tbody>
                @forelse ($students as $index => $student)
                    <tr class="student-row">
                        <td data-label="Name">
                            <input type="text" name="students[{{ $index }}][name]"
                                value="{{ $student['name'] }}" required>
                        </td>
                        <td data-label="Gender">
                            <select name="students[{{ $index }}][gender]" required>
                                <option value="">Select</option>
                                <option value="MALE" {{ $student['gender'] == 'MALE' ? 'selected' : '' }}>Male
                                </option>
                                <option value="FEMALE" {{ $student['gender'] == 'FEMALE' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </td>
                        <td data-label="Math">
                            <input type="number" name="students[{{ $index }}][math]"
                                value="{{ $student['math'] }}" min="0" max="100" required>
                        </td>
                        <td data-label="Science">
                            <input type="number" name="students[{{ $index }}][science]"
                                value="{{ $student['science'] }}" min="0" max="100" required>
                        </td>
                        <td data-label="Action">
                            <button type="button" class="remove">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr class="student-row">
                        <td data-label="Name"><input type="text" name="students[0][name]" required></td>
                        <td data-label="Gender">
                            <select name="students[0][gender]" required>
                                <option value="">Select</option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </td>
                        <td data-label="Math"><input type="number" name="students[0][math]" min="0"
                                max="100" required></td>
                        <td data-label="Science"><input type="number" name="students[0][science]" min="0"
                                max="100" required></td>
                        <td data-label="Action"><button type="button" class="remove">Remove</button></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <button type="button" id="addRow">Add Student</button>
        <button type="submit">Submit All</button>
    </form>

    @if (session('summaries'))
        <div class="summary-box">
            <h3>Results:</h3>
            <ul>
                @foreach (session('summaries') as $summary)
                    <li>{!! $summary !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script src="{{ asset('js/question3.js') }}"></script>
    <script src="{{ asset('js/question3SampleData.js') }}"></script>
</body>

</html>
