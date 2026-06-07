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
                        </div>

                        <div class="col-md-2 p-2">

                            {{ $item->created_at }}

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


