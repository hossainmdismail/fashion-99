<?php
use App\Models\Config;

$config = Config::first();
$total = 0;

?>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #e7e7e7;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.cost {
            text-align: "." center;
        }
    </style>
</head>

<body>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        {{-- @if ($config)
            <link rel="shortcut icon" href="{{ asset('files/config/'.$config->logo) }}" type="image/x-icon">
            <tr>
                <td width="100%" style="padding: 0px; text-align: center;">
                  <a href="#" target="_blank">
                    <img src="{{ asset('files/config/'.$config->logo) }}" width="264" height="110" alt="Logo" align="center" border="0">
                  </a>
                </td>
            </tr>
        @endif --}}

        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
                INVOICE
            </td>
        </tr>
        <tr>
            <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="49%">{{ $data->name }}<br>{{ $data->number }}<br>{{ $data->email }}<br>{{ $data->address }}
            </td>
            <td width="2%">&nbsp;</td>
            <td width="49%" style=" text-align: right;"><strong>{{ $config->name }}</strong><br>
                {{ $config->address }}<br><br><br>
                <strong>Phone:</strong> {{ $config->number }}<br>
                <strong>Email:</strong> {{ $config->email }}<br>
                <a href="{{ $config->url }}" target="_blank"
                    style="color: #000; text-decoration: none;">{{ $config->url }}</a><br>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;">
        <tr>
            <td>
                <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                    </tr>
                </table>
                <table width="30%" align="right" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Date</strong></td>
                        <td style="padding: 0px 8px; line-height: 20px;">{{ $data->created_at->format('M D y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>ID</strong></td>
                        <td style="padding: 0px 8px; line-height: 20px;">{{ $data->order_id }}</td>
                    </tr>
        </tr>
    </table>
    </td>
    </tr>
    </table>
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="45%" style="text-align: left;"><strong>Description</strong></td>
                <td width="20%" style="text-align: left;"><strong>Amount</strong></td>
                <td width="15%" style="text-align: left;"><strong>QNT</strong></td>
                <td width="20%" style="text-align: left;"><strong>Total Trip Cost</strong></td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            @foreach ($data->products as $key => $product)
                <tr>
                    <td style="padding: 0px 7px; line-height: 20px;">
                        {{ $product->product ? $product->product->product->name : 'Unknown' }} <span
                            style="font-size: 11px;color:gray">{{ $product->product->color ? $product->product->color->name : 'Unknown' }}/{{ $product->product->size ? $product->product->size->name : 'Unknown' }}</span>
                    </td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $product->price }} Tk</td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $product->qnt }}</td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $product->price * $product->qnt }} Tk</td>
                    <?php $total += $product->price * $product->qnt; ?>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;">
        <tr>
            <td>
                <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                    </tr>
                </table>
                <table width="40%" align="right" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Total Amount</strong></td>
                        <td style="padding: 0px 8px; line-height: 20px;">{{ $total }} Tk</td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Shipping fee</strong></td>
                        <td style="padding: 0px 8px; line-height: 20px;">{{ $data->shipping_charge }} Tk</td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Grand total</strong></td>
                        <td style="padding: 0px 8px; line-height: 20px;">{{ $data->price }} Tk</td>
                    </tr>
                    @if ($data->payment)
                        <tr>
                            <td style="padding: 0px 8px; line-height: 20px;"><strong>Paid</strong></td>
                            <td style="padding: 0px 8px; line-height: 20px;">{{ $data->totalPayment() }} Tk</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 8px; line-height: 20px;"><strong>Due</strong></td>
                            <td style="padding: 0px 8px; line-height: 20px;">
                                {{ number_format($data->price - $data->totalPayment()) }} Tk</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
    <br>

</body>

</html>
