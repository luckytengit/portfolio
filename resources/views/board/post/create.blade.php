@extends ("layouts.app")

@section("title", "게시판 등록/수정")



@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-2 pb-4">
                @if ($post->id)
                    ※ 글 수정
                @else
                    ※ 글 등록
                @endif
            </div>

            <form method="POST" name="boardFrm" id="boardFrm" action="{{ $formActionUrl }}">
                @csrf

                @if ($post->id)
                    @method("PUT")
                @endif

                <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                <input type="hidden" name="board_id" id="board_id" value="{{ $post->board_id }}">

                <div class="row p-2">

                    <div class="mb-3">
                        <label for="title" class="form-label text-primary">글 제목 </label>
                        <input type="text" name="title" value="{{ old("title", $post->title) }}" class="form-control" id="title" placeholder="글 제목을 입력해주십시오.">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label text-primary">본문</label>
                        <textarea type="text" name="content" class="form-control" id="content" style="min-height:400px;width:100%">
                            {{ old("content", $post->content) }}
                        </textarea>
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
                        <button type="button" id="saveBtn" class="btn btn-primary btn-sm">
                            @if ($post->id)
                                수정
                            @else
                                등록
                            @endif
                        </button>
                        <a href="{{ route('boards.posts.index', $board) }}" class="btn btn-primary btn-sm">취소</a>
                    </div>
                </div>

            </form>

        </div> <!-- container -->
    </section>

    <!-- For smart-editor -->
    <script src="{{ $editorPath }}plugins/editor/smart-editor/js/service/HuskyEZCreator.js"></script>
    <script>
        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "content",
            sSkinURI: "{{ $editorPath }}plugins/editor/smart-editor/SmartEditor2Skin.html",
            fCreator: "createSEditor2"
        });

        /**
         * 이벤트 등록
         */
        document.addEventListener("DOMContentLoaded", function() {
            // 저장 버튼 이벤트
            const saveBtn = document.querySelector("#saveBtn");
            saveBtn.addEventListener("click", saveFn, false);

            // 파일첨부 삭제 버튼 이벤트
            const fileDelContainer = document.querySelectorAll(".attachmentDelBtn");

            fileDelContainer.forEach(item => {
                item.addEventListener("click", (e) => {

                    const clickedItem = e.target.closest('[data-id]');

                    let dataId = 0;
                    if (clickedItem) {
                        dataId = clickedItem.dataset.id;
                    }

                    fileDelFn(dataId);
                });
            });
        });

        /**
         * 등록 버튼 처리 이벤트
         */
        function saveFn() {
            // checking
            if (!document.getElementById("title").value) {
                alert("프로젝트 제목을 입력해 주십시오.");
                return;
            }

            // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
            if (!document.getElementById("content").value) {
                alert("내용을 입력해 주십시오.");
                return;
            }

            // 에디터의 내용을 textarea에 적용
            oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

            document.getElementById("boardFrm").submit();
        }

        /**
         * 파일 첨부 버튼 처리 이벤트
         */
        function fileDelFn(id) {
            let fileFrm = document.getElementById("fileDelFrm");
            fileFrm.action = "{{ route('index') }}/attachments/" + id;

            document.getElementById("fileDelFrm").submit();
        }
    </script>

@endsection

