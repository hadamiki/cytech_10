<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自動販売機管理システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('CSS/style.css')}}">
    <!-- ★CSSを外部読み込みさせる★ -->

</head>
<body>
    <div class="app-container">
        @yield('content')
    </div>
</body>
</html>