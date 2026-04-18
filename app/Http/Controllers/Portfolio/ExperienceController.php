<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * 내경력 메뉴 리스트 뷰단 로드
     */
    public function index() {
        return view("portfolio.list", [
            'experience' => Experience::with('user')->with('attachments')->latest()->get(),
            'isSiteAdmin' => config('app.appAdminEmail') == auth()->user()?->email,
        ]);
    }

    /**
     * 내경력 메뉴 등록 폼 로드
     */
    public function create() {
        return view("portfolio.write", [
            'experience' => (object) [
                'id' => '',
                'subject' => '',
                'content' => '',
            ],
            'editorPath' => '../',
            'isSiteAdmin' => config('app.appAdminEmail') == auth()->user()?->email,
            'formActionUrl' => route('experience.store'), // 등록 폼 Action url
        ]);
    }

    /**
     * 내경력 메뉴 등록 DB 처리
     */
    public function store(StoreExperienceRequest $request) {

        $user = $request->user();

        $experience = $user->experience()->create(
            $request->only(['subject', 'content'])
        );

        // 파일첨부 관련
        $this->attachments($request, $experience);

        return to_route("experience.index");
    }

    /**
     * 내경력 메뉴 수정 폼 로드
     */
    public function edit(Experience $experience) {
        $experienceRw = Experience::with('user')
            ->where('id', '=', $experience->id)
            ->get();

        return view("portfolio.write", [
            'experience' => $experienceRw[0],
            'editorPath' => '../../',
            'isSiteAdmin' => config('app.appAdminEmail') == auth()->user()?->email,
            'formActionUrl' => route('experience.update', [
                $experience->id
            ]), // 수정 폼 Action url
        ]);
    }

    /**
     * 내경력 메뉴 수정 DB 처러
     */
    public function update(UpdateExperienceRequest $request, Experience $experience) {
        $experience->update(
            $request->only(['subject', 'content'])
        );

        // 파일첨부 관련
        $this->attachments($request, $experience);

        return to_route("experience.index");
    }

    /**
     * 파일첨부 처리 맴버함수
     */
    private function attachments(Request $request, $experience) {
        if ($request->hasFile('attachments')) {
            app(AttachmentController::class)->store($request, $experience);
        }
    }

    /**
     * 내경력 메뉴 상세보기 페이지 로드
     */
    public function show(Experience $experience) {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}

