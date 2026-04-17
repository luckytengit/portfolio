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
                        <div class="col-md-4">
                            .
                        </div>
                        <div class="col-md-8 border-bottom border-secondary">
                            <p>
                                <!-- 제목 -->
                                프로젝트명:
                                <b>
                                @if ($isSiteAdmin)
                                    <a href="{{ route('experience.edit', ['experience' => $item->id]) }}">
                                    {{ $item->subject }}
                                    </a>
                                @else
                                    {{ $item->subject }}
                                @endif
                                </b>
                            </p>

                            {!! $item->content !!}
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

