<p>Yang bertanda tangan dibawah ini :</p>
<table style="width: 100%; border-collapse: collapse;  margin-bottom: 20px;">
    <tbody>
        <tr>
            <td style="width: 30%; padding: 5px 0;">Nama</td>
            <td style="padding: 5px 0;">: {{ $user->name }}</td>
            </tr>
        <tr>
            <td style="padding: 5px 0;">Jabatan</td>
            <td style="padding: 5px 0;">: {{ $user->level != "LURAH" ? "KEPALA DESA TARUM" : "-" }}</td>
        </tr>
    </tbody>
</table>
<p>Menerangkan dengan sebenarnya bahwa :</p>
<table style="width: 100%; border-collapse: collapse;  margin-bottom: 20px;">
    <tbody>
        <tr>
            <td style="width: 30%; padding: 5px 0;">Nama</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->name }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Jenis Kelamin</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->gender == 1 ? "Laki-Laki" : "Perempuan" }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Tempat / Tanggal Lahir</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->birthplace }}, {{ $row->userOne->birthdate }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Kewarganegaraan</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->kewarganegaraan }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Agama</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->agama }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Pekerjaan</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->pekerjaan }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Status Perkawinan</td>
            @if($row->userOne->status == 1)
                <td style="padding: 5px 0;">: Belum Kawin</td>
            @elseif($row->userOne->status == 2)
                <td style="padding: 5px 0;">: Kawin</td>
            @elseif($row->userOne->status == 3)
                <td style="padding: 5px 0;">: Cerai Hidup</td>
            @else
                <td style="padding: 5px 0;">: Cerai Mati</td>
            @endif
        </tr>
        <tr>
            <td style="padding: 5px 0;">Pendidikan</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->pendidikan }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">No. KTP</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->nik }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Alamat</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->alamat }}</td>
        </tr>
    </tbody>
</table>
<p>Adalah benar-benar penduduk Desa Tarum Kecamatan Prajekan Kabupaten Bondowoso dan dalam catatan Administrasi Desa yang bersangkutan berkelakuan baik.</p>
<center>    
    <p>Surat Keterangan ini diberikan kepada yang bersangkutan sebagai persyaratan :</p>
    <b> ------ : {{ $row->keperluan }} : ------ </b>
</center>
<p style="margin-top: 16px;">
    Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>