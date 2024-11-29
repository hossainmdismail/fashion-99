<form action="" method="POST">
    <div class="row">
        <h6 class="mb-3">User</h6>
        <div class="col-md-3 mb-2">
            <label for="">Client Name</label>
            <input type="text" name="name" class="form-control"
                value="{{ $order->user ? $order->user->name : 'Null' }}">
        </div>
        <div class="col-md-3 mb-2">
            <label for="">Client Number</label>
            <input type="text" name="number" class="form-control"
                value="{{ $order->user ? $order->user->number : 'Null' }}">
        </div>
        <div class="col-md-6 mb-2">
            <label for="">Client Address</label>
            <input type="text" name="address" class="form-control"
                value="{{ $order->user ? $order->user->address : 'Null' }}">
        </div>
    </div>

    <div class="row">
        <h6 class="mb-3">Order Information</h6>
        <div class="col-md-4 mb-2">
            <label for="message">Client Message</label>
            <input type="text" class="form-control" id="message" name="message"
                value="{{ $order->client_message }}">
        </div>
    </div>
    <!-- Add more fields as needed -->
    <button type="button" class="btn btn-primary" id="saveOrderButton">Save</button>
</form>
