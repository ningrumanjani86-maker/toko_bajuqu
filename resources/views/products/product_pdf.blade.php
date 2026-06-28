<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Toko bajuqu</title>

    <style>
        body{
            font-size: 12px;
            color: #2f0381;
        }
        .header{
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid coral;
            padding-bottom: 10px;
        }
        .title{
            font-size: 18px;
            font-weight: bold;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th{
            background-color: #f2f2f2;
            font-weight: bold;
            border: 1px solid #ddd;
            padding: 8px;
        }
        td{
            border: 1px solid #ddd;
            padding:8px;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class= "header">
        <div class="title">LAPORAN DATA PRODUK 'Toko bajuqu'</div>
        <p>dicetak secara otomatis oleh sistem</p>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $p)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>Rp. {{ number_format($p->harga,0,',','.') }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ $p->category->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>