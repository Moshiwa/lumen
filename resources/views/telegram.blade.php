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
                    <div class="telegram-access-token">Connected!</div>
                    <div class="access-token__container">
                        <button class="button js-clear-auth-telegram">Clear</button>
                    </div>
                @else
                    <div class="telegram-access-token">Disconnected!</div>
                    <div class="not-access-token__container">
                        <input type="text" class="js-auth-input"/>
                        <button class="button js-auth-telegram">Auth</button>
                    </div>
                @endif
            </div>
            @if($is_auth_telegram)
                <div class="left-block__get-me">
                    <button class="button js-getMe">Get BotInfo</button>
                </div>
                <div class="left-block__set-webhook">
                    <button class="button js-setWebhook">Get BotInfo</button>
                </div>
                {{--<div class="left-block__send-message">
                    <button class="button js-send-message">Send msg</button>
                </div>--}}
            @endif
        </div>

        <div class="telegram-api__right-block">
            <div class="right-block__response">

            </div>
        </div>
    </div>

@endsection
