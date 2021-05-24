@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="acc-container">
            <?php
            $coins = $user['coins'];
            if (session('bet') >= 2) {
                $coins = $user['coins'] - session('bet');
            }?>

            <h1>Make a bet below!</h1>
            <hr class="hr-two">
            <p>Your amount of coins: </p>
            <span style="text-align: center">
                <img style="height: 60px;padding: 0.3em" src="{{ URL::asset('images/coin.jpg')}}">
                <p style="font-size: 1.7em; font-weight: bolder">{{ $coins }}</p>
            </span>
            @if(session('bet') >= 2)
            @php
            $coins = $user['coins'] - session('bet');
            @endphp
            <br>
            <p>Your bet: </p>
            <span style="text-align: center">
                <img style="height: 60px;padding: 0.3em" src="{{ URL::asset('images/coin.jpg')}}">
                <p style="font-size: 1.7em; font-weight: bolder">{{ session('bet') }}</p>
            </span>
            @elseif( $user['coins'] > 0 && session('score') == 0)
                <p style="font-size: 1rem; color: red">If you don't bet and win, you will gain 1 coin.</p>
                <br>
                <form action="{{ url('/game') }}" method="post">
                    @csrf
                    <label for="bet">Amount of coins:  </label>
                    <input type="number" style:"margin-left: 10px" name="bet" min="2" max="{{ $user['coins'] }}" required><br>
                    <input class="start" style:"width: 100%" type="submit" name="action" value="BET">
                </form>

            @else
                <p class="score-msg">You can minimum bet 2 coins and maximum bet the amount you have.</p>
            @endif
        </div>

        <div class="game-container">
            <?php
            $current = session('score');
            $current += (int)$sum;
            session(['score' => $current]);
            $total = session('score');
            $status = "Total score: " . $total;
            ?>

            <div class="g-one">
                <p>Rounds won:</p>
                <p>You: <?= session('user') ?></p>
                <p>Computer: <?= session('computer') ?></p>
            </div>

            <div class="g-two">
                @foreach ($result as $res)
                    @php
                        $img = "images/" . $res . ".jpg"
                    @endphp
                    <img style="height: 110px" src="{{ URL::asset($img)}}" alt="Image"/>
                @endforeach
                <h1><?= $message ?></h1><br>


            </div>

            <div class="g-three">
                @if ($compScore)
                    <p>Computers score: <?= $compScore ?></p>
                @else
                    <p><?= $status ?></p>
                @endif
            </div>

            <div class="g-four">
                @if (session('score') == 0)
                <form action="{{ url('/game') }}" method="post">
                    @csrf
                    <input class="button" type="submit" name="action" value="New round">
                </form>
                <br>
                <form action="{{ url('/game') }}" method="post">
                    @csrf
                    <input class="button" type="submit" name="action" value="End game">
                </form>
                <br>
                @endif
            </div>

            <div class="g-six">
                @if ($total < 21)
                <form action="{{ url('/game') }}" method="post">
                    @csrf
                    <input class="button" type="submit" name="action" value="Roll">
                </form>
                @endif
                <br>
                <form action="{{ url('/game') }}" method="post">
                    @csrf
                    <input type="hidden" name="score" value="<?= $total ?>">
                    <input class="button" type="submit" name="action" value="Stop">
                </form>
            </div>

        </div>

        <div style="margin-right: 0; margin-left: 2em" class="acc-container">
            <h1>Your winning statistics:</h1>
            <hr class="hr-thr">
            <p style="font-size: 1.1rem">Throw 21</p>
            <div class="bar">
              <div class="stats u-o" style="width: {{ $stats['user21'] }}">{{ $stats['user21'] }}</div>
            </div>

            <p style="font-size: 1.1rem">Winning statistic</p>
            <div class="bar">
              <div class="stats u-t" style="width: {{ $stats['userWins'] }}">{{ $stats['userWins'] }}</div>
            </div>
            <br>
            <h1>All Users:</h1>
            <hr class="hr-thr">
            <p style="font-size: 1.1rem">Throw 21</p>
            <div class="bar">
              <div class="stats a-o" style="width: {{ $stats['all21'] }}">{{ $stats['all21'] }}</div>
            </div>

            <p style="font-size: 1.1rem">Winning statistic</p>
            <div class="bar">
              <div class="stats a-t" style="width: {{ $stats['allWins'] }}">{{ $stats['allWins'] }}</div>
            </div>
        </div>
    </div>

    <div style="text-align: center; color: #fff">
        @php
        $highscore = (session('user') - session('computer')) * 10;
        @endphp
        @if($highscore > 0)
            <br>
            <form action="{{ url('/highscores') }}" method="post">
                @csrf
                <label for="name">Your High Score: {{ $highscore }}</label>
                <input type="hidden" name="score" value="{{ $highscore }}">
                <input style="color: #000" class="button" type="submit" name="action" value="Save score">
            </form>
        @else
            <br>
            <p class="score-msg">You must have won more rounds than the computer to save your score.</p>
        @endif
    </div>
@endsection
