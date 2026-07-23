@extends ("layouts.app")

@section("title", "")



@section("content")
    <section class="py-3" style="height: 500px">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                    <div class="card login-card p-4">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4 fw-bold text-dark">로그인</h3>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label text-secondary small">이메일 주소</label>
                                    <input type="email" name="email" class="form-control" id="emailInput" value="{{ old('email') }}" placeholder="example@email.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="passwordInput" class="form-label text-secondary small">비밀번호</label>
                                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="비밀번호 입력" required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    {{-- <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe">
                                        <label class="form-check-label text-secondary small" for="rememberMe">로그인 유지</label>
                                    </div>
                                    <a href="#" class="text-decoration-none small text-primary">비밀번호 찾기</a> --}}
                                </div>

                            <div class="text-danger">
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary py-2 fw-semibold">로그인</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

