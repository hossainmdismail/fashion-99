@if ($order->user)
    <form action="{{ route('user.update', $order->user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <h4 class="mb-3">User</h4>
            <div class="col-md-6 mb-2">
                <label for="">Client Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ $order->user ? $order->user->name : 'Null' }}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Client Number</label>
                <input type="text" name="number" class="form-control"
                    value="{{ $order->user ? $order->user->number : 'Null' }}">
            </div>

            <h6 class="mb-3">Address</h6>
            <div class="col-12 mb-2">
                <span>
                    {{ $order->user ? $order->user->address : 'Null' }}
                </span>
            </div>

            <div class="col-md-4 mb-2">
                <label for="">Street</label>
                <input class="form-control" placeholder="House / Road" type="text" name="street" id="">
            </div>

            <div class="col-md-4 mb-2">
                <label for="">City</label>
                <input class="form-control" placeholder="City / Union" type="text" name="city" id="">
            </div>

            <div class="col-md-4 mb-3">
                <label for="">Devision</label>
                <input class="form-control" placeholder="Dhaka / Chittagong" type="text" name="devision"
                    id="">
            </div>
            <div class="col-12 text-right">
                <button type="submit" name="btn" value="1" class="btn btn-primary">Update</button>
                <button type="submit" name="btn" value="2" class="btn btn-danger">Block</button>
            </div>
        </div>
    </form>
@endif
{{-- <hr>
<form action="" method="post">

    <div class="row">
        <h4 class="mb-3">Order Information</h4>

        <div class="col-md-4 mb-2">
            <label for="message">Client Message</label>
            <input type="text" class="form-control" id="message" name="message"
                value="{{ $order->client_message }}">
        </div>
    </div>
    <!-- Add more fields as needed -->
    <button type="button" class="btn btn-primary" id="saveOrderButton">Save</button>
</form> --}}
