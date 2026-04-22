@extends ("layouts.app")

@section("title", "포트폴리오 리스트")



@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-1">
                ※ 경력 내역
            </div>

            <div class="p-1">
                @foreach($experience as $item)

                    <div class="row p-2">
                        <div class="col-md-4 p-2">
                            @if (!empty($item->attachments[0]))

                                <a href="{{ $item->attachments[0]->link }}" target="_blank">
                                    <img src="{{ $item->attachments[0]->link }}" style="width:100%">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-8 p-2 border-bottom border-secondary">
                            <p>
                                <!-- 제목 -->
                                프로젝트명:
                                <b>
                                    {{ $item->subject }}

                                </b>
                            </p>

                            {!! $item->content !!}

                            <div>
                                @if ($isSiteAdmin)
                                    <form method="POST" name="deleteFrm" action="{{ route('experience.destroy', $item->id) }}">
                                        @csrf
                                        @method("DELETE")

                                        <a class="btn btn-primary btn-sm" href="{{ route('experience.edit', ['experience' => $item->id]) }}">수정</a>
                                        <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="p-1">
                @if ($isSiteAdmin)

                    <a class="btn btn-primary btn-sm" href="{{ route('experience.create') }}"> 등록 </a>
                @endif

            </div>

        </div> <!-- container -->
    </section>

@endsection

