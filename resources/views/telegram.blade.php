@extends('template')

@section('title', 'Telegram')
@section('content-title', 'Telegram')

@section('body')
    @parent

    @empty($access_token)
        <div>Save access token</div>
        <form action="/telegram", method="post">
            <input type="text", name="access_token">
            <button type="submit">Отправить</button>
        </form>
    @else
        <div>Access token: {{$access_token}}</div>

        <div class="telegram-send-message">

        </div>
    @endempty

    @empty($result)
        @if(!empty($error))
            {{$error}}
        @endif
    @else
        <h3>Telegram bot info: </h3>
        @foreach($result as $key => $val)
            <div>{{$key}}:{{$val}}</div>
        @endforeach
    @endempty
@endsection
{{--        <h1>Telegram</h1>
@isset($access_token)
    {{$access_token}}
@endisset
        <form action="/telegram", method="post">
            <input type="text", name="access_token">
            <button type="submit">Отправить</button>
        </form>--}}
