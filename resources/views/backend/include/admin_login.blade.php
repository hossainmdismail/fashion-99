@extends('backend.layouts.app')
@section('content')
<div class="card mx-auto card-login">
    <div class="card-body">
        <h4 class="card-title mb-4">Login Admin Account</h4>
        <form action="{{ route('adminlogin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" placeholder="Your email" type="email" name="email">
                @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div> <!-- form-group// -->
            <div class="mb-3">
                <label class="form-label">Your password</label>
                <input class="form-control @error('password') is-invalid @enderror" placeholder="Password" type="password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> <!-- form-group// -->
            <div class="mb-3">
                <p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.</p>
            </div> <!-- form-group  .// -->
            <div class="mb-4">
                <button type="submit" class="btn btn-primary w-100"> Login </button>
            </div> <!-- form-group// -->
        </form>
    </div>
</div>
@endsection