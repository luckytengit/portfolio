@extends ("layouts.app")

@section("title", "게시판")

@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-1">
                ※ 목록
            </div>

            <div class="p-1">
                <div class="row p-2 border-bottom border-secondary bg-body-secondary">
                    <div class="col-md-1 p-2 text-center">
                        No
                    </div>
                    <div class="col-md-9 p-2 text-center">
                        제목
                    </div>
                    <div class="col-md-2 p-2 text-center">
                        날짜
                    </div>
                </div>

                @foreach($posts as $item)

                    <div class="row p-2 border-bottom border-secondary">
                        <div class="col-md-1 p-2">
                            {{ $posts->total() - $posts->firstItem() - $loop->index + 1 }}
                        </div>
                        <div class="col-md-9 p-2">

                            <a href="{{ route('posts.show', $item) }}">
                                {{ $item->title }}
                            </a>

                            @if ($item->is_secret === true)

                                <!-- 비밀글 마크 -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:15px">
                                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                                </svg>

                            @endif

                        </div>

                        <div class="col-md-2 p-2">
                            {{ $item->created_at->format('Y-m-d') }}
                        </div>
                    </div>
                @endforeach

                <div class="row p-2">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="p-1">

                <a class="btn btn-primary btn-sm" href="{{ route('boards.posts.create', $board) }}"> 등록 </a>

            </div>

        </div> <!-- container -->
    </section>

@endsection


