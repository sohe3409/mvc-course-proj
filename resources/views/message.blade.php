@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <p><?=var_dump( $message) ?></p>
            <!-- <p><?=var_dump( $messaget) ?></p> -->
            <!-- <p>{{ var_dump(Session::all()) }}</p> -->
        </div>
    </div>
@endsection
