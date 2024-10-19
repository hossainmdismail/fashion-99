<td>
    <div class="shopping-cart__product-item">
        <a>
            <img loading="lazy" src="{{ asset('files/product/' . $product['image']) }}" width="120" height="120"
                alt="">
        </a>
    </div>
</td>
<td>
    <div class="shopping-cart__product-item__detail">
        <h4><a>{{ $product['name'] }} </a></h4>
        <ul class="shopping-cart__product-item__options">
            <li>Color: {{ $product['color'] }}</li>
            <li>Size: {{ $product['size'] }}</li>
        </ul>
    </div>
</td>
<td>
    <div class="qty-control position-relative">
        <div class="spinner-border text-primary qty-spinner-main d-none" role="status">
            <span class="sr-only"></span>
        </div>
        <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1"
            class="qty-control__number text-center">
        <div class="qty-control__reduce" data-inventory-id="{{ $product['id'] }}">-</div>
        <div class="qty-control__increase" data-inventory-id="{{ $product['id'] }}">+</div>
    </div>
</td>
<td>

    <span class="shopping-cart__subtotal">{{ $product['totalPrice'] }} {{ __('messages.currency') }}</span>
</td>
<td>
    <button type="button" class="btn-close-xs cart-item-remove" data-cartremove="{{ $product['id'] }}"></button>

    <div class="spinner-border add-to-cart-remove-loader" data-cartremove="{{ $product['id'] }} role="status"
        style="display:none;">
        <span class="sr-only"></span>
    </div>
</td>
<script>
    // Function to increment the quantity
    $('.qty-control__increase').on('click', function(e) {
        e.preventDefault();

        let inventoryId = $(this).data('inventory-id');
        let $qtyControl = $(this).closest('.qty-control');
        let $spinner = $qtyControl.find('.qty-spinner-main');
        let $quantityInput = $qtyControl.find('.qty-control__number');

        // Show the loading spinner and clear the input field temporarily
        $spinner.removeClass('d-none');
        $quantityInput.val(''); // Optionally empty the field to show loading

        // AJAX request to increment the quantity
        $.ajax({
            url: '/cart/item/increment/' + inventoryId,
            method: 'GET',
            success: function(response) {
                loadCheckoutData();
                loadCartData();

                // Update the quantity field with the new value from the server
                $quantityInput.val(response.newQuantity);

                // Hide the spinner
                $spinner.addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('Error incrementing the item:', error);

                // Hide the spinner on error
                $spinner.addClass('d-none');
            }
        });
    });

    // Function to decrement the quantity
    $('.qty-control__reduce').on('click', function(e) {
        e.preventDefault();

        let inventoryId = $(this).data('inventory-id');
        let $qtyControl = $(this).closest('.qty-control');
        let $spinner = $qtyControl.find('.qty-spinner-main');
        let $quantityInput = $qtyControl.find('.qty-control__number');

        // Prevent decrementing below 1
        if ($quantityInput.val() <= 1) return;

        // Show the loading spinner and clear the input field temporarily
        $spinner.removeClass('d-none');
        $quantityInput.val(''); // Optionally empty the field to show loading

        // AJAX request to decrement the quantity
        $.ajax({
            url: '/cart/item/decrement/' + inventoryId,
            method: 'GET',
            success: function(response) {
                loadCheckoutData();
                loadCartData();

                // Update the quantity field with the new value from the server
                $quantityInput.val(response.newQuantity);

                // Hide the spinner
                $spinner.addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error('Error decrementing the item:', error);

                // Hide the spinner on error
                $spinner.addClass('d-none');
            }
        });
    });
</script>
