@extends ("layouts.app")

@section("title", "게시판관리")

@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-1">
                ※ 목록
            </div>

            <div class="p-1">
                <div class="row p-2 border-bottom border-secondary bg-body-secondary">
                    <div class="col-md-1 p-2">
                        No
                    </div>
                    <div class="col-md-3 p-2">
                        게시판 ID
                    </div>
                    <div class="col-md-6 p-2">
                        게시판명
                    </div>
                    <div class="col-md-2 p-2">
                    </div>
                </div>

                @foreach($boards as $item)

                    <div class="row p-2 border-bottom border-secondary">
                        <div class="col-md-1 p-2">
                            {{ $boards->total() - $boards->firstItem() - $loop->index + 1 }}
                        </div>
                        <div class="col-md-3 p-2">
                            {{ $item->name }}
                        </div>
                        <div class="col-md-6 p-2">
                            {{ $item->display_name }}
                        </div>
                        <div class="col-md-2 p-2">

                            @can(['update', 'delete'], $boards)

                                <form method="POST" name="deleteFrm-{{ $item->name }}" id="deleteFrm-{{ $item->name }}" action="{{ route('boards.destroy', $item) }}">
                                    @csrf
                                    @method("DELETE")

                                    <a class="btn btn-primary btn-sm" href="{{ route('boards.edit', $item) }}">수정</a>

                                    <button type="button" class="btn btn-danger btn-sm btnDelete" data-name="{{ $item->name}}">삭제</button>
                                </form>

                            @endcan

                        </div>
                    </div>
                @endforeach

                <div class="row p-2">
                    {{ $boards->links() }}
                </div>
            </div>

            <div class="p-1">
                @can('create', $boards)

                    <a class="btn btn-primary btn-sm" href="{{ route('boards.create') }}"> 등록 </a>

                @endcan

            </div>

        </div> <!-- container -->
    </section>

@endsection


