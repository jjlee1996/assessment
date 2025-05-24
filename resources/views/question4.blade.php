<!DOCTYPE html>
<html>

<head>
    <title>Question 4</title>
    <link rel="stylesheet" href="{{ asset('css/question1.css') }}">
</head>

<body>
    <h1>Question 4</h1>
    <div class="container">
        <form id="gachaForm">

            <label for="rarities">Item Rarities (single number):</label>
            <input type="text" name="rarities" id="rarities" class="form-control" value="5" required>
            <span id="rarities-tooltip" class="input-tooltip" style="display:none; color: red; font-size: 0.9em;">Digits
                only!</span>

            <label for="vips">VIP Levels (single number):</label>
            <input type="text" name="vips" id="vips" class="form-control" value="3" required>
            <span id="vips-tooltip" class="input-tooltip" style="display:none; color: red; font-size: 0.9em;">Digits
                only!</span>
            
            <button id="simulate-btn">Roll</button>

        </form>
        {{-- <div class="results" id="results"></div> --}}
        <p id="result"></p>
    </div>

    <script src="{{ asset('js/question4.js') }}"></script>
</body>

</html>
