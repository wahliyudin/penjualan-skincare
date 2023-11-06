<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Transaksi</title>

    <style>
        .text-center {
            text-align: center;
        }

        .m-2 {
            margin: 2px !important;
        }

        /* @page {
            size: A4 landscape;
        } */
    </style>
</head>

<body>
    <h1 class="text-center">{{ env('APP_NAME') }}</h1>
    <hr class="m-2">
    <hr class="m-2">
    <h3 class="text-center">Data Transaksi</h3>
    <table>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ now()->translatedFormat('d F Y') }}</td>
        </tr>
    </table>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 10px;">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="padding: 5px; border: 1px solid black; text-align: center;">No</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Nama Barang</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Harga</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Jumlah</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
            @forelse ($data as $item)
                <tr style="border: 1px solid black;">
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">
                        {{ $item->product?->name }}
                    </td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center; text-align: right;">
                        {{ number_format($item->product?->price, 0, ',', '.') }}
                    </td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">
                        {{ $item->quantity }}
                    </td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center; text-align: right;">
                        {{ number_format($item->product?->price * $item->quantity, 0, ',', '.') }}
                    </td>
                </tr>
                @php
                    $grandTotal += $item->product?->price * $item->quantity;
                @endphp
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 5px;">No Data Available</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td style="padding: 5px; border: 1px solid black; text-align: center;" colspan="4">Jumlah</td>
                <td style="padding: 5px; border: 1px solid black; text-align: right;">
                    {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <table style="margin-top: 10px; width: 100%; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="width: 70%;"></td>
                <td style="width: 30%; text-align: center; font-weight: bold;">Author</td>
            </tr>
            <tr>
                <td style="height: 40px;"></td>
                <td style="height: 40px;"></td>
            </tr>
            <tr>
                <td style="height: 40px;"></td>
                <td style="height: 40px;"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">{{ auth()->user()->name }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
