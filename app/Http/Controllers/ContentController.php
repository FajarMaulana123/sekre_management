<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ContentController extends Controller
{
    public function profile()
    {
        hasModule('PROFILE');
        $data['role'] = 'PROFILE';
        $data['group'] = 'CMS';
        $data['data'] = DB::table('profile')->first();
        return view('cms.profile', compact('data'));
    }

    public function create_profile(Request $request)
    {
        // dd($request);
        $cek = DB::table('profile')->first();
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_hp'] = $request->no_hp;
        $data['fax'] = $request->fax;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['ig'] = $request->ig;
        $data['wa'] = $request->wa;
        $data['yt'] = $request->yt;
        $data['lat'] = $request->lat;
        $data['long'] = $request->long;

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/logo', $fileName);
            $file_path = 'uploads/logo/' . $fileName;
            $data['logo'] = $file_path;
        }

        if ($cek) {
            $data['edited_by'] = auth()->user()->id;
            $data['edited_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('profile')->where('id', $cek->id)->update($data);
        } else {
            $data['created_by'] = auth()->user()->id;
            $data['created_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('profile')->insert($data);
        }

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }
}
