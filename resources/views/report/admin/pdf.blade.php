<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Admin</title>

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
    <h3 class="text-center">Laporan Data Admin</h3>
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
                <th style="border: 1px solid black; text-align: center;">No</th>
                <th style="border: 1px solid black; text-align: center;">Kode</th>
                <th style="border: 1px solid black; text-align: center;">Nama</th>
                <th style="border: 1px solid black; text-align: center;">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item->code }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item->name }}</td>
                    <td style="border: 1px solid black; text-align: center;">{{ $item->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
