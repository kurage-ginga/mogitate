<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'mogitate')</title>
        <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        @yield('css')
    </head>

    <body class="body">
        <header class="header">
            <div class="header__inner">
                <h1 class="header__logo" href="/">
                    <a href="{{ route('products.index') }}">mogitate</a>
                </h1>
                <nav>
                    <a href="{{ route('products.index') }}" class="header__show">商品一覧</a>
                    <a href="{{ route('products.create') }}" class="header__link">＋商品を追加</a>
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </body>

</html>
