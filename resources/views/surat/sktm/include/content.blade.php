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
            <td style="padding: 5px 0;">No. KTP</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->nik }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Tempat / Tanggal Lahir</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->birthplace }}, {{ $row->userOne->birthdate }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Jenis Kelamin</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->gender == 1 ? "Laki-Laki" : "Perempuan" }}</td>
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
            <td style="padding: 5px 0;">Alamat</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->alamat }}</td>
        </tr>
    </tbody>
</table>
<p>Nama tersebut diatas adalah benar-benar penduduk Desa Tarum Kecamatan Prajekan Kabupaten Bondowoso dan yang bersangkutan benar-benar tergolong keluarga tidak mampu atau berpenghasilan rendah/minim.</p>
<p style="margin-top: 16px;">
    Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>