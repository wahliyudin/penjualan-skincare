<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Penjualan</title>

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
    <h3 class="text-center">Laporan Data Penjualan</h3>
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
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Kode</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Tanggal</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Admin</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Pelanggan</th>
                <th style="padding: 5px; border: 1px solid black; text-align: center;">Barang</th>
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
                        {{ $item->transaction?->code }}</td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">
                        {{ \Carbon\Carbon::parse($item->transaction?->created_at)->format('d-m-Y') }}
                    </td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">
                        {{ $item->transaction?->admin?->name }}
                    </td>
                    <td style="padding: 5px; border: 1px solid black; text-align: center;">
                        {{ $item->transaction?->customer?->name }}
                    </td>
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
                <td style="padding: 5px; border: 1px solid black; text-align: center;" colspan="8">Jumlah</td>
                <td style="padding: 5px; border: 1px solid black; text-align: right;">
                    {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
