@extends('mail.base')

@section('main')
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
        <tr style="border-collapse:collapse">
            <td align="left" style="padding:0;Margin:0;padding-bottom:15px">
                <h2 style="margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333">
                    Hi, Admin! <br>
                    New order #{{ $order['id'] ?? '' }} was created at {{ $order['created_at'] ?? '' }}
                </h2>
            </td>
            @if($products)
                <td align="left" style="padding:0;Margin:0;padding-top:20px">
                    <p>Your order:</p>
                    <table style="width: 100%;">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product['title'] }}</td>
                                <td>{{ round($product['price'] * $order['rate']) }} {{ $order['currency'] }}</td>
                                <td>{{ $product['pivot']['count'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            @endif
        </tr>
    </table>
@endsection
