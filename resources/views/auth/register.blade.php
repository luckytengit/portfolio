
@extends ("layouts.app")

@section("title", "회원가입 폼")



@section("content")
    <section class="py-3" style="height: 500px">
        <div class="container">
            <div class="p-1">
                &#8251; 회원가입 정보를 입력해주십시오.
            </div>

            <form action="{{ route('register')}}" method="POST">
                @csrf

                <table>
                    <tr>
                        <td class="p-1">
                            이름
                        </td>
                        <td class="p-1">
                            <input type="text" name="name" value="{{ old('name') }}" >
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            이메일
                        </td>
                        <td class="p-1">
                            <input type="text" name="email" value="{{ old('email') }}" >
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            비밀번호
                        </td>
                        <td class="p-1">
                            <input type="password" name="password" value="" >
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                        </td>
                        <td class="p-1">
                            <div class="text-danger">
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                        </td>
                        <td class="p-1">
                            <button type="submit" class="btn btn-primary btn-sm">회원가입</button>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </section>
@endsection

