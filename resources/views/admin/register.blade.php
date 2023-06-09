@extends('.layouts.admin')

@section('registration')
    <div class="form-wrap">
        <div class="auth-form">
            <p class="form-header">{{$title}}</p>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="bord @error('name') form-error @enderror">
                    <input name="name" type="text" value="" placeholder="Имя"><br>
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="bord @error('name') form-error @enderror">
                    <input name="email" type="text" value="" placeholder="Email">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="bord @error('name') form-error @enderror">
                    <input name="password" type="password" value="" placeholder="Пароль">
                    @error('password')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button class="admin-button" type="submit">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
@endsection
