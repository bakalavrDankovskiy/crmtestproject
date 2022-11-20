<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    </body>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center p-4">
        <div class="col-6 px-4">
            <h2>Страница выгрузки сделок с amocrm</h2>
            <div class="row justify-content-center align-items-center px-4">
                <a href="{{route('leads.import.save')}}" class="btn btn-success justify-content-center">Выгрузить</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <x-session_messages></x-session_messages>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" id="amo_pixel_identifier_js" async="async"
        src="https://piper.amocrm.ru/pixel/js/identifier/pixel_identifier.js"></script>
</html>
