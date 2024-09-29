@extends('backend.master')

@section('content')
<section class="content-main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Employee form</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ $employee->name }}" type="text" name="name">
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" value="{{ $employee->email }}" type="email" name="email">
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
                                <div class="col-8"> <input class="form-control @error('number') is-invalid @enderror" value="{{ $employee->number }}" type="number" name="number">
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
                                <option value="superAdmin" {{ $employee->role == 'superAdmin'?'selected':''}}> Super Admin </option>
                                <option value="businessManager" {{ $employee->role == 'businessManager'?'selected':''}}> Business Manager </option>
                                <option value="contentManager" {{ $employee->role == 'contentManager'?'selected':''}}> Content Manager </option>
                                <option value="employee" {{ $employee->role == 'employee'?'selected':''}}> Employee </option>
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
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100"> Update employee </button>
                        </div> <!-- form-group// -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
