<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Study App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <div class="navbar">
    <div class="nav-left-item">
      <a href="/">Study App</a> 
      @if(Auth::check())
      | 
      <a href="/category"> カテゴリー</a>
      @endif
    </div>
    <div class="nav-right-item">
      @if(Auth::check())
      <span class="welcome">ようこそ、{{ Auth::user()->name }}さん |</span>
      <a href="#" id="logout">ログアウト</a>
      <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf
      </form>
      @else
      <a href="{{ route('login') }}">ログイン</a>
      |
      <a href="{{ route('register') }}">会員登録</a>
      @endif
    </div>
  </div>
</header>

<main>
@yield('content')
</main>
@if(Auth::check())
<script>
  document.getElementById('logout').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
  });
</script>
@endif
@yield('script')
</body>
</html>