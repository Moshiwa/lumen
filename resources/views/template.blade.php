@push('scripts')
    <script src="js/libraries/jquery-3.6.0.min.js"></script>
    <script src="js/render_helper.js"></script>
@endpush
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/layout.css">
    @stack('scripts')
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container">
            <div class="header__item first-item">
                <a href="/" class="header__link link">
                    <div class="link__shell home">
                        <div class="font-nav">Home</div>
                    </div>
                </a>
            </div>
            <div class="header__item other-item">
                <a href="/telegram" class="header__link link">
                    <div class="link__shell telegram">
                        <div class="font-nav">Telegram</div>
                    </div>
                </a>
            </div>
            <div class="header__item other-item">
                <a href="/tools" class="header__link link">
                    <div class="link__shell tools">
                        <div class="font-nav">Tools</div>
                    </div>
                </a>
            </div>
            <div class="header__item other-item">
                <a href="/" class="header__link link">
                    <div class="link__shell WTG">
                        <div class="font-nav">WTG</div>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <div class="content">
        <h1 class="content-title">@yield('content-title')</h1>
        <hr>
        @yield('body')
    </div>
    <footer class="footer">
        <div class="footer-wrapper">
            <div class="footer__column">
                <div class=""></div>
            </div>
            <div class="footer__column">

            </div>
            <div class="footer__column">

            </div>
        </div>
    </footer>
</div>

</body>
</html>
