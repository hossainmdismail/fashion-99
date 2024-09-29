@extends('backend.master')

@section('content')
<section class="content-main">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5>Employee form</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
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
                                <option value="businessManager"> Business Manager </option>
                                <option value="contentManager"> Content Manager </option>
                                <option value="employee"> Employee </option>
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
                            <button type="submit" class="btn btn-primary w-100"> Add employee </button>
                        </div> <!-- form-group// -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>Employee list</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created</th>
                                    <th scope="col" class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $key => $request)
                                <tr>
                                    <td><b>{{ $request->name }}</b></td>
                                    <td><b>{{ $request->role }}</b></td>
                                    <td><b>{{ $request->created_at }}</b></td>
                                    <td class="text-end">
                                        <a href="{{ route('employee.edit', $request->id) }}" class="btn btn-md rounded font-sm">Edit</a>
                                        <a href="{{ route('employee.destroy', $request->id) }}" class="btn btn-md bg-warning rounded font-sm">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table-responsive //end -->
                </div> <!-- card-body end// -->
            </div>
        </div>
    </div>
</section>
@endsection
