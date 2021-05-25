@extends('layouts.app')

@section('content')
<div class="content">
    @if(session('account'))
    <div class="acc-container">
        <h1>Welcome {{ $user['username'] }}!</h1>
        <hr class="hr-two">
        <p>Your amount of coins: </p>
        <span style="text-align: center">
            <img style="height: 60px; margin-right: 3px; padding: 0.3em" src="{{ URL::asset('images/coin.jpg')}}">
            <p style="font-size: 1.7em; font-weight: bolder">{{ $user['coins'] }}</p>
        </span>
        <p>You can gain coins by playing Game 21 and make bets against the computer.</p>
        <br>
        <p>You can also save your score to make it to the top 10 high Scores list.</p>

    </div>

    <div class="container-start">
        <p style="color: #eee">{{ $message }}</p>
        <br>
        <form action="{{ url('/game') }}" method="post">
            @csrf
            <div class='section'>
              <div class='container-radio'>
                  <input type="radio" name="dices" id="one" value="1" required>
                  <label class="one" for="one">1</label>
                  <input type="radio" name="dices" id="two" value="2" required>
                  <label class="two" for="two">2</label>
              </div>
            </div>
            <input class="start" type="submit" name="action" value="Start!">
        </form>
    </div>
    @else
    <div class="container">
        <p>Logga in!</p>
    </div>
    @endif
</div>
@endsection
