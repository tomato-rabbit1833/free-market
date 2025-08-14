<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser; // 追加
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Features;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 会員登録ビュー
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログインビュー
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ✅ CreateNewUser を使ってユーザー作成処理を定義
        Fortify::createUsersUsing(CreateNewUser::class);

        // ✅ 登録完了後のリダイレクト先
        $this->app->instance(
            RegisterResponse::class,
            new class implements RegisterResponse {
                public function toResponse($request)
                {
                    return redirect('/mypage/profile'); // 任意の遷移先
                }
            }
        );
    }
}