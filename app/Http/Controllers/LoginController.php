<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use GeoIp2\Database\Reader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Models\Admin\LogAksesModel;
use App\Models\User;
use App\Models\Admin\Admin\GuruModel;
use App\Models\Admin\Admin\SiswaModel;

use App\Mail\SendLupaPassword;
use App\Mail\SendEmailUpdatePass;

class LoginController extends Controller
{
    public function index(){
    	return view ('login');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'captcha' => 'required|captcha'
        ]);

        // Prepare credentials for each guard
        $credentials_user = ['email' => $request->input('username'), 'password' => $request->input('password')];
        $credentials_guru = ['nik_guru' => $request->input('username'), 'password' => $request->input('password')];
        $credentials_siswa = ['nisn_siswa' => $request->input('username'), 'password' => $request->input('password')];

        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));

        // Attempt authentication for 'users' guard
        if (Auth::guard('users')->attempt($credentials_user)) {
            $user = Auth::guard('users')->user();
            if ($user->email_verified_at !== null) {
                $request->session()->regenerate();
                $this->storeAccessInfo($request);
                $request->session()->put('user', [
                    'id' => $user->id,
                    'nama_user' => $user->nama_user,
                    'level_user' => 'admin',
                    'user_level' => $user->level_user,
                    // 'token' => $user->createToken('BITAS-Q')->plainTextToken
                ]);
                return response()->json([
                    'success' => true,
                    'redirect' => '/admin/dashboard'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Akun belum verifikasi.',
                    'redirect' => '/'
                ]);
            }
        }

        // Attempt authentication for 'guru' guard
        if (Auth::guard('guru')->attempt($credentials_guru)) {
            $guru = Auth::guard('guru')->user();
            if ($guru->status_guru = 1) {
                $request->session()->regenerate();
                $this->storeAccessInfo($request);
                $request->session()->put('user', [
                    'id' => $guru->id_guru,
                    'nama_user' => $guru->nama_guru,
                    'level_user' => 'guru',
                    // 'token' => $guru->createToken('BITAS-Q')->plainTextToken
                ]);
                return response()->json([
                    'success' => true,
                    'redirect' => '/guru/dashboard'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Akun terblokir.',
                    'redirect' => '/'
                ]);
            }
        }

        // Attempt authentication for 'siswa' guard
        if (Auth::guard('siswa')->attempt($credentials_siswa)) {
            $siswa = Auth::guard('siswa')->user();
            if ($siswa->status_siswa = 1) {
                $request->session()->regenerate();
                $this->storeAccessInfo($request);
                $request->session()->put('user', [
                    'id' => $siswa->id_siswa,
                    'nama_user' => $siswa->nama_siswa,
                    'level_user' => 'siswa',
                    // 'token' => $siswa->createToken('BITAS-Q')->plainTextToken
                ]);
                return response()->json([
                    'success' => true,
                    'redirect' => '/siswa/dashboard'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Akun belum verifikasi.',
                    'redirect' => '/'
                ]);
            }
        }

        // If none of the attempts succeed, return JSON with redirect to '/'
        return response()->json([
            'error' => true,
            'message' => 'Username atau password salah.',
            'redirect' => '/'
        ]);
        
    }
    
    
    protected function storeAccessInfo(Request $request)
    {
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));
    
        $userBrowser = $agent->browser();
        $browserVersion = $agent->version($userBrowser); 
    
        $userPlatform = $agent->platform();
        $platformVersion = $agent->version($userPlatform);
    
        $userIP = $request->ip();
        $deviceName = $agent->device();
    
        // Use GeoIP service to get country information
        $databasePath = storage_path('app/Geoip2/GeoLite2-Country.mmdb');
        $reader = new Reader($databasePath);
        
        if ($userIP != '127.0.0.1') {
            $record = $reader->country($userIP);
            $country = $record->country->name;
        } else {
            $country = 'Local Server - 127.0.0.1';
        }
    
        $data = [
            'ip_address' => $userIP,
            'browser' => $userBrowser.' V.'.$browserVersion,
            'platform' => $userPlatform.' V.'.$platformVersion,
            'device' => $deviceName,
            'negara' => $country,
            'waktu' => now(),
            'id_user' => 'session user'
        ];
    
        LogAksesModel::create($data);
    }

    public function logout($guard, Request $request)
    {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
            $request->session()->invalidate(); // Clear session data
            $request->session()->regenerateToken(); // Regenerate CSRF token
            return response()->json(['redirect' => '/']);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function lupaPassword(){
    	return view ('lupa_password');
    }

    public function CekAkun($id)
    {
        try {

            $user = User::where('email', $id)->first();
            if ($user) {
                $data_pesan = [
                    'title' => 'DATA AKUN MY-TAHFIDZ',
                    'nama_pelanggan' => $user->nama_user,
                    'email_pelanggan' => $user->email,
                    'no_hp' => $user->no_hp_user,
                    'link' => url("lupa_password/input_data/{$user->id}"),
                ];
                Mail::to($user->email)->send(new SendLupaPassword($data_pesan));
                return response()->json(['success' => true, 'message' => 'Data Ditemukan']);
            }
        
            // Try to find the user in the 'guru' guard
            $guru = GuruModel::where('email_guru', $id)->first();
            if ($guru) {
                $data_pesan = [
                    'title' => 'DATA AKUN MY-TAHFIDZ',
                    'nama_pelanggan' => $guru->nama_guru,
                    'email_pelanggan' => $guru->email_guru,
                    'no_hp' => $guru->no_hp_guru,
                    'link' => url("lupa_password/input_data/{$guru->id_guru}"),
                ];
                Mail::to($guru->email)->send(new SendLupaPassword($data_pesan));
                return response()->json(['success' => true, 'message' => 'Data Ditemukan']);
            }
        
        } catch (\Throwable $th) {
            // If neither user nor guru was found
            return response()->json(['success' => false, 'message' => 'Data Tidak Ditemukan']);
        }
        
    }

    public function lupa_passwordInput($id){
    	return view ('lupa_password_form', compact('id'));
    }

    public function update_password(Request $request)
    {

        $user = User::where('id', $request->id)->first();
        if ($user) {
            $data_pesan = [
                'title' => 'DATA AKUN MY-TAHFIDZ',
                'nama_pelanggan' => $user->nama_user,
                'email_pelanggan' => $user->email,
                'no_hp' => $user->no_hp_user,
                'password' => $request->password
            ];
            Mail::to($user->email)->send(new SendEmailUpdatePass($data_pesan));
            $data = [
                'password' => Hash::make($request->password),
            ];
            User::where('id',$request->id)->update($data);
            return response()->json(['success' => true, 'message' => 'Data Berhasil Update Password']);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

        $guru = GuruModel::where('id_guru', $request->id)->first();
        if ($guru) {
            $data_pesan = [
                'title' => 'DATA AKUN MY-TAHFIDZ',
                'nama_pelanggan' => $guru->nama_guru,
                'email_pelanggan' => $guru->email_guru,
                'no_hp' => $guru->no_hp_guru,
                'password' => $request->password
            ];
            Mail::to($guru->email)->send(new SendEmailUpdatePass($data_pesan));
            $data = [
                'password' => Hash::make($request->password),
            ];
            GuruModel::where('id',$request->id)->update($data);
            return response()->json(['success' => true, 'message' => 'Data Berhasil Update Password']);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }
    
}
