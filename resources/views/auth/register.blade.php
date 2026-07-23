
@extends ("layouts.app")

@section("title", "")



@section("content")
    <section class="py-3" style="min-height: 600px">

        <div class="container">
            <!-- 반응형 그리드: 중앙 정렬 -->
            <div class="row justify-content-center">
                <!-- 모바일에서는 전체 넓이, 중간 화면(md)에서는 6칸, 큰 화면(lg)에서는 4칸 차지 -->
                <div class="col-md-6 col-lg-6">

                    <!-- 카드 폼 컨테이너 -->
                    <div class="card shadow-sm border-1 rounded-3">
                        <div class="card-body p-4 p-md-5">

                            <h3 class="text-center mb-4 fw-bold">회원가입</h3>

                            <form action="{{ route('register')}}" method="POST">
                                @csrf

                                <!-- 이름 입력 필드 -->
                                <div class="mb-3">
                                    <label for="userName" class="form-label text-secondary">이름</label>
                                    <input type="text" class="form-control" id="userName" name="name" value="{{ old('name') }}" placeholder="홍길동" required>
                                </div>

                                <!-- 이메일 입력 필드 -->
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label text-secondary">이메일</label>
                                    <input type="email" class="form-control" id="userEmail" name="email" value="{{ old('email') }}" placeholder="example@email.com" required>
                                </div>

                                <!-- 비밀번호 입력 필드 -->
                                <div class="mb-4">
                                    <label for="userPassword" class="form-label text-secondary">비밀번호</label>
                                    <input type="password" class="form-control" id="userPassword" name="password" value="{{ old('password') }}" placeholder="비밀번호를 입력하세요" required>
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

                                <!-- 제출 버튼 (d-grid를 사용해 100% 꽉 차는 버튼) -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">가입하기</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

