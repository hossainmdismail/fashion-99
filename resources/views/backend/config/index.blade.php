@extends('backend.master')
@section('content')
    <section class="content-main">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('succ'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('succ') }}</li>
                </ul>
            </div>
        @endif


        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">
                    @if ($request)
                        <form action="{{ route('config.update', $request->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                {{-- Right --}}
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Name</label>
                                                <input type="text" placeholder="Site Name" class="form-control"
                                                    name="name" value="{{ $request ? $request->name : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Email</label>
                                                <input type="text" placeholder="Site Email" class="form-control"
                                                    name="email" value="{{ $request ? $request->email : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Number</label>
                                                <input type="text" placeholder="Site Number" class="form-control"
                                                    name="number" value="{{ $request ? $request->number : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Address</label>
                                                <input type="text" placeholder="Site Address" class="form-control"
                                                    name="address" value="{{ $request ? $request->address : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Site URL</label>
                                                <input type="text" placeholder="https://google.com" class="form-control"
                                                    name="url" value="{{ $request ? $request->url : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- left --}}
                                <div class="col-4">
                                    <div class="card-body">
                                        <label for="">Logo</label>
                                        <div class="input-upload">
                                            @if ($request)
                                                <img src="{{ asset('files/config/' . $request->logo) }}" id="mainlogo"
                                                    alt="" style="width: 100px;">
                                            @else
                                                <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}"
                                                    id="mainlogo" alt="" style="width: 100px; height: 100px;">
                                            @endif
                                            <input type="file" class="form-control" name="logo"
                                                onchange="previewImage(event, 'mainlogo')">
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <label for="">Fav icon</label>
                                        <div class="input-upload">
                                            @if ($request)
                                                <img src="{{ asset('files/config/' . $request->fav) }}" id="mainlogo"
                                                    alt="" style="width: 50px;">
                                            @else
                                                <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}"
                                                    id="mainlogo" alt="" style="width: 100px; height: 100px;">
                                            @endif
                                            <input type="file" class="form-control" name="fav"
                                                onchange="previewImage(event, 'favicon')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label"></label>
                                        <button type="submit"
                                            class="btn btn-primary rounded font-sm mr-5 hover-up">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('config.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Right --}}
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Name</label>
                                                <input type="text" placeholder="Site Name" class="form-control"
                                                    name="name" value="{{ $request ? $request->name : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Email</label>
                                                <input type="text" placeholder="Site Email" class="form-control"
                                                    name="email" value="{{ $request ? $request->email : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Number</label>
                                                <input type="text" placeholder="Site Number" class="form-control"
                                                    name="number" value="{{ $request ? $request->number : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Address</label>
                                                <input type="text" placeholder="Site Address" class="form-control"
                                                    name="address" value="{{ $request ? $request->address : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="product_name" class="form-label">Site URL</label>
                                                <input type="text" placeholder="https://google.com"
                                                    class="form-control" name="url"
                                                    value="{{ $request ? $request->url : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- left --}}
                                <div class="col-4">
                                    <div class="card-body">
                                        <label for="">Logo</label>
                                        <div class="input-upload">
                                            @if ($request)
                                                <img src="{{ asset('files/config/' . $request->logo) }}" id="mainlogo"
                                                    alt="" style="width: 100px;">
                                            @else
                                                <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}"
                                                    id="mainlogo" alt="" style="width: 100px; height: 100px;">
                                            @endif
                                            <input type="file" class="form-control" name="logo"
                                                onchange="previewImage(event, 'mainlogo')">
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <label for="">Fav icon</label>
                                        <div class="input-upload">
                                            @if ($request)
                                                <img src="{{ asset('files/config/' . $request->fav) }}" id="mainlogo"
                                                    alt="" style="width: 50px;">
                                            @else
                                                <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}"
                                                    id="mainlogo" alt="" style="width: 100px; height: 100px;">
                                            @endif
                                            <input type="file" class="form-control" name="fav"
                                                onchange="previewImage(event, 'favicon')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label"></label>
                                        <button type="submit" class="btn btn-primary rounded font-sm mr-5 hover-up">+
                                            Configuration</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </header>
        </div> <!-- card end// -->
    </section> <!-- content-main end// -->
@endsection
@section('script')
    <script>
        function previewImage(event, imgId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(imgId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
