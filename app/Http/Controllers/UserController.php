<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Capsule\Manager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profil()
    {
        $data['title'] = 'Ubah Profil';
        $data['user'] = Auth::user();
        return view('user.profil', $data);
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|max:255',
            'username' => 'required|max:255',
        ], [
            'nama_user.required' => 'Nama user harus diisi',
            'username.required' => 'Username harus diisi',
        ]);
        $user = current_user();
        if (get_row("SELECT * FROM tb_user WHERE username='{$request->username}' AND id_user<>'$user->id_user'"))
            return back()->withErrors([
                'username' => 'Username sudah terdaftar!',
            ]);

        $user->nama_user = $request->nama_user;
        $user->username = $request->username;

        $user->save();
        $request->session()->regenerate();
        return back()->with('message', 'Data berhasil diubah!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = Auth::user();
        return view('user.password', $data);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'pass1' => 'required|max:255',
            'pass2' => 'required|confirmed|max:255',
        ], [
            'pass1.required' => 'Password lama harus diisi',
            'pass2.required' => 'Password baru harus diisi',
            'pass2.confirmed' => 'Password baru dan konfirmasi password baru harus sama',
        ]);
        $user = current_user();
        if (!Hash::check($request->pass1, $request->user()->password))
            return back()->withErrors([
                'username' => 'Password lama salah!',
            ]);

        $user->password = Hash::make($request->pass2);
        $user->save();
        $request->session()->regenerate();
        return back()->with('message', 'Data berhasil diubah!');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function loginAction(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Salah kombinasi username dan password !',
        ]);
    }
    
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data User';
        $data['limit'] = 10;
        $data['rows'] = User::where('name', 'like', '%' . $data['q'] . '%')
            ->orderBy('id', 'asc')
            ->paginate($data['limit'])->withQueryString();
        $data['no'] = $data['rows']->firstItem();
        return view('user.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Surat';
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users|max:16',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:255',
            'name' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'nik.required' => 'NIK user harus diisi',
            'username.required' => 'Username harus diisi',
            'name.unique' => 'Nama harus diisi',
            'password.required' => 'Password harus diisi',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'Format gambar harus jpg, jpeg, png, atau gif',
            'avatar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $model = new User($request->all());
        $model->password = Hash::make($request->password);
        $model->status_user = 1;

        // Proses upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $filename, 'public');
            $model->avatar = $path;
        }

        $model->save();

        return redirect('user')->with('message', 'Data berhasil ditambah!');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $data['title'] = 'Ubah User';
        $data['row'] = $user;
        return view('user.edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_user' => 'required|max:255',
            'username' => 'required|max:255',
            //'password' => 'required|max:255',
            'level' => 'required',
            'status_user' => 'required',
        ], [
            'nama_user.required' => 'Nama user harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus unik',
            //'password.required' => 'Password harus diisi',
            'level.required' => 'Level harus diisi',
            'status_user.required' => 'Status harus diisi',
        ]);

        if (get_row("SELECT * FROM tb_user WHERE username='{$request->username}' AND id_user<>'$user->id_user'"))
            return back()->withErrors([
                'username' => 'Username sudah terdaftar!',
            ]);

        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->status_user = $request->status_user;
        $user->save();
        return redirect('user')->with('message', 'Data berhasil diubah!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('user')->with('message', 'Data berhasil dihapus!');
    }

    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        
        $users = User::where('nik', 'like', '%' . $term . '%')
            ->select('id', 'name')
            ->get();

        $results = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'value' => $user->name // ini akan ditampilkan di UI autocomplete
            ];
        });

        return response()->json($results);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ], [
            'file.required' => 'File excel harus diupload',
            'file.mimes' => 'Format file harus xlsx, xls, atau csv',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            // Ambil header dari baris pertama
            $header = [];
            if (isset($rows[1])) {
                foreach ($rows[1] as $colKey => $col) {
                    $header[$colKey] = strtolower(trim($col));
                }
                unset($rows[1]);
            }

            foreach ($rows as $row) {
                $data = [];
                foreach ($header as $colKey => $col) {
                    $data[$col] = $row[$colKey] ?? null;
                }

                // Hanya isi field yang ada di $fillable User
                $userData = [];
                $fillable = (new \App\Models\User)->getFillable();
                foreach ($fillable as $field) {
                    if ($field == 'password' && !empty($data['password'])) {
                        $userData['password'] = Hash::make($data['password']);
                    } elseif (isset($data[$field])) {
                        $userData[$field] = $data[$field];
                    }
                }

                // Wajib ada name, email, password
                if (!empty($userData['name']) && !empty($userData['email']) && !empty($data['password'])) {
                    // Cek email unik
                    if (!\App\Models\User::where('email', $userData['email'])->exists()) {
                        \App\Models\User::create($userData);
                    }
                }
            }

            return back()->with('message', 'Import data user berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Import gagal: ' . $e->getMessage()]);
        }
    }
}
?>
