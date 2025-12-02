@extends('layouts.auth')

@section('title', 'Register - yawOuch')
@section('card_title', 'Create account')
@section('card_sub', 'Register a new user')

@section('card_body')
    @if($errors->any())
        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">User ID</label>
            <input id="id" name="id" class="form-control" inputmode="numeric" pattern="\d*" maxlength="12"
                placeholder="Enter numeric User ID" autocomplete="username" required
                oninput="this.value=this.value.replace(/\D/g,'')">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full name</label>
            <input id="name" name="name" class="form-control" placeholder="Enter your full name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Choose a password"
                required autocomplete="new-password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Repeat password" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <div class="text-center mt-3">
        <p class="mb-1 text-muted">Already have an account?</p>
        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">Login</a>
    </div>

    <div class="text-center mt-3"><small>&copy; {{ date('Y') }}</small></div>
@endsection