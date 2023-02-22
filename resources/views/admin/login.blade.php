@extends('.layouts.admin')

@section('login')
    <div class="form-wrap">
        <div class="auth-form">
            <p class="form-header">{{$title}}</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="bord @error('email') form-error @enderror">
                    <input name="email" type="text" value="" placeholder="Email">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="bord @error('password') form-error @enderror">
                    <input name="password" type="password" value="" placeholder="Пароль">
                    @error('password')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="admin-button">Войти</button>
            </form>
        </div>
    </div>
@endsection
