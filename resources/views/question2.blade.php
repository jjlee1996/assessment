<!DOCTYPE html>
<html>

<head>
    <title>Message Analyzer</title>
    <link rel="stylesheet" href="{{ asset('css/question1.css') }}">
</head>

<body>
    <h1>Message Simulation</h1>
    <div class="container">
        <form id="analyzeForm">
            <label for="send">Mike sends:</label>
            <input type="text" name="send" id="send" class="form-control" value="{{ old('send', $input ?? '') }}"
                required>
            <span id="send-tooltip" class="input-tooltip" style="display:none; color: red; font-size: 0.9em;">Digits
                only!</span>

            <label for="receive">Sam receives:</label>
            <input type="text" name="receive" id="receive" class="form-control"
                value="{{ old('receive', $input ?? '') }}" required>
            <span id="receive-tooltip" class="input-tooltip" style="display:none; color: red; font-size: 0.9em;">Digits
                only!</span>

            <button type="submit">Analyze</button>
        </form>

        <p id="result"></p>
    </div>

    <script src="{{ asset('js/question2.js') }}"></script>
</body>

</html>
