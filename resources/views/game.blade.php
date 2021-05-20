@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <p>{{ $message }}</p>

            <form action="{{ url('/game') }}" method="post">
                @csrf
                <input type="radio" name="dices" value="1" required>
                <label for="dices">1</label>
                <input type="radio" name="dices" value="2" required>
                <label for="dices">2</label>
                <input class="button" type="submit" name="action" value="Start!">
            </form>

        </div>
    </div>
@endsection
