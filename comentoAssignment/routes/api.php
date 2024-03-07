<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\KakaoController;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 게시물 정보 조회
Route::get('/boards', [BoardController::class, 'getBoard'] );

// 게시물 디테일 정보 조회
Route::get('/boards/{questionID}', [BoardController::class, 'getBoardDetail'] );

// 게시물 작성
Route::post('/boards', [BoardController::class, 'postBoard'] );

// 게시물 삭제
Route::delete('/boards/{questionID}', [BoardController::class, 'deleteBoard'] );

// 답변 작성
Route::post('/boards/{questionID}', [CommentController::class, 'postComment'] );

// 답변 채택
Route::put('/boards/{questionID}', [CommentController::class, 'putComment']);

// 소셜 로그인
Route::get('/login/kakao', function (Request $request) {
    return Socialite::driver('kakao')->redirect();
});

// 카카오 콜백 함수
Route::get('/login/kakao/callback', [KakaoController::class, 'handleKakaoLogin']);

// 카카오 로그인 후 데이터 베이스에 없을 시 회원가입
Route::post('/register', [KakaoController::class, 'postRegister']);