<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Football</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <style>
    html,
    body {
      background: url('https://cdn.wallpapersafari.com/48/99/b6XmEe.jpg') no-repeat;
      background-repeat: no-repeat;
      background-size: cover;
      background-color: #123;
      color: #ffffff;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links>a {
      color: olivedrab ;
      padding: 0 25px;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration:none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }
  </style>
</head>

<body>
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
      <a href="{{ url('/home') }}">Home</a>
      @else
      <a href="{{ route('login') }}">Login</a>

      @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
      @endif
      @endauth
    </div>
    @endif

    <div class="content">
      <div class="title m-b-md">
        Football
      </div>

      <div class="links">
        <a href="{{ route('teams.index') }}">Teams</a>
        <a href="{{ route('players.index') }}">Players</a>
        <a href="{{ route('matches.index') }}">Matches</a>
        <a href="{{ route('premier.index') }}">Fixtures</a>
      </div>
    </div>
  </div>
</body>

</html>