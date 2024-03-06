<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        // dd('sad');  
        if ($user = Auth::user()) {
            return redirect()->intended('/');
        }
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        $kredensil = $request->only('username', 'password');
        $cek = DB::table('users')->where('username', $request->username)->first();
        if ($cek) {
            if ($cek->locked == 1) {
                return redirect()->route('login')
                    ->with('error', 'Maaf Akun telah Terkunci!!');
            }
        }

        if (!auth()->attempt($kredensil)) {
            return redirect()->route('login')
                ->with('error', 'Maaf Username / Password Anda Salah !!');
        }



        $user = Auth::user();
        if ($user) {
            /**
             * Getting modules on admin user
             */
            $builderM = DB::table('user_modul')
                ->select('modul.alias', 'modul.nama')
                ->join('modul', 'user_modul.id_modul', '=', 'modul.id_modul', 'left')
                ->where('user_modul.id_user', '=', Auth::user()->id)
                ->where('modul.alias', '!=', '')->get();
            // $builderM = $this->db->query(
            //     "select modul.alias as alias, modul.nama from pegawai_modul 
            //                 left join modul on (pegawai_modul.id_modul = modul.id_modul) 
            //                 where id_pegawai = ? and modul.alias <> ''",
            //     array($row->id)
            // );
            if (count($builderM) > 0) {
                foreach ($builderM as $rowM) {
                    $admin_modules[] = $rowM->alias;
                    $admin_modules_name[] = $rowM->nama;
                }
            } else {
                $admin_modules = null;
                $admin_modules_name = null;
            }

            $builderG = DB::table('user_modul')
                ->select('modul.group')
                ->join('modul', 'user_modul.id_modul', '=', 'modul.id_modul', 'left')
                ->where('user_modul.id_user', '=', Auth::user()->id)
                ->where('modul.alias', '!=', '')
                ->groupBy('group')
                ->get();
            // $builderG = $this->db->query(
            //     "select modul.`group` as `group` from pegawai_modul 
            //                 left join modul on (pegawai_modul.id_modul = modul.id_modul) 
            //                 where id_pegawai = ? and modul.alias <> '' group by `group`",
            //     array($row->id)
            // );
            if (count($builderG) > 0) {
                foreach ($builderG as $rowM) {
                    $admin_module_group[] = $rowM->group;
                }
            } else {
                $admin_module_group = null;
            }

            $request->session()->put('admin_modules', $admin_modules);
            $request->session()->put('admin_modules_name', $admin_modules_name);
            $request->session()->put('admin_module_group', $admin_module_group);
            return redirect()->intended('/');
        } else {
            return redirect()->intended('login');
        }
    }

    public function logout(Request $request)
    {
        DB::table('users')->where('id', '=', Auth::user()->id)->update(['lastLogin' => date('Y-m-d H:i:s')]);
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
