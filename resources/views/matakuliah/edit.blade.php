
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mata Kuliah</title>
</head>
<body>

    <h1>Edit Mata Kuliah</h1>

    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Kode Mata Kuliah</label>
        <br>
        <input type="text" name="kode"
               value="{{ old('kode', $matakuliah->kode) }}">

        @error('kode')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Nama Mata Kuliah</label>
        <br>
        <input type="text" name="nama_matakuliah"
               value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}">

        @error('nama_matakuliah')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Update</button>

        <a href="{{ route('matakuliah.index') }}">Kembali</a>
    </form>

</body>
</html>
