<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupe du Monde Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            background-image: url('{{ asset('images/photo.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            color: #333;
        }
        h1 {
            color: #333;
        }
        .form-container, #quiz-container {
            max-width: 600px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .form-container {
            padding: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .question {
            margin-bottom: 20px;
            font-size: larger;
            font-style: oblique;
            color: black;
            border: 2px solid #fff;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
        }
        .question p {
            margin: 0 0 10px;
        }
        .question input {
            margin-right: 10px;
        }
        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="form-container">
    <form action="{{ route('player.add') }}" method="POST" id="playerForm">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>
        <label for="role">Role</label>
        <input type="text" id="role" name="role" placeholder="Enter your role" required>
        <label for="team">Choose a team</label>
        <select id="team" name="team" required>
            <option value="team1">Team 1</option>
            <option value="team2">Team 2</option>
        </select>
        <input type="hidden" id="note" name="note"> <!-- Hidden input field for note -->
        <button type="submit">Add Player</button>
    </form>
</div>
<div id="quiz-container">
    <h1>Man of the Match Quiz</h1>
    <form id="quiz-form">
        @csrf
        <div class="question" id="question1">
            <p>1. Make a goal</p>
            <input type="radio" name="q1" value="a" required> a) Yes
            <input type="radio" name="q1" value="b"> b) No
        </div>
        <div class="question" id="question2">
            <p>2. Make an assist</p>
            <input type="radio" name="q2" value="a" required> a) Yes
            <input type="radio" name="q2" value="b"> b) No
        </div>
        <div class="question" id="question3">
            <p>3. Key Passes and Crosses</p>
            <input type="radio" name="q3" value="a" required> a) More than 80%
            <input type="radio" name="q3" value="b"> b) Less than 80%
        </div>
        <div class="question" id="question4">
            <p>4. Defensive Contributions</p>
            <input type="radio" name="q4" value="a" required> a) Win most of duels
            <input type="radio" name="q4" value="b"> b) Not
        </div>
        <div class="question" id="question5">
            <p>5. Make correct interceptions</p>
            <input type="radio" name="q5" value="a" required> a) More than 80%
            <input type="radio" name="q5" value="b"> b) Less than 80%
        </div>
        <div class="question" id="question6">
            <p>6. Make a penalty</p>
            <input type="radio" name="q6" value="a" required> a) Yes
            <input type="radio" name="q6" value="b"> b) No
        </div>
        <div class="question" id="question7">
            <p>7. Leadership and Influence</p>
            <input type="radio" name="q7" value="a" required> a) Demonstrating leadership qualities
            <input type="radio" name="q7" value="b"> b) Not
        </div>
        <div class="question" id="question8">
            <p>8. Moment of Brilliance</p>
            <input type="radio" name="q8" value="a" required> a) Executing a game-changing moment
            <input type="radio" name="q8" value="b"> b) Not
        </div>
        <div class="question" id="question9">
            <p>9. Set Piece Mastery</p>
            <input type="radio" name="q9" value="a" required> a) Excellence in taking set pieces
            <input type="radio" name="q9" value="b"> b) Not
        </div>
        <button type="button" onclick="submitQuiz()">Submit</button>
    </form>
    <div id="result"></div>
</div>
<script>
    function submitQuiz() {
        var score = calculateScore();

        // Set the calculated score into the hidden input field
        document.getElementById('note').value = score;

        // Submit the player form
        document.getElementById('playerForm').submit();
    }

    function calculateScore() {
        var score = 0;
        var questions = 9;
        for (var i = 1; i <= questions; i++) {
            var answer = document.querySelector('input[name="q' + i + '"]:checked');
            if (answer && answer.value === "a") score++;
        }
        return score;
    }
</script>
</body>
</html>
