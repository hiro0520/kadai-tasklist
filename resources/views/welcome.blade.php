@extends('layouts.app')

@section('content')

        <div class="center jumbotron">
            <div class="text-center">
                <h1>Tasklist</h1>
                {{-- タスク一覧へのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
@endsection