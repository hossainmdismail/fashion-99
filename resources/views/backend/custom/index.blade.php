@extends('backend.master')
@section('content')
<section class="content-main">
<form action="{{ route('customlink.store') }}" method="post">
    @csrf
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="badge badge-secondary" style="color: #ff121294">Making changes without proper understanding may lead to code disruptions</span>
            <button type="submit" class="btn btn-sm btn-primary">{{ !$data?'Save':'Update' }}</button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="">Header</label>
                <textarea cols="30" rows="20" name="header" class="form-control">{{ $data?$data->header:'' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="">Body</label>
                <textarea cols="30" rows="10" name="body" class="form-control">{{ $data?$data->body:'' }}</textarea>
            </div>
            {{-- <div class="mb-3">
                <label for="">Footer</label>
                <textarea cols="30" rows="10" name="footer" class="form-control">{{ $data?$data->footer:'' }}</textarea>
            </div> --}}
        </div>
    </div> <!-- card end// -->
</form>
</section> <!-- content-main end// -->
@endsection
