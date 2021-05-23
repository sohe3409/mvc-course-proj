<!doctype html>
<html>
    <meta charset="utf-8">
    <title>Game app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= url("/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav>
        <ul>
          <li>
            <a href="{{ route('game') }}">Game 21</a>
          </li>
          <li>
              <a href="{{ route('highscores') }}">High Scores</a>
          </li>
        </ul>
        @if (session('account'))
        <form style="float: right" action="{{ url('/login') }}" method="post">
          @csrf
          <input class="logout" type="submit" name="action" value="Logout">
        </form>
        @else
            <a style="text-align: center; height: 50px" class="logout" href="{{ route('login') }}">Login</a>
        @endif
    </nav>
    @yield('content')
    <footer>
        <p>Game 21 Online Betting ©</p>
    </footer>
</body>
</html>
