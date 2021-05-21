@extends('layouts.app')

@section('content')
    <div class="content">
      <div class="large-container">
        <div class="container">
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


        </div>
      </div>
    </div>
@endsection
