<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa</title>
</head>
<body>
    <h2>Registrasi Mahasiswa</h2>
    <form action="/register-mahasiswa" method="POST">
        @csrf
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required pattern="[0-9]{8}" title="NIM harus terdiri dari 8 digit angka"><br>
        <label for="nama_mahasiswa">Nama Mahasiswa:</label><br>
        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required><br>
        <label for="jurusan">Jurusan:</label><br>
        <input type="text" id="jurusan" name="jurusan" required><br>
        <label for="prodi">Program Studi:</label><br>
        <input type="text" id="prodi" name="prodi" required><br>
        <label for="angkatan">Angkatan:</label><br>
        <input type="text" id="angkatan" name="angkatan" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
