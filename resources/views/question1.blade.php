<!DOCTYPE html>
<html>

<head>
    <title>Question 1</title>
    <link rel="stylesheet" href="{{ asset('css/question1.css') }}">
</head>

<body>
    <h1>Question 1</h1>
    <div class="container">
        <form id="downloadForm">
            <label for="memberType">Member Type:</label>
            <select id="memberType" name="memberType">
                <option value="MEMBER">Member</option>
                <option value="NON_MEMBER">Non-member</option>
            </select>

            <label for="fileType">File Type:</label>
            <select id="fileType" name="fileType">
                <option value="JPEG">JPEG</option>
                <option value="TXT">TXT</option>
                <option value="PDF">PDF</option>
            </select>

            <button type="submit">Download</button>
        </form>

        <p id="result"></p>
    </div>

    <script src="{{ asset('js/question1.js') }}"></script>
</body>

</html>
