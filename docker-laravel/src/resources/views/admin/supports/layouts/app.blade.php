<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle') - {{config('app.name')}}</title>


</head>
<body>
    <section class="container px-4 mx-auto">
        <head>
            @yield('header')
        </head>

        <div class="c">
            @yield('content')
        </div>

    </section>
</body>
</html>
