@extends('layouts.app')
@section('title', 'ログイン')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        @include('layouts.error')
        <div class="card" style="background: #fafafa">
            <h3 class="card-header text-white text-center" style="background: linear-gradient(45deg, , red, orange)">{{ __('ログイン') }}</h3>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="">{{ __('メールアドレス') }}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password" class="">{{ __('パスワード') }}</label>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                    </div>
                    <!-- div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 mt-4" style="border-radius: 1.2em">
                            {{ __('ログイン') }}
                        </button>
                    </div>
                    <a class="nav-link text-right" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                    <!-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection