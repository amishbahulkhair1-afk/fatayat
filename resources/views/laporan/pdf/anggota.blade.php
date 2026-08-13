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
    <h2>Laporan Anggota</h2>
    <p class="subtitle">Fatayat NU PAC Pragaan - {{ date('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>No KTA</th>
                <th>PR</th>
                <th>PAR</th>
                <th>Tgl Bergabung</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->no_kta ?? '-' }}</td>
                    <td>{{ $item->pr->nama ?? '-' }}</td>
                    <td>{{ $item->par->nama ?? '-' }}</td>
                    <td>{{ $item->tanggal_bergabung }}</td>
                    <td>{{ $item->status_anggota }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
