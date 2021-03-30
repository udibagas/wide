<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border: 2px solid #000;
            margin: 0 2px 2px 0;
            display: inline-block;
        }

        .price {
            font-size: 16px;
            font-weight: bold;
            transform: rotate(-90deg);
            white-space: nowrap;
            position: absolute;
            margin-left: -28px;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    @foreach ($vouchers as $index => $voucher)

    <table>
        <tbody>
            <tr>
                <td style="width:20px;position:relative;border-right:2px solid #000">
                    <div class="price">
                        Rp {{number_format($voucher->price, 0, ',', '.')}}
                    </div>
                </td>
                <td>
                    <strong>{{$voucher->site}}</strong>
                    <div class="code">{{$voucher->code}}</div>

                    <div>
                        <small>
                            Aktif: {{ $voucher->validity }} Durasi: {{$voucher->uptime}} <br>
                            http://{{$voucher->dns}}
                        </small>
                    </div>
                </td>
                <td style="vertical-align: top;position:relative;">
                    <img src="/images/wide.png" alt="" style="width:40px">

                    <div style="position: absolute; bottom:2px;right:2px;font-size:12px;">[{{$index + 1}}]</div>
                </td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>
</html>
