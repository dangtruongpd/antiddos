<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

    <div>
        @if (Session::has('recaptcha_failed'))
            {{ Session::get('recaptcha_failed') }}
        @endif
    </div>


    <form action="{{ route('captcha.check') }}" method="POST">
        @csrf
        <div class="g-recaptcha" data-sitekey="6Lc-UPsgAAAAAGcbFrdLdak367GGVjZ1RapR7eAr"></div>
        <button type="submit">Submit</button>
    </form>

</body>

</html>
