
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px #0000000d;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 26px;
        }

        h2 {
            font-size: 20px;
        }

        .subtitle {
            color: #64748b;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin: 22px 0;
        }

        .form-group {
            flex: 1;
            min-width: 230px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
            text-align: left;
        }

        th, td {
            padding: 13px 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            font-weight: normal;
            margin: 0;
        }

        .radio-group input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .primary {
            background: #2563eb;
            color: white;
        }

        .secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
        }

        .H { background: #dcfce7; color: #166534; }
        .A { background: #fee2e2; color: #b91c1c; }
        .I { background: #fef3c7; color: #92400e; }
        .S { background: #dbeafe; color: #1e40af; }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 20px;
        }

        .table-wrap {
            overflow-x: auto;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- FORM ABSENSI -->
    <div class="card">

        <h1>Absensi Mahasiswa</h1>
        <p class="subtitle">
            Input dan pengelolaan kehadiran mahasiswa
        </p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf

            <!-- MATA KULIAH DAN TANGGAL -->
            <div class="form-row">

                <div class="form-group">
                    <label>Mata Kuliah</label>

                    <select name="matakuliah_id" required>
                        <option value="">-- Pilih Mata Kuliah --</option>

                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->id }}">
                                {{ $mk->kode }} - {{ $mk->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Absensi</label>

                    <input type="date"
                           name="tanggal_absensi"
                           required>
                </div>

            </div>

            <!-- TABEL MAHASISWA -->
            <h2>Daftar Mahasiswa</h2>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th style="text-align:center;">
                                Status Kehadiran
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mhs->NIM }}</td>
                                <td>{{ $mhs->name }}</td>

                                <td>
                                    <input type="hidden"
                                           name="mahasiswa_id[{{ $index }}]"
                                           value="{{ $mhs->id }}">

                                    <div class="radio-group">

                                        <label>
                                            <input type="radio"
                                                   name="status_absen[{{ $index }}]"
                                                   value="H"
                                                   required>
                                            H
                                        </label>

                                        <label>
                                            <input type="radio"
                                                   name="status_absen[{{ $index }}]"
                                                   value="A">
                                            A
                                        </label>

                                        <label>
                                            <input type="radio"
                                                   name="status_absen[{{ $index }}]"
                                                   value="I">
                                            I
                                        </label>

                                        <label>
                                            <input type="radio"
                                                   name="status_absen[{{ $index }}]"
                                                   value="S">
                                            S
                                        </label>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>

            <button type="submit" class="btn primary">
                Simpan Absensi
            </button>

            <a href="{{ route('matakuliah.index') }}"
               class="btn secondary">
                Halaman Mata Kuliah
            </a>

        </form>
    </div>

    <!-- RIWAYAT ABSENSI -->
    <div class="card">

        <h2>Riwayat Absensi</h2>
        <p class="subtitle">
            Daftar data absensi yang telah disimpan
        </p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($absensi as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->NIM }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->nama_matakuliah }}</td>
                            <td>{{ $data->tanggal_absensi }}</td>
                            <td>
                                <span class="status {{ $data->status_absen }}">
                                    @if ($data->status_absen == 'H')
                                        Hadir
                                    @elseif ($data->status_absen == 'A')
                                        Alpa
                                    @elseif ($data->status_absen == 'I')
                                        Izin
                                    @else
                                        Sakit
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada riwayat absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
