@extends('themes.default.layout.app')
@section('style')
    <style>
        .frb-group {
            margin: 15px 0;
        }

        .frb~.frb {
            margin-top: 15px;
        }

        .frb input[type="radio"]:empty {
            display: none;
        }

        .frb input[type="radio"]~label {
            display: inline-block;
            position: relative;
            width: 100%;
            padding: 6px 10px;
            background-color: white;
            color: black;
            text-align: center;
            border-radius: 5px;
            border: 2px solid black;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .frb input[type="radio"]:checked~label {
            background-color: black;
            color: white;
            border-color: black;
        }

        .frb input[type="radio"]:checked~label::after {
            content: '\2713';
            /* Unicode checkmark */
            font-size: 20px;
            color: white;
            position: absolute;
            top: 5px;
            right: 15px;
        }

        .frb input[type="radio"]:not(:checked)~label:hover {
            background-color: #f0f0f0;
            color: black;
            /* Ensures text remains black when hovering over unchecked */
        }

        .frb input[type="radio"]:checked~label:hover {
            background-color: black;
            color: white;
            /* Keeps text white when checked and hovered */
        }

        .frb input[type="radio"]:focus~label {
            outline: 2px solid #8B3DFF;
        }

        .qty-spinner-main {
            position: absolute;
            top: 18px;
            left: 45px;
        }

        /* Style for invalid radio buttons */
        input[type="radio"].is-invalid {
            border: 2px solid red;
            appearance: none;
            /* Custom appearance to match the custom style */
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: relative;
        }

        /* Add the exclamation mark */
        input[type="radio"].is-invalid::after {
            content: '\26A0';
            /* Unicode for warning/exclamation icon */
            color: red;
            position: absolute;
            right: -25px;
            top: -5px;
            font-size: 20px;
        }

        /* Label styling (optional) */
        label {
            position: relative;
            display: inline-block;
            padding-left: 30px;
        }

        /* Red text for the error message */
        .text-danger {
            color: #d82121 !important;
        }
    </style>
@endsection
@section('content')
    <div class="py-0 py-md-5"></div>
    <main class="pb-5">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            @if (session('err'))
                <div class="alert alert-danger">
                    {{ session('err') }}
                </div>
            @endif
            <div class="shopping-cart">
                <form action="{{ route('checkout.confirm') }}" method="post">
                    @csrf
                    <div class="checkout-form">
                        <div class="billing-info__wrapper">
                            <div class="row">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th></th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="checkout-product-list">
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="spinner-border add-to-cart-remove-loader">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="pt-4">BILLING DETAILS</h4>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            id="checkout_name" placeholder="Name" value="{{ old('name') }}"
                                            name="name">
                                        <label for="checkout_name">Name*</label>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" id="checkout_eamil" placeholder="Email"
                                            name="email" value="{{ old('email') }}">
                                        <label for="checkout_eamil">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="phone" class="form-control @error('number') is-invalid @enderror"
                                            id="checkout_number" placeholder="Number *" name="number" {{ old('number') }}>
                                        <label for="checkout_number">Number*</label>
                                    </div>
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror "
                                            name="address" id="checkout_street_address" placeholder="Street Address *"
                                            {{ old('address') }}>
                                        <label for="checkout_company_name">Address* (<span style="font-size: 12px">থানা/জেলা
                                            </span>)</label>
                                    </div>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)" name="message" cols="30"
                                        rows="4"></textarea>
                                </div>
                            </div>



                        </div>
                        <div class="checkout__totals-wrapper">
                            <div class="sticky-content">
                                <div class="checkout__totals">
                                    <h3>CART TOTAL</h3>

                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>SUBTOTAL</th>
                                                <td>
                                                    <span class="checkout-total">
                                                        <div class="spinner-border add-to-cart-remove-loader">
                                                            <span class="sr-only"></span>
                                                        </div>
                                                    </span> {{ __('messages.currency') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td>Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>Discount</th>
                                                <td>0 {{ __('messages.currency') }}</td>
                                            </tr>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td class="checkout-grandtotal">0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h5 class="pt-4">SHIPPING AREA</h5>
                                <div class="frb-group">
                                    @foreach ($shippings as $key => $shipping)
                                        <div class="frb frb-primary">
                                            <input type="radio" id="shipping-{{ $key + 1 }}" name="shipping"
                                                value="{{ $shipping->id }}" data-price="{{ $shipping->price }}"
                                                class="@error('shipping') is-invalid @enderror"
                                                {{ old('shipping') == $shipping->id ? 'checked' : '' }}>
                                            <!-- Add 'is-invalid' class if there's an error -->
                                            <label for="shipping-{{ $key + 1 }}">
                                                <span class="frb-title">{{ $shipping->name }}</span>
                                                <span class="frb-description shipping-price">{{ $shipping->price }}
                                                    {{ __('messages.currency') }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                    <!-- Show error message -->
                                    @error('shipping')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkout__payment-methods">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="radio"
                                            name="checkout_payment_method" id="checkout_payment_method_3" checked>
                                        <label class="form-check-label" for="checkout_payment_method_3">
                                            Cash on delivery
                                            <span class="option-detail d-block">
                                                Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum
                                                gravida nec dui. Aenean aliquam varius ipsum, non ultricies tellus sodales
                                                eu. Donec dignissim viverra nunc, ut aliquet magna posuere eget.
                                            </span>
                                        </label>
                                    </div>
                                    <div class="policy-text">
                                        Your personal data will be used to process your order, support your experience
                                        throughout this website, and for other purposes described in our <a
                                            href="{{ route('privacy') }}" target="_blank">privacy policy</a>.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-checkout">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            loadCheckoutData();

            document.querySelectorAll('input[name="shipping"]').forEach(function(radio) {
                radio.addEventListener('change', function(event) {
                    let selectedRadio = event.target;
                    let shippingPrice = parseFloat(selectedRadio.getAttribute('data-price'));
                    let subtotal = parseFloat($('.checkout-total').text().replace(' Tk', ''));

                    if (!isNaN(subtotal) && !isNaN(shippingPrice)) {
                        let grandTotal = subtotal + shippingPrice;
                        $('.checkout-grandtotal').text(grandTotal.toFixed(2) + ' Tk');
                    } else {
                        console.error(
                            'Invalid subtotal or shipping price, unable to calculate total.');
                    }
                });
            });

        });
    </script>
@endsection
