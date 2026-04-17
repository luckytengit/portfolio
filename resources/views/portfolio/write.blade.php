@extends ("layouts.app")

@section("title", "포트폴리오 등록")



@section("content")
    <section class="py-3" style="min-height: 500px">
        <div class="container">
            <div class="p-2 pb-4">
                ※ 경력을 등록해 주십시오.
            </div>

            <form method="POST" name="experienceFrm" id="experienceFrm" action="{{ $formActionUrl }}">
                @csrf

                @if ($experience->id)
                    @method("PUT")
                @endif

                <input type="hidden" name="id" id="id" value="{{ $experience->id }}">
                <div class="row p-2">

                    <div class="mb-3">
                        <label for="subject" class="form-label">프로젝트 제목(Subject)</label>
                        <input type="text" name="subject" value="{{ old("subject", $experience->subject) }}" class="form-control" id="subject" placeholder="프로젝트 제목을 입력해주십시오.">
                    </div>

                    <div class="mb-3">
                        <label for="filename" class="form-label">이미지</label>
                        <input type="file" name="filename" class="form-control" id="filename">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">본문 내용</label>
                        @include ('editor::default', ['name'=>'content', 'id'=>'content', 'value'=>old("subject", $experience->content), 'attr'=>['rows'=>'15', 'style'=>'width:100%']])
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
                        @if ($isSiteAdmin)
                        <button type="button" id="saveBtn" class="btn btn-primary btn-sm">등록</button>
                        @endif
                    </div>
                </div>

            </form>

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
                    const saveBtn = document.querySelector("#saveBtn");
                    saveBtn.addEventListener("click", saveFn, false);

                });

                /**
                 * 등록 버튼 처리 이벤트
                 */
                function saveFn() {
                    // checking
                    if (!document.getElementById("subject").value) {
                        alert("프로젝트 제목을 입력해 주십시오.");
                        return;
                    }

                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
                    console.log(document.getElementById("content"))
                    if (!document.getElementById("content").value) {
                        alert("내용을 입력해 주십시오.");
                        return;
                    }

                    // 에디터의 내용을 textarea에 적용
                    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

                    document.getElementById("experienceFrm").submit();
                }
            </script>

        </div> <!-- container -->
    </section>

@endsection

