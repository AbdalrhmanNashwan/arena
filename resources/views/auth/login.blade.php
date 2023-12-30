<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form Using HTML And CSS Only</title>
</head>
<body class="body-login" style="background-image: url('https://wallpapercave.com/wp/wp11726455.jpg')">
<div class="container" id="container">
    <div class="form-container log-in-container">
        <form method="POST" action="{{route('login')}}" class="form-login">
            @csrf
            @method('POST')
            <h1 class="h1-login">Arena</h1>
            <br>

            <span class="span-login">or use your account</span>
            <input class="input-login" type="email" name="email" placeholder="Email" />
            <input class="input-login" type="password" name="password" placeholder="Password" />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
            <button class="button-login" type="submit">Log In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">

            <div class="overlay-right overlay-panel ">
      <img src="images/arena.png">
           </div>
        </div>
    </div>
</div>
</body>
</html>
