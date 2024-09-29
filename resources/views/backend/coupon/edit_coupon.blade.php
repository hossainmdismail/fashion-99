@extends('backend.master')
@section('content')
<section class="content-main">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h4>Edit Coupon</h4>

                    <a href="{{ route('coupon.index') }}" class="btn btn-primary">List</a>
                </div>
                <div class="card-body">
                    <form action="{{route('coupon.update',$coupon->id)}}" method="POST">
                        @csrf
                   @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                               
                                <div class="mb-4">
                                    <label class="form-label">Coupon Type</label>
                                    <select class="form-select" name="coupon_type">
                                        {{-- <option value="">---select---</option> --}}
                                        @foreach ($couponTypes as $couponType)
                                        <option value="{{ $couponType }}" {{ $coupon->type == $couponType ? 'selected' : '' }}>{{ $couponType }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Coupon Code</label>
                                    <input type="text" placeholder="Coupon code" value="{{$coupon->code}}" class="form-control @error('name') is-invalid @enderror" name="coupon_code">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Coupon Value</label>
                                    <input type="number" placeholder="Coupon" value="{{$coupon->type}}" class="form-control @error('name') is-invalid @enderror" name="coupon_value">
                                </div>
                                <div class="mb-4">
                                   <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</section>
@endsection
