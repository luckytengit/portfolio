@extends ("layouts.app")

@section("title", "게시판관리")



@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-2 pb-4">
                @if ($board->name)
                    ※ 수정
                @else
                    ※ 등록
                @endif
            </div>

            <form method="POST" name="boardFrm" id="boardFrm" action="{{ $formActionUrl }}">
                @csrf

                @if ($board->name)
                    @method("PUT")
                @endif

                <input type="hidden" name="id" id="id" value="{{ $board->name }}">
                <div class="row p-2">

                    <div class="mb-3">
                        <label for="subject" class="form-label">게시판 코드</label>
                        <input type="text" name="name" value="{{ old("name", $board->name) }}" class="form-control" id="subject" {{ $nameReadonly }} placeholder="게시판 코드를 입력해주십시오.">
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">게시판 이름</label>
                        <input type="text" name="display_name" value="{{ old("display_name", $board->display_name) }}" class="form-control" id="subject" placeholder="게시판 이름을 입력해주십시오.">
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
                        <button type="submit" id="saveBtn" class="btn btn-primary btn-sm">
                            @if ($board->name)
                                수정
                            @else
                                등록
                            @endif
                        </button>
                        <a href="{{ route('boards.index') }}" class="btn btn-primary btn-sm">취소</a>
                    </div>
                </div>

            </form>

        </div> <!-- container -->
    </section>

@endsection

