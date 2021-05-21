@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container" style="text-align: center">
            <h1>Game 21 Top 10 High Scores</h1>
            <br>
            @php
                $rank = 1
            @endphp
            <table style="width:100%">
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Coins</th>
                </tr>
                @foreach ($scores as $score)
                    <tr style="text-align: center">
                        <td>{{ $rank }}</td>
                        <td>{{ $score['username'] }}</td>
                        <td>{{ $score['coins'] }}</td>
                    </tr>
                    @php
                        $rank += 1
                    @endphp
                @endforeach
            </table>
        </div>
    </div>
@endsection
