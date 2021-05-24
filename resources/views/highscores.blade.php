@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container" style="text-align: center">
            <h1 style="color:#333">Top 10 Richest Users</h1>
            <br><hr class="hr-two"><br>
            @php
                $rank = 1
            @endphp
            <table style="width:100%">
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Coins</th>
                </tr>
                @foreach ($users as $user)
                    <tr style="text-align: center">
                        <td>{{ $rank }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['coins'] }}</td>
                    </tr>
                    @php
                        $rank += 1
                    @endphp
                @endforeach
            </table>
        </div>
        <div class="container" style="text-align: center">
            <h1 style="color:#333">Game 21 Top 10 High Scores</h1>
            <br><hr class="hr-two"><br>
            @php
                $rank = 1
            @endphp
            <table style="width:100%">
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
                @foreach ($scores as $score)
                    <tr style="text-align: center">
                        <td>{{ $rank }}</td>
                        <td>{{ $score['username'] }}</td>
                        <td>{{ $score['score'] }}</td>
                        <td>{{ $score['created_at'] }}</td>
                    </tr>
                    @php
                        $rank += 1
                    @endphp
                @endforeach
            </table>
        </div>
    </div>
@endsection
