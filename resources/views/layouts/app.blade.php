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
                <li class="nav-item"><a class="nav-link" href="#">포트폴리오</a></li>
                <li class="nav-item"><a class="nav-link" href="#">게시판</a></li>

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

            <!-- <button class="btn btn-primary btn-lg">시작하기</button> -->
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


    <!-- Feature Section
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="images/feature1.jpg" class="card-img-top" alt="기능 1" />
                        <div class="card-body">
                            <h5 class="card-title">기능 1</h5>
                            <p class="card-text">
                            이 텍스트는 부트스트랩 카드 컴포넌트를 통해 깔끔하게 꾸며집니다.
                            </p>
                            <a href="#" class="btn btn-outline-primary">자세히 보기</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="images/feature2.jpg" class="card-img-top" alt="기능 2" />
                        <div class="card-body">
                            <h5 class="card-title">기능 2</h5>
                            <p class="card-text">
                            카드 레이아웃으로 반응형 기능을 손쉽게 적용할 수 있습니다.
                            </p>
                            <a href="#" class="btn btn-outline-secondary">자세히 보기</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="images/feature3.jpg" class="card-img-top" alt="기능 3" />
                        <div class="card-body">
                            <h5 class="card-title">기능 3</h5>
                            <p class="card-text">
                            모바일, 태블릿, 데스크톱에서도 최적화된 UI를 제공합니다.
                            </p>
                            <a href="#" class="btn btn-outline-success">자세히 보기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->


    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
      <p>© 2026 Sangho KIM. All rights reserved.</p>
    </footer>

</body>
</html>
