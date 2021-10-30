@extends('template')

@section('title', 'Telegram')
@section('content-title', 'Telegram')

@section('body')
    <div class="include_files">
        <script src="js/telegram/request_helper.js"></script>
        <link rel="stylesheet" href="css/telegram.css">
    </div>

    @parent

    <div class="telegram-api">
        <div class="telegram-api__left-block">
            <div class="left-block__auth">
                @if(! empty($telegram_bot_username))
                    <div class="access-token__container">
                        <div class="telegram-access-token">{{$telegram_bot_username}}</div>
                        <button class="button js-clear-auth-telegram">Clear</button>
                    </div>
                @else
                    <div class="not-access-token__container">
                        <input type="text" class="js-auth-input"/>
                        <button class="button js-auth-telegram">Auth</button>
                    </div>
                @endif
            </div>
            <div class="left-block__get-me">
                @if($is_auth_telegram)
                    <button class="button js-getMe">Get BotInfo</button>
                @endif
            </div>
        </div>

        <div class="telegram-api__right-block">
            <div class="right-block__response">

            </div>
        </div>
    </div>

@endsection
