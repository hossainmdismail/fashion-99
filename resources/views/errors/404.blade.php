@extends('themes.default.layout.error')
@section('content')
    <div class="py-0 py-md-5"></div>
    <section class="page-not-found">
        <div class="content container">
            <h2 class="mb-3">OOPS!</h2>
            <h3 class="mb-3">Page not found</h3>
            <p class="mb-3">Sorry, we couldn't find the page you where looking for. We suggest that you return to home
                page.</p>
            <a href="{{ route('index') }}" class="btn btn-primary">GO BACK</a>
        </div>
    </section>
@endsection
