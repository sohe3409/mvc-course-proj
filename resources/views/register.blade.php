@extends('layouts.app')

@section('content')

<div class="content">
    <div class="large-container" style="background: url({{ URL::asset('images/coins.jpg')}})">
        <div class="cover">
              <!-- Registration-->
              <h2 style="font-size: 1.7em; font-weight: bolder">Registrera dig</h2>
              <br>
                <form class="reg">

                      <label>Enter Username</label>
                      <input type="text" class="form-control">

                      <label>Enter Password</label>
                      <input type="password" class="form-control">


                      <label>Confirm Password</label>
                      <input type="password" class="form-control">

                    <button type="submit" name="action" value="reg" class="btn">Register</button>
                </form>
        </div>
        <hr>
        <div class="cover">
              <!-- Login-->
              <h2 style="font-size: 1.7em; font-weight: bolder">Logga in</h2>
              <br>
                <form class="login">

                      <label>Enter Username</label>
                      <input type="text">

                      <label>Enter Password</label>
                      <input type="password" class="form-control">

                    <button "type="submit" name="action" value="login" class="btn">Login</button>
                </form>
        </div>
      </div>
</div>
@endsection
