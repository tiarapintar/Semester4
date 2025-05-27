<!DOCTYPE html>
<html>
<head>
    <title>Kontak Saya</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f1f1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #25D366;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1ebe5d;
        }
    </style>
</head>
<body>
    <h1>Kontak</h1>
    <form method="get" onsubmit="kirimWA(event)">
        <label for="namaPenghubung">Nama Penghubung:</label>
        <input type="text" name="nama" id="namaPenghubung"/>

        <label for="perusahaan">Perusahaan:</label>
        <input type="text" name="nama" id="perusahaan"/>

        <label for="alasan">Alasan Mengontak:</label>
        <select name="alasan" id="alasan">
            <option value="Pilih alasan">--Pilih--</option>
            <option value="Bekerja sama">Kerjasama</option>
            <option value="Kenalan">Kenalan</option>
        </select>

        <button type="submit">Kirim WA</button>
    </form>

    <script>
        function kirimWA(event) {
            event.preventDefault();

            var nama = document.getElementById("namaPenghubung").value;
            var perusahaan = document.getElementById("perusahaan").value;
            var alasan = document.getElementById("alasan").value;

            var pesan = `Halo, saya ${nama} dari ${perusahaan}, ingin ${alasan}`;
            var nomorTujuan = "6281234567890"; // Ganti nomor sesuai kebutuhan
            var url = `https://wa.me/${nomorTujuan}?text=${encodeURIComponent(pesan)}`;

            window.open(url, "_blank");
        }
    </script>
</body>
</html>
