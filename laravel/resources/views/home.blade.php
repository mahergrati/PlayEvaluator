<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 115vh;
        }

        /* Bordered form container */
        .form-container {
            width: 90%;
            max-width: 900px;
            display: flex;
            justify-content: space-around;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .container, .container1 {
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
            display: none; /* Initially hide both forms */
        }

        /* Full-width inputs */
        input[type=text], input[type=password], input[type=date], input[type=email] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Style for all buttons */
        button {
            background-color: #28a745;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        /* Add a hover effect for buttons */
        button:hover {
            background-color: #218838;
        }

        /* Extra style for the cancel button (red) */
        .cancelbtn {
            background-color: #dc3545;
        }

        /* Center the avatar image inside this container */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        /* Avatar image */
        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        /* Add padding to containers */
        .container, .container1 {
            padding: 20px;
        }

        /* The "Forgot password" text */
        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }

        /* Button styling */
        .toggle-btn {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .toggle-btn button {
            background-color: #007bff;
            color: white;
            width: auto;
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid rgba(0, 0, 0, 0.6);
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .toggle-btn button:hover {
            transform: scale(1.05);
        }
    </style>
    <script>
        function toggleForms() {
            var loginForm = document.querySelector('.container1');
            var registerForm = document.querySelector('.container');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }
    </script>
</head>
<body>
@auth
    <p>Congratulations, you have logged in!</p>
    <form method="POST" action="/logout">
        @csrf
        <button class="logout-btn">Log out</button>
    </form>
@else
    <div class="form-container">
        <div class="container">
            <form action="/register" method="POST">
                @csrf
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter your name" name="name" required>

                <label for="lastname"><b>Lastname</b></label>
                <input type="text" placeholder="Enter your last name" name="lastname" required>

                <label for="birthday"><b>Birthday</b></label>
                <input type="date" name="birthday" required>

                <label for="cin"><b>CIN</b></label>
                <input type="text" placeholder="Enter CIN" name="cin" required>

                <label for="phone_number"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone_number" required>

                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter your email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="role"><b>Role</b></label>
                <input type="text" placeholder="Enter Role" name="role" required>

                <button type="submit">Register</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </form>
        </div>
        <div class="container1">
            <form action="/login" method="POST">
                @csrf
                <label for="loginemail"><b>Email</b></label>
                <input type="email" placeholder="Enter your email" name="loginemail" required>

                <label for="loginpassword"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="loginpassword" required>

                <button type="submit">Log in</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </form>
            <div class="toggle-btn">
                <button onclick="toggleForms()">Login/Register</button>
            </div>
        </div>
    </div>

@endauth
<script>
    // Initially display the login form
    document.querySelector('.container1').style.display = 'block';
</script>
</body>
</html>
