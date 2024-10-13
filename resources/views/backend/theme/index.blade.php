@extends('backend.master')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="themeModal">
        <div class="modal-dialog" role="document">
            <form id="themeForm" method="GET">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Theme Select</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">This will change your main theme</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Active</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Themes</h2>
                {{-- <p>Here Your All Catego.</p> --}}
            </div>
            <div>
                {{-- <input type="text" placeholder="Search order ID" class="form-control bg-white"> --}}
            </div>
        </div>
        <div class="row">
            @if (session()->has('succ'))
                <div class="alert alert-success" role="alert">
                    {{ session('succ') }}
                </div>
            @endif
            @foreach ($themes as $theme)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{ asset("themes/$theme->slug/$theme->image") }}" alt="">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $theme->name }}</strong>
                                <button class="btn btn-{{ $theme->default ? 'secondary' : 'primary' }} btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#themeModal" data-id="{{ $theme->id }}"
                                    data-name="{{ $theme->name }}" {{ $theme->default ? 'disabled' : '' }}>
                                    {{ $theme->default ? 'activated' : 'Active' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#themeModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var themeId = button.data('id'); // Extract info from data-* attributes
            var themeName = button.data('name');

            // Update the modal's content
            var modal = $(this);
            modal.find('#themeName').text(themeName);

            // Dynamically generate the route for the 'edit' action using Laravel's resource route convention
            var actionUrl = '{{ route('themes.update', ':id') }}';
            actionUrl = actionUrl.replace(':id', themeId);

            // Update form action URL dynamically
            modal.find('#themeForm').attr('action', actionUrl);
        });
    </script>
@endsection
