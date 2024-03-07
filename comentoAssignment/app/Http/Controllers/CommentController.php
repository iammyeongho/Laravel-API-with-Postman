<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illiminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Comment;
use App\Models\User;
use App\Models\Questions;

class CommentController extends Controller
{
    public function postComment(Request $request) {

        $commentCnt = Comment::where('question_id', $request->question_id)
            ->count();

        Log::debug($commentCnt);
            if($commentCnt <= 3) {
                // 로그인 시 저장한 세션값이 있는지 확인
            if (session('user_social_id')) {
                // 해당 세션에 존재하는 이메일 값을 토대로 유저 아이디 값 출력
                $userSocialId = session('user_social_id');
                $user = User::where('user_social_id', $userSocialId)->first();
                $userId = $user->user_id;

                // 유저 값이 있는지 확인
                if($user) {
                    // 해당 유저가 멘토인지 확인 후 코멘트 작성
                    if($user->user_state === '1') {
                        $questionsData = Comment::create([
                            'user_id' => $userId,
                            'question_id' => $request->question_id,
                            'comment_contents' => $request->comment_contents,
                        ]);
                        return response()->json(['message' => '작성 완료되었습니다.', 'data' => $questionsData]);
                    } else {
                        return response()->json(['message' => '멘토 인증 후 답변을 작성해주세요.']);
                    }
                }
            } else {
                return response()->json(['message' => '로그인 후 답변을 작성해주세요.']);
            }
        } else {
            return response()->json(['message' => '이미 답변이 모두 작성되어있습니다.']);
        }
        
        
    }

    public function putComment(Request $request) {
        // 로그인 시 저장한 세션값이 있는지 확인
        if(session('user_social_id')) {
            // 해당 세션에 존재하는 이메일 값을 토대로 유저 아이디 값 출력
            $userSocialId = session('user_social_id');
            $user = User::where('user_social_id', $userSocialId)->first();
            $userId = $user->user_id;

            // 해당 게시물의 유저 아이디 값 출력
            $questionId = Questions::where('question_id', $request->questionID)
                ->first();
            $questionUserId = $questionId->user_id;

            // 게시물과 현재 유저 아이디 값이 같을 시 해당 답변 채택
            if($userId === $questionUserId) {
                $commentFlg = Comment::find($request->comment_id);

                $commentFlg->comment_flg = 1;
                $commentFlg->save();

                return response()->json(['message' => '해당 답변을 채택하였습니다.', 'data' => $commentFlg]);
            } else {
                return response()->json(['message' => '해당 글 작성자가 아닙니다.']);
            }
        } else {
            return response()->json(['message' => '로그인 후 채택해주세요.']);
        }
        
    }
}
