<div class="card mb-4">
    <div class="card-header">
        <h4>Media</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="row mb-4">
                @if ($images)
                    @foreach ($images as $image)
                        <div class="col-4 position-relative">
                            <a wire:click="imageDelete({{ $image->id }})" class="position-absolute"
                                style="padding-left: 0.4rem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 28 28">
                                    <path fill="currentColor"
                                        d="M11.5 6h5a2.5 2.5 0 0 0-5 0M10 6a4 4 0 0 1 8 0h6.25a.75.75 0 0 1 0 1.5h-1.31l-1.217 14.603A4.25 4.25 0 0 1 17.488 26h-6.976a4.25 4.25 0 0 1-4.235-3.897L5.06 7.5H3.75a.75.75 0 0 1 0-1.5zm2.5 5.75a.75.75 0 0 0-1.5 0v8.5a.75.75 0 0 0 1.5 0zm3.75-.75a.75.75 0 0 0-.75.75v8.5a.75.75 0 0 0 1.5 0v-8.5a.75.75 0 0 0-.75-.75" />
                                </svg>
                            </a>
                            <img class="rounded" style="width: 100%"
                                src="{{ asset('files/product/' . $image->image) }}">
                        </div>
                    @endforeach
                @endif
                <input class="form-control" wire:model="image" type="file">
            </div>

            <div class="mb-4">
                <button class="btn btn-primary">Upload</button>
            </div>

        </form>
    </div>
</div>
