
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 35px;
            color: #1e293b;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0000000d;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }
        h1 { margin: 0 0 8px; font-size: 26px; }
        .subtitle { color: #64748b; margin: 0; }
        a, button {
            text-decoration: none;
            border: none;
            border-radius: 7px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 14px;
        }
        .add { background: #2563eb; color: white; }
        .add:hover { background: #1d4ed8; }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
        }
        th {
            background: #eff6ff;
            color: #1e40af;
            text-align: left;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        tr:hover td { background: #f8fafc; }
        .edit { background: #fef3c7; color: #92400e; }
        .delete { background: #fee2e2; color: #b91c1c; }
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }
        .empty { text-align: center; color: #64748b; padding: 25px; }
        form { display: inline; }
    </style>
</head>
<body>

<div class="container">

    <div class="top">
        <div>
            <h1>Data Mata Kuliah</h1>
            <p class="subtitle">Kelola daftar mata kuliah</p>
        </div>

        <a href="{{ route('matakuliah.create') }}" class="add">
            + Tambah Mata Kuliah
        </a>
    </div>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($matakuliah as $index => $mk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mk->kode }}</td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td>
                        <a href="{{ route('matakuliah.edit', $mk->id) }}"
                           class="edit">Edit</a>

                        <form action="{{ route('matakuliah.destroy', $mk->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">
                        Belum ada data mata kuliah.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="color:#64748b; font-size:13px; margin-top:20px;">
        Total mata kuliah: {{ $matakuliah->count() }}
    </p>

    <a href="{{ route('absensi.index') }}" class="add">
        Buka Halaman Absensi
    </a>

</div>

</body>
</html>
