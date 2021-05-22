@extends('layouts.app')

@section('content')

<div class="content">

    @foreach ($errors->all() as $error)
        <p style="color: #fff">{{ $error }}</p>
    @endforeach

    <div class="large-container" style="background: url({{ URL::asset('images/coins.jpg')}})">
        <div class="cover">
              <!-- Login-->
              <h2 style="font-size: 1.7em; color: #333; font-weight: bolder">Login</h2>
              <br>
                <form class="login" method="post" action="{{ url('/login') }}">
                    @csrf
                    <label>Enter Username</label>
                    <input type="text" maxlength="15" minlength="3" name="username" required>

                    <label>Enter Password</label>
                    <input type="password" type="password" name="password" required>

                    <button type="submit" name="action" value="login" class="btn">Login</button>
                </form>
        </div>
        <hr class="logreg">
        <div class="cover">
              <!-- Registration-->
              <h2 style="font-size: 1.7em; color: #333; font-weight: bolder">Register</h2>
              <br>
                <form class="reg" method="post" action="{{ url('/login') }}">
                    @csrf
                    <label>Enter Username</label>
                    <input type="text" maxlength="15" minlength="3" name="username" required>

                    <label>Enter Password</label>
                    <input type="password" type="password" name="password" required>

                    <label>Confirm Password</label>
                    <input type="password" type="password" name="confirm" required>

                    <button type="submit" name="action" value="reg" class="btn">Register</button>
                </form>
        </div>
    </div>
</div>
@endsection
