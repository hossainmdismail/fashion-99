<div class="col-md-6">
    @if (session('succ'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('succ') }}</li>
            </ul>
        </div>
    @endif
    @if (session('err'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('err') }}</li>
            </ul>
        </div>
    @endif
    <!-- Modal size add -->
    <div class="modal fade show" id="size" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">size attributes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save" wire:ignore>
                    <div class="modal-body row">
                        <p style="font-size: 12px; size:rgba(0, 0, 0, 0.673)">Attributes can not be deleted if you
                            add once</p>
                        <div class="mb-3 col-9">
                            <label for="">Name*</label>
                            <input type="text" wire:model="name" class="form-control" placeholder="size name"
                                required>

                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal size edit -->
    <div class="modal fade show" id="sizeEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update()" wire:ignore>
                    <div class="modal-body row">
                        <div class="mb-3 col-9">
                            <label for="">Name*</label>
                            <input type="text" wire:model="name" value="{{ $name }}" class="form-control"
                                placeholder="size name" required>

                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal size delete -->
    <div class="modal fade show" id="sizeDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroy()" wire:ignore>
                    <div class="modal-body row">
                        Are you sure you want to delete this?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>size</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#size">
                Add size
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    {{-- <button >...</button> --}}
                    <tbody>
                        @forelse ($sizes as $size)
                            <tr>
                                <td>{{ $size->name }}</td>
                                <td><span class="badge rounded-pill alert-warning">Pending</span></td>
                                <td>
                                    <a wire:click="edit({{ $size->id }})"
                                        class="btn btn-sm font-sm rounded btn-brand">
                                        <div class="spinner-border spinner-border-sm" wire:loading
                                            wire:target="edit({{ $size->id }})" role="status">
                                            {{-- <span class="visually-hidden">Loading...</span> --}}
                                        </div>
                                        <i wire:loading.remove wire:target="edit({{ $size->id }})"
                                            class="material-icons md-edit"></i>
                                    </a>
                                    {{-- <a wire:click="delete({{ $size->id }})"
                                        class="btn btn-sm font-sm btn-light rounded">
                                        <div class="spinner-border spinner-border-sm" wire:loading
                                            wire:target="delete({{ $size->id }})" role="status">
                                        </div>
                                        <i class="material-icons md-delete_forever" wire:loading.remove
                                            wire:target="delete({{ $size->id }})"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('stay-model', (event) => {
            $('#size').modal('hide');
            $('#sizeEdit').modal('hide');
            $('#sizeDelete').modal('hide');
        });

        Livewire.on('sizeEdit', (event) => {
            $('#sizeEdit').modal('show');
            // console.log('okau');
        });

        Livewire.on('sizeDelete', (event) => {
            $('#sizeDelete').modal('show');
            // console.log('okau');
        });
    });
</script>
