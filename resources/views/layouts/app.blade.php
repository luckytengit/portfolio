<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}/">Sangho KIM</a>

            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                @auth

                    <li class="nav-item">
                        <div class="nav-link text-white">
                            ( {{ auth()->user()->name }}님 반갑습니다 )
                        </div>
                    </li>
                @endauth

                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('experience.index')}}">포트폴리오</a></li>
                <li class="nav-item"><a class="nav-link" href="https://github.com/luckytengit" target="_blank">GitHub</a></li>
                <li class="nav-item"><a class="nav-link" href="#">게시판</a></li>
                <li class="nav-item"><a class="nav-link" href="https://cafekimsh.cafe24.com/" target="_blank">이전포트폴리오</a></li>

                @guest

                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">회원가입</a></li>
                @endguest

                @auth

                    <li class="nav-item">
                    <a  class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        로그아웃
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>
                @endauth

            </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section style="background-color:#5f9ea0">
        <div class="container">

            <div class="text-center row pt-4" style="height:150px;">
                <div class="align-self-center">
                    <h2 class="lead text-white fw-bold">포 트 폴 리 오</h2>
                </div>
            </div>

            <div class="text-left">
                <p class="fs-7 text-white text-opacity-75">*본 페이지는 라라벨(Laravel) 프레임워크로 작업되었습니다.</p>
            </div>
        </div>
    </section>

    <!-- Content Title -->
    <section class="py-3">
        <div class="container">
            <div class="text-left fs-4 fw-bold">
                @yield('title')

            </div>
        </div>
    </section>


    <!-- Contents -->
    @yield('content')


    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <div>Email ksh51999@daum.net</div>
        <p>© 2026 Sangho KIM. All rights reserved.</p>
    </footer>

</body>
</html>
