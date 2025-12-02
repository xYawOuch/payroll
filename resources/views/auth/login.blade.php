@extends('layouts.auth')

@section('title', 'Login - yawOuch')
@section('card_title', 'Login')
@section('card_sub', '')

@section('card_body')
    @if($errors->any())
        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">User ID</label>
            <input id="id" name="id" class="form-control" inputmode="numeric" pattern="\d*" maxlength="12"
                placeholder="Enter your ID" autocomplete="username" required
                oninput="this.value=this.value.replace(/\D/g,'')">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"
                required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <p class="mb-1 text-muted">Don't have an account?</p>
        <a href="{{ url('/register') }}" class="btn btn-outline-light btn-sm">Register</a>
    </div>

    <div class="text-center mt-3"><small>&copy; {{ date('Y') }}</small></div>
@endsection