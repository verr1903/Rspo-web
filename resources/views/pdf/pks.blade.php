<!DOCTYPE html>
<html>

<head>
    <title>Rekap Pks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 1px 1px 5px #ccc;
        }

        .card h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .col {
            width: 32%;
            text-align: center;
        }

        .col img {
            width: 100%;
            max-width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .col label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3>Detail Pengiriman</h3>

        <!-- Tabel Info -->
        <table>
            <tr>
                <th>Tanggal Pengiriman</th>
                <td>{{ $pks->tanggal_pengiriman }}</td>
            </tr>
            <tr>
                <th>Nama PKS</th>
                <td>{{ $pks->nama_pks }}</td>
            </tr>
            <tr>
                <th>Tujuan Pengiriman</th>
                <td>{{ $pks->tujuan_pengiriman }}</td>
            </tr>
            <tr>
                <th>Nomor Blanko PB 33</th>
                <td>{{ $pks->nomor_blanko_pb33 }}</td>
            </tr>
            <tr>
                <th>Nopol Mobil</th>
                <td>{{ $pks->nopol_mobil }}</td>
            </tr>
            <tr>
                <th>Nama Supir</th>
                <td>{{ $pks->nama_supir }}</td>
            </tr>
        </table>

        <!-- 3 Gambar -->
        <!-- 3 Gambar -->
        <table style="width: 100%; margin-top: 20px; text-align: center;">
            <tr>
                <td style="text-align: center; vertical-align: top;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Gambar 1</label>
                    <img src="{{ public_path('storage/' . $pks->foto_keseluruhan_pks) }}"
                        style="width: 150px; height: 150px; object-fit: cover; border-radius:5px; border:1px solid #ccc; display: block; margin: auto;">
                </td>
                <td style="text-align: center; vertical-align: top;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Gambar 2</label>
                    <img src="{{ public_path('storage/' . $pks->foto_sebelum_pks) }}"
                        style="width: 150px; height: 150px; object-fit: cover; border-radius:5px; border:1px solid #ccc; display: block; margin: auto;">
                </td>
                <td style="text-align: center; vertical-align: top;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Gambar 3</label>
                    <img src="{{ public_path('storage/' . $pks->foto_sesudah_pks) }}"
                        style="width: 150px; height: 150px; object-fit: cover; border-radius:5px; border:1px solid #ccc; display: block; margin: auto;">
                </td>
            </tr>
        </table>



    </div>
</body>

</html>