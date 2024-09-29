@extends('backend.layouts.app')
@section('content')
<div class="card mx-auto card-login">
    <div class="card-body">
        <h4 class="card-title mb-4">Create an Admin Account</h4>
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" type="text" name="name">
                @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div> <!-- form-group// -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" placeholder="Your email" type="email" name="email">
                @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div> <!-- form-group// -->
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <div class="row gx-2">
                    <div class="col-4"> <input class="form-control" value="+88" type="text" name="country_code" readonly> </div>
                    <div class="col-8"> <input class="form-control @error('number') is-invalid @enderror" placeholder="Phone Number" type="number" name="number">
                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div> <!-- form-group// -->
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role">
                    <option value="superAdmin" selected> Super Admin </option>
                </select>
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">Image</label>
                <input class="form-control" placeholder="Your email" type="file" name="profile">
            </div> --}}
            <div class="mb-3">
                <label class="form-label">Create password</label>
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
                <button type="submit" class="btn btn-primary w-100"> Sin Up </button>
            </div> <!-- form-group// -->
        </form>
        <p class="text-center mb-2">Already have an account? <a href="{{ route('admin.login') }}">Sign in now</a></p>
    </div>
</div>
@endsection
