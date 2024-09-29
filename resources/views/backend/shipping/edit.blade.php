@extends('backend.master')
@section('content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Shipping List </h2>
            {{-- <p>Here Your All Catego.</p> --}}
        </div>
        <div>
            {{-- <input type="text" placeholder="Search order ID" class="form-control bg-white"> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Shipping Form</h5>
                </div>
                <div class="card-body">
                    @if (session('succ'))
                        <div class="alert alert-success" role="alert">
                           {{ session('succ') }}
                        </div>
                    @endif
                    <form action="{{ route('shipping.update',$shipping->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        {{-- <input type="hidden" name="id" value="{{ $shipping->id }}"> --}}
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="" placeholder="Shipping name" value="{{ $shipping->name }}">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="" placeholder="0.00" value="{{ $shipping->price }}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">+ Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> <!-- content-main end// -->
@endsection
