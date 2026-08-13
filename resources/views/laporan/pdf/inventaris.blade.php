<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
        }

        p.subtitle {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Laporan Inventaris</h2>
    <p class="subtitle">Fatayat NU PAC Pragaan - {{ date('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->kode_inventaris }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->satuan ?? '-' }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->lokasi_penyimpanan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
