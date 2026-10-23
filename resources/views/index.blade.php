<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js" data-splide-script></script>

    @vite(['resources/styles/main.css', 'resources/app/main.js'])

    <script>
        window.AppConfig = {
            name: '{{ env('APP_NAME') }}',
            logo: '{{ url('/assets/images/logo.png')  }}',
            url: '{{ env('APP_URL') }}',
            csrf: '{{ csrf_token() }}',
            defaultLocale: '{{ env('APP_LOCALE', 'en') }}',
            defaultTimezone: '{{ env('APP_TIMEZONE', 'UTC') }}',
            locales: {
                en: {!! json_encode(\Illuminate\Support\Facades\Lang::get('frontend', [], 'en')) !!},
            }
        }
    </script>
</head>

<body>
<noscript>
    <strong>We're sorry but this application doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>

<div id="app"></div>

</body>

</html>
