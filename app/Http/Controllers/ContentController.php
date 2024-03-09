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
        $data['tentang_kami'] = $request->tentang_kami;

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

    public function mitra()
    {
        hasModule('MITRA');
        $data['role'] = 'MITRA';
        $data['group'] = 'CMS';
        return view('cms.mitra', compact('data'));
    }

    public function mitra_(Request $request)
    {
        hasModule('MITRA');
        if ($request->ajax()) {
            $data = DB::table('mitra');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '" data-logo="' . asset($field->logo) . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('logo', function ($field) {
                    $data = asset($field->logo);
                    $logo = '<img src="' . $data . '" alt="logo" style="width:50px;hight:50px" />';
                    return $logo;
                })

                ->rawColumns(['action', 'logo'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_mitra(Request $request)
    {
        hasModule('MITRA');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/logo', $fileName);
                $file_path = 'uploads/logo/' . $fileName;
                $data['logo'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('mitra')->insert($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function update_mitra(Request $request)
    {
        hasModule('MITRA');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/logo', $fileName);
                $file_path = 'uploads/logo/' . $fileName;
                $data['logo'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('mitra')->where('id', $request->hidden_id)->update($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function delete_mitra(Request $request)
    {
        hasModule('MITRA');
        // dd($request->id);
        $data = DB::table('mitra')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function team()
    {
        hasModule('TEAM');
        $data['role'] = 'TEAM';
        $data['group'] = 'CMS';
        return view('cms.team', compact('data'));
    }

    public function team_(Request $request)
    {
        hasModule('TEAM');
        if ($request->ajax()) {
            $data = DB::table('team');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-jabatan="' . $field->jabatan . '" data-foto="' . asset($field->foto) . '" data-ig="' . $field->ig . '" data-fb="' . $field->fb . '" data-linkedin="' . $field->linkedin . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('foto', function ($field) {
                    $data = asset($field->foto);
                    $foto = '<img src="' . $data . '" alt="foto" style="width:50px;hight:100px" />';
                    return $foto;
                })

                ->rawColumns(['action', 'foto'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_team(Request $request)
    {
        hasModule('TEAM');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['jabatan'] = $request->jabatan;
            $data['ig'] = $request->ig;
            $data['fb'] = $request->fb;
            $data['linkedin'] = $request->linkedin;
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/team', $fileName);
                $file_path = 'uploads/team/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('team')->insert($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function update_team(Request $request)
    {
        hasModule('TEAM');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['jabatan'] = $request->jabatan;
            $data['ig'] = $request->ig;
            $data['fb'] = $request->fb;
            $data['linkedin'] = $request->linkedin;
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/team', $fileName);
                $file_path = 'uploads/team/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('team')->where('id', $request->hidden_id)->update($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function delete_team(Request $request)
    {
        hasModule('TEAM');
        // dd($request->id);
        $data = DB::table('team')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function testimoni()
    {
        hasModule('TESTIMONI');
        $data['role'] = 'TESTIMONI';
        $data['group'] = 'CMS';
        return view('cms.testimoni', compact('data'));
    }

    public function testimoni_(Request $request)
    {
        hasModule('TESTIMONI');
        if ($request->ajax()) {
            $data = DB::table('testimoni');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-perusahaan="' . $field->perusahaan . '" data-isi="' . $field->isi . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_testimoni(Request $request)
    {
        hasModule('TESTIMONI');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['perusahaan'] = $request->perusahaan;
            $data['isi'] = $request->isi;


            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('testimoni')->insert($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function update_testimoni(Request $request)
    {
        hasModule('TESTIMONI');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['perusahaan'] = $request->perusahaan;
            $data['isi'] = $request->isi;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('testimoni')->where('id', $request->hidden_id)->update($data);
                // dd('asd');
                DB::commit();
                $r['result'] = true;
            } catch (\Exception $e) {
                DB::rollback();
                $r['result'] = false;
            }

            echo json_encode($r);
            return;
        }
    }

    public function delete_testimoni(Request $request)
    {
        hasModule('TESTIMONI');
        // dd($request->id);
        $data = DB::table('testimoni')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }
}
