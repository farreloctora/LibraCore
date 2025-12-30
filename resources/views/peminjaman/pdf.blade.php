<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #10b981;
            margin: 0;
            font-size: 24px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #10b981;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LibraCore</h1>
        <p>Laporan Peminjaman Buku - Admin</p>
    </div>

    <div class="info">
        <p><strong>Tanggal Laporan:</strong> {{ date('d M Y') }}</p>
        @if(!empty($filters['status']))
            <p><strong>Filter Status:</strong> {{ ucfirst($filters['status']) }}</p>
        @endif
        @if(!empty($filters['start_date']) || !empty($filters['end_date']))
            <p><strong>Periode:</strong> 
                {{ $filters['start_date'] ?? 'Awal' }} - {{ $filters['end_date'] ?? 'Akhir' }}
            </p>
        @endif
        <p><strong>Total Peminjaman:</strong> {{ $peminjamans->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->user->name }}<br><small>{{ $peminjaman->user->email }}</small></td>
                    <td>{{ $peminjaman->koleksi->judul }}</td>
                    <td>{{ $peminjaman->koleksi->penulis }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                    <td>{{ $peminjaman->batas_kembali->format('d M Y') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d M Y') : '-' }}</td>
                    <td>{{ ucfirst($peminjaman->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada {{ date('d M Y H:i:s') }} | LibraCore - Sistem Peminjaman Buku Perpustakaan</p>
    </div>
</body>
</html>

