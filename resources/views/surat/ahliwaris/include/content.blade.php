<p>Kami yang bertanda tangan dibawah ini adalah ahli waris yang sah dari {{ $row->nama_alm_almh }} yang 
    meninggal dunia pada hari {{ $row->haritanggal }} di {{ $row->tempat }} berdasarkan surat keterangan 
    Kematian Penduduk no. {{ $row->no_kematian }} tanggal {{ format_date($row->tgl_kematian) }}.</p>

<p>Dengan ini menyatakan dengan sebenarnya bahwa hubungan kami dengan almarhum/almarhumah adalah sebagai berikut :</p>
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
            <td style="padding: 5px 0;">Jenis Kelamin</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->gender == 1 ? "Laki-Laki" : "Perempuan" }}</td>
        </tr>
         <tr>
            <td style="padding: 5px 0;">Tempat / Tanggal Lahir</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->birthplace }}, {{ $row->userOne->birthdate }}</td>
        </tr>
        <tr>
            <td style="padding: 5px 0;">Alamat</td>
            <td style="padding: 5px 0;">: {{ $row->userOne->alamat }}</td>
        </tr>
    </tbody>
</table>
<p style="margin-top: 16px;">
    Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>