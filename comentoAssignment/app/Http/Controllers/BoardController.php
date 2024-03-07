<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illiminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Comment;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class BoardController extends Controller
{
    public function getBoard(Request $request) {
        // 게시물 관련 정보를 가져옴, 페이지네이션을 통해 6개의 게시물만 출력
        $boardDataQuery = Questions::select('users.user_kind', 'questions.question_title', 'questions.question_contents', 'questions.question_view', 'questions.created_at')
        ->join('users', 'questions.user_id', 'users.user_id')
        ->orderBy('questions.created_at', 'desc')
        ->paginate(6);
    
        // 해당 값을 배열로 변환
        $boardData = $boardDataQuery->toArray();
        
        // 받아온 데이터를 foreach 돌려서 20자가 넘어갈 시 ...을 붙혀서 출력
        foreach ($boardData['data'] as &$item) {
            // 내용 글자 수 제한 (20자)
            $item['question_contents'] = Str::limit($item['question_contents'], 20);
        
            // 한글 글자 수 정확히 계산 (UTF-8 인코딩을 고려)
            $item['question_contents'] = mb_strimwidth($item['question_contents'], 0, 20, '...', 'UTF-8');
        }
        
        // 해당 값 리턴
        return response()->json($boardData);
    }

    public function getBoardDetail(Request $request) {
        // 게시물 디테일 정보 출력
        $baordDetailDate = Questions::select('questions.question_title', 'questions.question_contents', 'questions.created_at', 'users.user_kind')
            ->join('users', 'questions.user_id', 'users.user_id')
            ->where('questions.question_id', $request->questionID)
            ->first();

        // 해당 값을 배열로 변환
        $baordDetailDateArrays = $baordDetailDate->toArray();

        // 해당 게시물에 맞는 답변 출력
        $commentDetailDate = Comment::select('comments.comment_contents', 'comments.comment_flg', 'comments.created_at', 'users.user_kind')
            ->join('users', 'comments.user_id', 'users.user_id')
            ->join('questions', 'comments.question_id', 'questions.question_id')
            ->where('questions.question_id', $request->questionID)
            ->get();

        // 게시물 배열 안에 답변을 넣기 위해 배열로 변환
        $baordDetailDateArrays['coments'] = $commentDetailDate->toArray();

        // 게시물 조회수를 올리기 위한 쿼리
        $boardView = Questions::find($request->questionID);
        $boardView->question_view += 1;
        $boardView->save();


            return response()->json(['boardData' => $baordDetailDateArrays]);
    }

    public function postBoard(Request $request) {
        // 로그인 시 저장한 세션값이 있는지 확인
        if(session('user_social_id')) {
            $userSocialId = session('user_social_id');

            // 세션 값이 있는지 확인
            if($userSocialId) { 
                // 해당 세션에 존재하는 이메일 값을 토대로 유저 아이디 값 출력
                $user = User::where('user_social_id', $userSocialId)
                    ->first();
                $userId = $user->user_id;
        
                // 해당 유저아이디를 토대로 게시글 작성
                $questionsData = Questions::create([
                    'user_id' => $userId,
                    'category_id' => $request->category_id,
                    'question_title' => $request->question_title,
                    'question_contents' => $request->question_contents,
                ]);
                return response()->json(['message' => '작성 완료되었습니다.', 'data' => $questionsData]);
            }
        } else {
            return response()->json(['message' => '로그인 후 작성해주세요.']);
        }
    }

    public function deleteBoard(Request $request) {
        // 로그인 시 저장한 세션값이 있는지 확인
        if(session('user_social_id')) { 
            $userSocialId = session('user_social_id');
            // 해당 세션에 존재하는 이메일 값을 토대로 유저 아이디 값 출력
            $user = User::where('user_social_id', $userSocialId)
                ->first();
            $userId = $user->user_id;
    
            // 리퀘스트 값으로 받아온 게시물 아이디값 확인
            $questionId = Questions::where('question_id', $request->questionID)
                ->first();
            // 해당 게시물의 유저 아이디 값 출력
            $questionUserId = $questionId->user_id;
    
            // 해당 게시물의 답변 출력
            $comments = Comment::where('question_id', $request->questionID)
                ->get();

            // 게시물 아이디 값과 현재 유저 아이디 값 비교
            if($questionUserId === $userId) {
                // 코멘트값이 비었을 경우 바로 삭제 처리
                if($comments->isEmpty()) {
                    $questionsData = Questions::destroy($request->questionID);
                    return response()->json(['message' => '삭제 완료되었습니다.', 'data' => $questionsData]);
                } else {
                    // 답변 값이 존재할 경우 그 답변 중 채택된 답변이 있는지 foreach 확인
                    foreach ($comments as $comment) {
                        if ($comment->comment_flg === '0') {
                            $questionsData = Questions::destroy($request->questionID);
                            return response()->json(['message' => '삭제 완료되었습니다.', 'data' => $questionsData]);
                        } else if($comment->comment_flg === '1') {
                            return response()->json(['message' => '채택된 답변이 있습니다.']);
                        }
                    }
                }
            } else {
                return response()->json(['message' => '작성자가 아닙니다.']);
            }
        } else {
            return response()->json(['message' => '로그인 후 삭제해주세요.']);
        }
    }


}
