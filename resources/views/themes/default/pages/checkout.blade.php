@extends('themes.default.layout.app')
@section('style')
    <style>
        .custom-radio-card {
            margin: 15px 0;
            border: 1px solid #22222221;
            border-radius: 8px;
            background-color: #f9f9f9;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .custom-radio-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-color: #222222;
        }

        .custom-radio-card input[type="radio"] {
            display: none;
            /* Hide default radio button */
        }

        .custom-radio-card .custom-label {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .custom-radio-card .card-content {
            display: flex;
            flex-direction: column;
        }

        .custom-radio-card .service-title {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }

        /* .custom-radio-card .service-duration {
                                                                                                                        font-size: 14px;
                                                                                                                        color: #7a7a7a;
                                                                                                                    } */

        .custom-radio-card .service-price {
            font-size: 14px;
            color: #7a7a7a;
        }

        .custom-radio-card .checkmark {
            background-color: #222222;
            border-radius: 50%;
            height: 24px;
            width: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 16px;
            visibility: hidden;
            /* Initially hidden */
            transition: all 0.3s ease;
        }

        .custom-radio-card input[type="radio"]:checked+.custom-label .checkmark {
            visibility: visible;
            /* Visible only when selected */
        }

        .custom-radio-card input[type="radio"]:checked+.custom-label {
            border-color: #8B3DFF;
        }

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
                                            id="checkout_name" placeholder="Name" value="{{ old('name') }}" name="name"
                                            required>
                                        <label for="checkout_name" class="font-bd">আপনার নাম *</label>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" id="checkout_eamil" placeholder="Email"
                                            name="email" value="{{ old('email') }}">
                                        <label for="checkout_eamil">Email</label>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="phone" class="form-control @error('number') is-invalid @enderror"
                                            id="checkout_number" placeholder="Number *" name="number"
                                            pattern="01[3-9][0-9]{8}" title="অনুগ্রহ করে একটি বৈধ বাংলাদেশের ফোন নম্বর দিন।"
                                            required value="{{ old('number') }}">
                                        <label for="checkout_number" class="font-bd">আপনার মোবাইল নাম্বার *</label>
                                    </div>
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror "
                                            name="address" id="checkout_street_address" placeholder="Street Address *"
                                            value="{{ old('address') }}" required>
                                        <label for="checkout_company_name" class="font-bd">Address - হাউস নং, রোড
                                            নং/গ্রাম,
                                            থানা,
                                            জেলা *</label>
                                    </div>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)" name="message" cols="30"
                                        rows="4">{{ old('message') }}</textarea>
                                </div>
                            </div>
                            <h5 class="pt-4">SHIPPING AREA</h5>
                            <div class="frb-group">
                                {{-- @foreach ($shippings as $key => $shipping)
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
                                @endforeach --}}
                                @foreach ($shippings as $key => $shipping)
                                    <div class="custom-radio-card">
                                        <input type="radio" id="shipping-{{ $key + 1 }}" name="shipping"
                                            value="{{ $shipping->id }}" data-price="{{ $shipping->price }}"
                                            class="@error('shipping') is-invalid @enderror"
                                            {{ old('shipping') == $shipping->id ? 'checked' : '' }}>
                                        <label for="shipping-{{ $key + 1 }}" class="custom-label">
                                            <div class="card-content">
                                                <div class="service-title">{{ $shipping->name }}</div>
                                                <div class="service-price">{{ $shipping->price }}
                                                    {{ __('messages.currency') }}</div>
                                            </div>
                                            <div class="checkmark">
                                                <span>&#10003;</span>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                                <!-- Show error message -->
                                @error('shipping')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                                <td class="shipping-fee">0Tk</td>
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
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary font-bd">অর্ডার করুন</button>
                                </div>
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

            let shippingRadios = document.querySelectorAll('input[name="shipping"]');
            let secondShippingRadio = shippingRadios[1]; // Select the second radio button (index 1)

            console.log(secondShippingRadio);

            if (secondShippingRadio) {
                secondShippingRadio.checked = true;

                let checkSubtotalInterval = setInterval(() => {
                    let subtotalText = $('.checkout-total').text().replace(' Tk', '').trim();
                    let subtotal = parseFloat(subtotalText);

                    if (!isNaN(subtotal)) {
                        clearInterval(checkSubtotalInterval);

                        let shippingPrice = parseFloat(secondShippingRadio.getAttribute('data-price'));
                        let grandTotal = subtotal + shippingPrice;

                        $('.shipping-fee').text(shippingPrice + ' Tk');
                        $('.checkout-grandtotal').text(grandTotal.toFixed(2) + ' Tk');
                    }
                }, 100); // Check every 100ms
            }


            document.querySelectorAll('input[name="shipping"]').forEach(function(radio) {
                radio.addEventListener('change', function(event) {
                    let selectedRadio = event.target;
                    let shippingPrice = parseFloat(selectedRadio.getAttribute('data-price'));
                    let subtotal = parseFloat($('.checkout-total').text().replace(' Tk', '')
                        .trim());

                    if (!isNaN(subtotal) && !isNaN(shippingPrice)) {
                        let grandTotal = subtotal + shippingPrice;
                        $('.shipping-fee').text(shippingPrice + ' Tk');
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
