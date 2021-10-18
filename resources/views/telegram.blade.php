<html>
    <body>
        <h1>Telegram</h1>
@isset($access_token)
    {{$access_token}}
@endisset
        <form action="/telegram", method="post">
            <input type="text", name="access_token">
            <button type="submit">Отправить</button>
        </form>
    </body>
</html>
