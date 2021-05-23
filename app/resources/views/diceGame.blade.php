@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="acc-container">
            <h1>Make a bet below!</h1>
            <hr class="hr-two">
            <p>Your amount of coins: </p>
            <span class="coins">
                <img style="height: 60px; margin-right: 3px; padding: 0.3em" src="{{ URL::asset('images/coin.jpg')}}">
                <p style="font-size: 1.7em; font-weight: bolder">{{ $user['coins'] }}</p>
            </span>
            @if( $user['coins'] > 0)
                <br>
                <form action="{{ url('/highscores') }}" method="post">
                    @csrf
                    <label for="bet">Amount of coins:  </label>
                    <input type="number" style:"margin-left: 10px" name="bet" min="1" max="{{ $user['coins'] }}" required><br>

                    <input class="start" style:"width: 100%" type="submit" name="action" value="BET">
                </form>
            @else
                <p class="score-msg">You must have won more rounds than the computer to save your score.</p>
            @endif
        </div>
        <div class="game-container">
            <?php
            $current = session('score');
            $current += (int)$sum;
            session(['score' => $current]);
            $total = session('score');
            if ($total > 21) {
                $status = "Your score: " . $total . "<br> You lost!";
                $current = session('computer');
                $current += 1;
                session(['computer' => $current]);
            } else if ($total === 21) {
                $status = "Your score: " . $total . "<br>Congratulations, you won!";
                $current = session('user');
                $current += 1;
                session(['user' => $current]);
            } else {
                $status = "Total score: " . $total;
            }?>
            <div class="result">
                @foreach ($result as $res)
                    @php
                        $img = "images/" . $res . ".jpg"
                    @endphp
                    <img class:"die" src="{{ URL::asset($img)}}" alt="Image"/>
                @endforeach
                <p><?= $status ?></p>
                <p><?= $message ?></p>
            </div>


            <form action="{{ url('/game') }}" method="post">
                @csrf
                <input class="button" type="submit" name="action" value="Roll again">
            </form>
            <br>
            <form action="{{ url('/game') }}" method="post">
                @csrf
                <input type="hidden" name="score" value="<?= $total ?>">
                <input class="button" type="submit" name="action" value="Stop">
            </form>
            <br>
            <form action="{{ url('/game') }}" method="post">
                @csrf
                <input class="button" type="submit" name="action" value="New round">
            </form>

            <p>Rounds won:</p>
            <p>You: <?= session('user') ?></p>
            <p>Computer: <?= session('computer') ?></p>

            <form action="{{ url('/game') }}" method="post">
                @csrf
                <input class="button" type="submit" name="action" value="End game">
            </form>
            <br>
            <div>
                @php
                $highscore = (session('user') - session('computer')) * 10;
                @endphp
                @if($highscore > 0)
                    <br>
                    <form action="{{ url('/highscores') }}" method="post">
                        @csrf
                        <label for="name">Your name: </label>
                        <input type="text" id="username" name="username" minlength="3" maxlength="10" required>
                        <input type="hidden" name="coins" value="{{ $highscore }}">
                        <input class="button" type="submit" name="action" value="Save score">
                    </form>
                @else
                    <br>
                    <p class="score-msg">You must have won more rounds than the computer to save your score.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
