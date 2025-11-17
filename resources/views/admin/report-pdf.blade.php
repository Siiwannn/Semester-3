<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Semua Mahasiswa</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;

        }

        .header{
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;

        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;

        }

        th,td{
            border:1px solid #ddd;
            padding: 8px;
            text-align: left;

        }

        th{
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .profile-img-small{
            width: 40px;
            height: 40px;
            border-radius: 50px;
            object-fit: cover;
            border: 1px solid #ddd;
            display: block;
            margin: auto;
        }

        .no-image{
            width: 40px;
            height: 40px;
            border-radius: 50px;
            background: #ddd;
            object-fit: cover;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            margin: auto;
            color: #666;
        }

        .footer{
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #666;
            padding-top: 8px;
        }

        .text-center{
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="header">
      <h2>Data Semua Mahasiswa</h2>
      <h3>Universitas Pamulang</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Foto</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Angkatan</th>
                <th>No. Hp</th>
                <th>Tgl Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $index => $mahasiswa)
            <tr>
                <td class="text-center">{{$index + 1 }}</td>
                <td class="text-center">
                    @if ($mahasiswa->gambar)
                    @if (file_exists(public_path('app/public/gambar/'.$mahasiswa->gambar)))
                    <img src="{{ public_path('app/public/gambar/'.$mahasiswa->gambar)}}" alt="" class="
                    profile-img-small"> 
                    @elseif(file_exists(public_path('storage/'.$mahasiswa->gambar)))
                    <img src="{{ public_path('storage/'.$mahasiswa->gambar)}}" alt="" class="
                    profile-img-small"> 
                    @else
                    <div class="no-image">NO IMG</div>
                    @endif
                    @else
                    <div class="no-image">NO IMG</div>
                    @endif
                </td>
                <td class="text-center">{{$mahasiswa->nim }}</td>
                <td class="text-center">{{$mahasiswa->nama }}</td>
                <td class="text-center">{{$mahasiswa->prodi }}</td>
                <td class="text-center">{{$mahasiswa->angkatan }}</td>
                <td class="text-center">{{$mahasiswa->no_hp }}</td>
                <td class="text-center">{{$mahasiswa->tgl_lahir }}</td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Total : {{$mahasiswas->count()}} Mahasiswa | Dicetak {{ \Carbon\Carbon::now()->format('d F Y')}}
    </div>
</body>
</html>