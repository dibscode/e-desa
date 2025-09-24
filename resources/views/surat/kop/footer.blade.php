<div style="margin-top: 50px;">
    <div style="display: flex; justify-content: flex-end; text-align: center; width: 100%;">
        <div style="width: 50%; font-family: Arial, sans-serif; font-size: 14px;">
            <div>
                <p style="margin: 0;">{{ "Tarum, ".format_date($row->date) }}</p>
                <p style="margin: 0;">Kepala Desa Tarum</p>
            </div>
            <img src="{{ asset('images/ttd_lurah.jpg') }}" alt="Signature Kades" style="width: 150px; height: auto; margin-bottom: 10px;">
            <div>
                <p style="margin: 0; font-weight: bold; text-transform: uppercase; border-bottom: 1.5px solid; display: inline-block;">
                    {{  $user->name }}
                </p>
                <!--<p style="margin: 0; font-weight: bold;text-transform: uppercase">
                    NIP : 197402681993032003
                </p>-->
            </div>
        </div>
    </div>
</div>