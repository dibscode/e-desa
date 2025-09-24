<?php

use App\Models\Siswa;
use App\Models\Profile;
use App\Models\User;
use App\Models\Jenis;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

//GENERAL
if (! function_exists('is_able')) {
    function is_able($action)
    {
        $role = [
            'admin' => [
                'home',
                // MASTER USER
                'user.index',
                'user.create',
                'user.store',
                'user.edit',
                'user.update',
                'user.destroy',
                'user.password',
                'user.password.update',
                'user.logout',
                'user.profil',
                'user.profil.update',
                'user.autocomplete',
                'user.import',
                // MASTER SURAT
                'surat.index',
                'surat.show',
                'surat.create',
                'surat.store',
                'surat.edit',
                'surat.update',
                'surat.destroy',
                // NIKAH
                'surat_pengantar_nikah.cetak',
                'surat_pengantar_nikah.status',
                'surat_pengantar_nikah.index',
                'surat_pengantar_nikah.show',
                'surat_pengantar_nikah.create',
                'surat_pengantar_nikah.store',
                'surat_pengantar_nikah.edit',
                'surat_pengantar_nikah.update',
                'surat_pengantar_nikah.destroy',
                // SKCK
                'surat_pengajuan_skck.cetak',
                'surat_pengajuan_skck.signature',
                'surat_pengajuan_skck.index',
                'surat_pengajuan_skck.show',
                'surat_pengajuan_skck.create',
                'surat_pengajuan_skck.store',
                'surat_pengajuan_skck.edit',
                'surat_pengajuan_skck.update',
                'surat_pengajuan_skck.destroy',
                // SKTM
                'surat_keterangan_miskin.cetak',
                'surat_keterangan_miskin.signature',
                'surat_keterangan_miskin.index',
                'surat_keterangan_miskin.show',
                'surat_keterangan_miskin.create',
                'surat_keterangan_miskin.store',
                'surat_keterangan_miskin.edit',
                'surat_keterangan_miskin.update',
                'surat_keterangan_miskin.destroy',
                // USAHA
                'surat_keterangan_usaha.cetak',
                'surat_keterangan_usaha.signature',
                'surat_keterangan_usaha.index',
                'surat_keterangan_usaha.show',
                'surat_keterangan_usaha.create',
                'surat_keterangan_usaha.store',
                'surat_keterangan_usaha.edit',
                'surat_keterangan_usaha.update',
                'surat_keterangan_usaha.destroy',
                // AHLI WARIS
                'surat_ahliwaris.cetak',
                'surat_ahliwaris.signature',
                'surat_ahliwaris.index',
                'surat_ahliwaris.show',
                'surat_ahliwaris.create',
                'surat_ahliwaris.store',
                'surat_ahliwaris.edit',
                'surat_ahliwaris.update',
                'surat_ahliwaris.destroy',
                // BEDA NAMA
                'surat_bedanama.cetak',
                'surat_bedanama.signature',
                'surat_bedanama.index',
                'surat_bedanama.show',
                'surat_bedanama.create',
                'surat_bedanama.store',
                'surat_bedanama.edit',
                'surat_bedanama.update',
                'surat_bedanama.destroy',
                // DOMISILI
                'surat_domisili.cetak',
                'surat_domisili.signature',
                'surat_domisili.index',
                'surat_domisili.show',
                'surat_domisili.create',
                'surat_domisili.store',
                'surat_domisili.edit',
                'surat_domisili.update',
                'surat_domisili.destroy',
                // KEHILANGAN
                'surat_kehilangan.cetak',
                'surat_kehilangan.signature',
                'surat_kehilangan.index',
                'surat_kehilangan.show',
                'surat_kehilangan.create',
                'surat_kehilangan.store',
                'surat_kehilangan.edit',
                'surat_kehilangan.update',
                'surat_kehilangan.destroy',
                // PAJAK
                'pajak.index',
                'pajak.show',
                'pajak.create',
                'pajak.store',
                'pajak.edit',
                'pajak.update',
                'pajak.destroy',
                // LAPOR (admin panel)
                'admin.lapor.index',
                'admin.lapor.show',
                'admin.lapor.create',
                'admin.lapor.store',
                'admin.lapor.edit',
                'admin.lapor.update',
                'admin.lapor.destroy',
                // PROFIL
                'profile.index',
                'profile.show',
                'profile.create',
                'profile.store',
                'profile.edit',
                'profile.update',
                'profile.destroy',
            ],
        ];
        $user = Auth::user();
        if ($user) {
            if (in_array($user->level, array_keys($role))) {
                return in_array($action, $role[$user->level]);
            }
        }
    }

    // close if (! function_exists('is_able')) wrapper
}

    function get_aktif_option($selected = '')
    {
        $arr = array(
            '1' => 'Aktif',
            '0' => 'NonAktif',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_jk_option($selected = '')
    {
        $arr = array(
            1 => 'Laki-Laki',
            2 => 'Perempuan',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_status_option($selected = '')
    {
        $arr = array(
            1 => 'Belum Kawin',
            2 => 'Kawin',
            3 => 'Cerai Hidup',
            4 => 'Cerai Mati',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_lj_option($selected = '')
    {
        $arr = array(
            0 => 'Pelanggaran',
            1 => 'Reward',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_author_option($selected = '')
    {
        $arr = array(
            0 => 'Untuk Siswa',
            1 => 'Untuk Guru',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_kategori_jenis_option($selected = '')
    {
        $arr = array(
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
        );
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_Poin_option($kode_jenis, $selected = '')
    {
        $arr = get_Poin();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($val->kode_jenis == $kode_jenis) {
                if ($key == $selected)
                    $a .= '<option value="' . $key . '" selected>' . $key . ' - ' . $val->nama_Poin . '</option>';
                else
                    $a .= '<option value="' . $key . '">' . $key . ' - ' . $val->nama_Poin . '</option>';
            }
        }
        return $a;
    }

    function get_jenis_pelanggaran_siswa_option($selected = '')
    {
        $arr = get_jenis_pelanggaran_siswa();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
            else
                $a .= '<option value="' . $key . '" data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
        }
        return $a;
    }

    function get_jenis_reward_siswa_option($selected = '')
    {
        $arr = get_jenis_reward_siswa();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
            else
                $a .= '<option value="' . $key . '" data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
        }
        return $a;
    }

    function get_jenis_pelanggaran_guru_option($selected = '')
    {
        $arr = get_jenis_pelanggaran_guru();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
            else
                $a .= '<option value="' . $key . '" data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
        }
        return $a;
    }

    function get_jenis_reward_guru_option($selected = '')
    {
        $arr = get_jenis_reward_guru();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
            else
                $a .= '<option value="' . $key . '" data-jumlah_poin="' . $val->jumlah_poin . '">' . $val->nama_jenis . '</option>';
        }
        return $a;
    }

    function get_siswa_option($selected = '')
    {
        $arr = get_siswa();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected>' . $val->kode_siswa . ' - ' . $val->nama_siswa . '</option>';
            else
                $a .= '<option value="' . $key . '">' . $val->kode_siswa . ' - ' . $val->nama_siswa . '</option>';
        }
        return $a;
    }

    function get_guru_option($selected = '')
    {
        $arr = get_guru();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected>' . $val->username . ' - ' . $val->nama_user . '</option>';
            else
                $a .= '<option value="' . $key . '">' . $val->username . ' - ' . $val->nama_user . '</option>';
        }
        return $a;
    }

    function get_kelas_option($selected = '')
    {
        $arr = get_kelas();
        $a = '';
        foreach ($arr as $key => $val) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected>' . $val->kode_kelas . ' - ' . $val->nama_kelas . '</option>';
            else
                $a .= '<option value="' . $key . '">' . $val->kode_kelas . ' - ' . $val->nama_kelas . '</option>';
        }
        return $a;
    }

    function get_jenis_pelanggaran_siswa()
    {
        $rows = Jenis::where('level', 0)->where('author', 0)->orderBy('kode_jenis')->get();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_jenis] = $row;
        }
        return $arr;
    }

    function get_jenis_reward_siswa()
    {
        $rows = Jenis::where('level', 1)->where('author', 0)->orderBy('kode_jenis')->get();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_jenis] = $row;
        }
        return $arr;
    }

    function get_jenis_pelanggaran_guru()
    {
        $rows = Jenis::where('level', 0)->where('author', 1)->orderBy('kode_jenis')->get();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_jenis] = $row;
        }
        return $arr;
    }

    function get_jenis_reward_guru()
    {
        $rows = Jenis::where('level', 1)->where('author', 1)->orderBy('kode_jenis')->get();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_jenis] = $row;
        }
        return $arr;
    }

    function get_siswa()
    {
        $rows = get_results("SELECT * FROM tb_siswa ORDER BY kode_siswa");
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_siswa] = $row;
        }
        return $arr;
    }

    function get_guru()
    {
        $rows = get_results("SELECT * FROM tb_user WHERE level IN ('staff', 'guru') ORDER BY username");
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->username] = $row;
        }
        return $arr;
    }

    function get_kelas()
    {
        $rows = get_results("SELECT * FROM tb_kelas ORDER BY kode_kelas");
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_kelas] = $row;
        }
        return $arr;
    }

    function get_Poin()
    {
        $rows = get_results("SELECT * FROM tb_poin ORDER BY id_poin");
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->id_poin] = $row;
        }
        return $arr;
    }

    function is_hidden($action)
    {
        return is_able($action) ? '' : 'hidden';
    }

    function is_admin()
    {
        return Auth::user()->level == 'admin';
    }

    function is_user()
    {
        return Auth::user()->level == 'user';
    }

    function is_siswa()
    {
        return Auth::user()->level == 'siswa';
    }

    function is_guru()
    {
        return Auth::user()->level == 'guru';
    }

    function current_siswa()
    {
        $siswa = Siswa::where('id_user', Auth::id())->first();
        if ($siswa)
            return $siswa->kode_siswa;
    }

    function current_guru()
    {
        $guru = Guru::where('id_user', Auth::id())->first();
        if ($guru)
            return $guru->kode_guru;
    }

    function format_date($date, $format = 'd-m-Y')
    {
        if (!$date)
            return null;
        return date($format, strtotime($date));
    }

    function format_datetime($date, $format = 'd-m-Y H:i:s')
    {
        if (!$date)
            return null;
        return date($format, strtotime($date));
    }

    function get_image_url($file)
    {

        if (File::exists($file) && File::isFile($file))
            return asset($file);
        else
            return asset('images/no_image.png');
    }

    function current_user()
    {
        return User::find(Auth::id());
    }

    function get_level_option($selected = '')
    {
        $arr = [
            'admin' => 'Admin',
            'lurah' => 'Kepala Desa',
            'sekretaris' => 'Sekretaris',
            'masyarakat' => 'Masyarakat',
        ];
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_status_user_option($selected = '')
    {
        $arr = [
            1 => 'Aktif',
            0 => 'NonAktif'
        ];
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_bulan_option($selected = '')
    {
        $arr = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $a = '';
        foreach ($arr as $key => $value) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$value</option>";
            else
                $a .= "<option value='$key'>$value</option>";
        }
        return $a;
    }

    function get_tahun_option($selected = '')
    {
        $str = '';
        for ($a = date('Y'); $a >= date('Y') - 10; $a--) {
            if ($selected == $a)
                $str .= "<option value='$a' selected>$a</option>";
            else
                $str .= "<option value='$a'>$a</option>";
        }
        return $str;
    }

    function print_msg($msg, $type = 'danger', $echo  = true)
    {
        $result = '<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>';
        if ($echo)
            echo $result;
        else
            return $result;
    }

    function show_error($errors)
    {
        if ($errors->any()) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul class="m-0 pl-3">';
            foreach ($errors->all() as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul></div>';
        }
    }

    function show_msg()
    {
        if ($messsage = session()->get('message')) {
            if ($messsage == "Data berhasil dihapus!") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                    . $messsage . '
                </div>';
            } else {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                    . $messsage . '
                </div>';
            }
        }
    }

    function rp($number)
    {
        return 'Rp ' . number_format($number);
    }

    function kode_oto($field, $table, $prefix, $length)
    {
        $var = get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
        if ($var) {
            return $prefix . substr(str_repeat('0', $length) . ((int)substr($var, -$length) + 1), -$length);
        } else {
            return $prefix . str_repeat('0', $length - 1) . 1;
        }
    }

    function get_row($sql = '')
    {
        $rows =  DB::select($sql);
        if ($rows)
            return $rows[0];
    }

    function get_results($sql = '')
    {
        return DB::select($sql);
    }

    function get_var($sql = '')
    {
        $row = DB::select($sql);
        if ($row) {
            return current(current($row));
        }
    }

    function query($sql, $params = [])
    {
        return DB::statement($sql, $params);
    }

    function get_config($name = null)
    {
        $row = Profile::first();

        if ($row) {
            if ($name)
                return $row->$name;
            else
                return $row;
        }
    }
