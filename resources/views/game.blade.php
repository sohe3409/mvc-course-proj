@extends('layouts.app')

@section('content')
<div class="content">
    @if(session('account'))
    <div class="container">



    </div>

    <div class="container">
        <p></p>
        <form action="{{ url('/game') }}" method="post">
            @csrf
            <input type="radio" name="dices" value="1" required>
            <label for="dices">1</label>
            <input type="radio" name="dices" value="2" required>
            <label for="dices">2</label>
            <input class="button" type="submit" name="action" value="Start!">
        </form>
    </div>
    @else
    <div class="container">
        <p>Logga in!</p>
    </div>
    @endif



</div>
@endsection
