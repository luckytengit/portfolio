@extends ("layouts.app")

@section("title", "게시판")



@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-2 pb-4">
                 ※ 글 보기
            </div>


            <div class="row p-2">

                <div class="mb-3">
                    <div class="form-label table-responsive fw-bold fs-3" id="title">
                        {{ $post->title }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-label table-responsive border-start ps-2" id="title">
                        {{ $post->user->name }}
                        <br/> {{ $post->created_at }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-control_ table-responsive" id="content" style="min-height:100px">
                        {!! clean($post->content) !!}
                    </div>
                </div>

                <div class="mb-3">

                    <!-- Update, Delete Post -->
                    <form method="POST" name="deleteFrm-{{ $post->id }}" id="deleteFrm-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method("DELETE")

                        <input type="hidden" name="board_id" id="board_id" value="{{ $post->board_id }}">

                        @can(['update', 'delete'], $post)
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">수정</a>
                            <button type="button" class="btn btn-danger btn-sm btnDelete" data-name="{{ $post->id}}">삭제</button>
                        @endcan

                        <a href="{{ route('boards.posts.index', $post->board) }}" class="btn btn-primary btn-sm">목록</a>
                    </form>


                </div>
            </div>

        </div> <!-- container -->
    </section>

@endsection

