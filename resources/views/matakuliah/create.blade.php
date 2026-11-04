
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
</head>
<body>

    <h1>Tambah Mata Kuliah</h1>

    <form action="{{ route('matakuliah.store') }}" method="POST">
        @csrf

        <label>Kode Mata Kuliah</label>
        <br>
        <input type="text" name="kode" value="{{ old('kode') }}">
        @error('kode')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Nama Mata Kuliah</label>
        <br>
        <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}">
        @error('nama_matakuliah')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Simpan</button>

        <a href="{{ route('matakuliah.index') }}">Kembali</a>
    </form>

</body>
</html>
