@extends ("layouts.app")

@section("title", "로그인")



@section("content")
    <section class="py-3" style="height: 500px">
        <div class="container">
            <div class="p-1">
                &#8251; 로그인해 주십시오.
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="row p-2">
                    <div class="mb-3">
                        <label for="email" class="form-label">이메일</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="이메일을 입력해주십시오.">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">비밀번호</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="비밀번호를 입력해주십시오.">
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

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm">로그인</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

