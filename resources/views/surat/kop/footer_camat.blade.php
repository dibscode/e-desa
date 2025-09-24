<div style="margin-top: 50px;">
    <div style="display: flex; justify-content: space-between; text-align: center; width: 100%;">
        <!-- Kepala Camat (Kiri) -->
        <div style="width: 32%; font-family: Arial, sans-serif; font-size: 14px;">
            <div>
                <p style="margin: 0;">Mengetahui,</p>
                <p style="margin: 0;">Camat Prajekan</p>
            </div>
            <img src="{{ asset('images/ttd_lurah.jpg') }}" alt="Signature Camat" style="width: 120px; height: auto; margin-bottom: 10px;">
            <div>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase; border-bottom: 1.5px solid; display: inline-block;">
                    {{ 'Ir. EDY SUBAGIO. M.Si' }}
                </p>
                <p style="margin: 0; font-weight: bold;text-transform: uppercase">
                    Pembina Tingkat I
                </p>
                <p style="margin: 0; font-weight: bold;text-transform: uppercase">
                    NIP.196611241996021001
                </p>
            </div>
        </div>
        <!-- Kepala Desa (Tengah) -->
        <div style="width: 32%; font-family: Arial, sans-serif; font-size: 14px;">
            <div>
                <p style="margin: 0;">&nbsp;</p>
                <p style="margin: 0;">&nbsp;</p>
                <p style="margin: 0;">&nbsp;</p>
                <p style="margin: 0;">Mengetahui,</p>
                <p style="margin: 0;">Kepala Desa Tarum</p>
            </div>
            <img src="{{ asset('images/ttd_lurah.jpg') }}" alt="Signature Kades" style="width: 120px; height: auto; margin-bottom: 10px;">
            <div>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase; border-bottom: 1.5px solid; display: inline-block;">
                    {{ $user->name ?? 'Nama Kepala Desa' }}
                </p>
            </div>
        </div>
        <!-- Masyarakat (Kanan) -->
        <div style="width: 32%; font-family: Arial, sans-serif; font-size: 14px;">
            <div>
                <p style="margin: 0;">{{ "Tarum, ".format_date($row->date) }}</p>
                <p style="margin: 0;">Yang Menyatakan,</p>
            </div>
            <img src="{{ asset('images/ttd_lurah.jpg') }}" alt="Signature Masyarakat" style="width: 120px; height: auto; margin-bottom: 10px;">
            <div>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase; border-bottom: 1.5px solid; display: inline-block;">
                    {{ $row->userOne->name }}
                </p>
            </div>
        </div>
    </div>
</div>