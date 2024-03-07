<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use App\Models\User;

class KakaoController extends Controller
{
    public function handleKakaoLogin(Request $request)
    {
        // 리퀘스트 값 안에 있는 토큰 값 변수에 저장
        $access_token = $request->bearerToken();

        // 포스트맨을 통해 받아온 카카오 액세스 토큰
        $kakaoAccessToken = $access_token; 

        // 카카오 API로 사용자 정보 가져오기
        $userData = $this->getKakaoUserInfo($kakaoAccessToken);

        // 유저 아이디를 확인하기 위해 세션에 유저 아이디값 저장
        // 현재 포스트맨으로 모든 것을 처리하기 때문에 테스트를 위해 세션에 저장
        session(['user_social_id' => $userData]);

        // 해당 유저가 데이터베이스에 존재하는지 확인
        $result = User::where('user_social_id', $userData)->first();

        if($result) {
            // 만약 해당 유저 정보가 있을 시에는 바로 로그인 처리
            return response()->json(['message' => '카카오 로그인에 성공하셨습니다.', 'data' => $result->user_social_id]);
        } else {
            // 해당 유저 정보가 데이터베이스에 없을 경우에는 데이터 추가
            $data = User::create(['user_social_id' => $userData]);
            return response()->json(['message' => '카카오 로그인에 성공하셨습니다.', 'data' => $data]);
        }
    }

    private function getKakaoUserInfo($accessToken)
    {
        // 카카오 회원 정보를 가져오기 위한 URL
        $callUrl = "https://kapi.kakao.com/v2/user/me";
        // 카카오 API 접근을 위한 헤더와 Bearer 토큰 설정
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];
        // 카카오에 API 요청
        $response = Http::withHeaders($headers)->get($callUrl);

        // 받아온 데이터 값을 제이슨 형태로 변수에 저장
        $data = $response->json();

        // 해당 데이터가 있을 시에는 유저데이터로 리턴 없을 시에는 리턴
        if (isset($data['kakao_account']['email'])) {
            $userData = $data['kakao_account']['email'];
            return $userData;
        } else {
            // 이메일이 포함되어 있지 않은 경우에 대한 처리
            return response()->json(['message' => '해당 이메일이 카카오에 없습니다.']);
        }
    }

    public function postRegister(Request $request) {
        // 카카오 로그인 시 저장한 세션 값이 있는지 확인
        if (session('user_social_id')) {
            // 해당 세션값을 변수에 저장
            $userSocialId = session('user_social_id');
            // 해당 값을 유저 데이터베이스에 있는지 확인 후 출력
            $user = User::where('user_social_id', $userSocialId)->first();
            if ($user) {
                // 사용자가 존재할 때 나이 업데이트
                // 만약 입력 값이 0보다 작고 16보다 클 경우에는 에러 메세지 출력
                if ($request->user_age < 0 || $request->user_age > 16) {
                    return response()->json(['message' => '나이는 1~15살만 입력 가능합니다.']);
                } else {
                    // 해당 정보를 입력 시에 멘토 인증 처리
                    $user->user_state = 1;
                    $user->user_kind = $request->user_kind;
                    $user->user_age = $request->user_age;
                    $user->save();
        
                    return response()->json(['message' => '나이 업데이트에 성공했습니다.', 'data' => $user]);
                }
            } else {
                // 사용자가 존재하지 않을 때의 처리
                return response()->json(['error' => '사용자를 찾을 수 없습니다.'], 404);
            }
        }

    }
}