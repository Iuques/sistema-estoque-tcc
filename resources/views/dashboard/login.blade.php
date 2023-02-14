@extends('layouts.login')
@section('title', 'Login')
@section('content')

<div class="wrapper" id="login-wrapper">
    <div class="container main" id="login-container">
        <div class="row" id="login-row">
            <div class="col-md-6 side-image">
            </div>
            <div class="col-md-6 right">
                <form action="/dashboard/login/do" method="POST">
                    @csrf
                    <div class="input-box" id="login-inputbox">
                        <header>Realizar login</header>
                        @if ($errors->all())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-center" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        <div class="input-field">
                            <input type="text" class="input" id="email" name="email" required autocomplete="off">
                            <label for="email" id="input-label">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="password" name="password" required>
                            <label for="password" id="input-label">Senha</label>
                        </div>
                        <div class="input-field">
                            <label class="checkbox-container" for="remember">Lembrar de mim
                                <input type="checkbox" class="checkbox" id="remember" name="remember">
                                <span class="checkmark"></span>
                              </label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" id="email" value="Entrar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    

@endsection
