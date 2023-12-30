@extends('dashBoard')

@section('content')
    <style>
        body {

            font-family: Arial, sans-serif;
            background-color: #30312C;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
        }

        h5 {
            text-align: center;
            margin-bottom: 20px;
            color: #AEFF00;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #FFFFFF;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #AEFF00;
            color: #30312C;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #99D200;
        }

        .error {
            color: #FF0000;
        }
    </style>

    <div class="container" style="background-color: #1a202c">
        <h5>Admin Registration</h5>
        <form action="{{route('CustomRegister')}}" method="POST" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span class="error" id="passwordError"></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Create Account">
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var passwordError = document.getElementById("passwordError");

            if (password !== confirmPassword) {
                passwordError.textContent = "Passwords do not match";
                return false;
            } else {
                passwordError.textContent = "";
                return true;
            }
        }
    </script>
@endsection
