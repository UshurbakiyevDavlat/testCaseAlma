@php
 use App\Http\Controllers\AuthController;
{{ AuthController::logout(); }}
@endphp
<div>
    <form action="registrationform" method="get">
        <input type="submit" value="Регистрация">
    </form>

    <form action="authorizationform" method="get">
        <input type="submit" value="Авторизация">
    </form>
</div>
