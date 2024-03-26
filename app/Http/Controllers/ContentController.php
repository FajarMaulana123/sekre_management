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
        $data['linkedin'] = $request->linkedin;
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

    public function portofolio()
    {
        hasModule('PORTOFOLIO');
        $data['role'] = 'PORTOFOLIO';
        $data['group'] = 'CMS';
        $data['kategori'] = DB::table('kategori_porto')->get();
        return view('cms.portofolio', compact('data'));
    }

    public function portofolio_(Request $request)
    {
        hasModule('PORTOFOLIO');
        if ($request->ajax()) {
            $data = DB::table('portofolio');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '" data-foto="' . asset($field->foto) . '" data-video="' . $field->video . '"  data-id_kategori="' . $field->id_kategori . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('foto', function ($field) {
                    $data = asset($field->foto);
                    $icon = '<img src="' . $data . '" alt="icon" style="width:50px;hight:50px" />';
                    return $icon;
                })
                ->rawColumns(['action', 'foto'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_portofolio(Request $request)
    {
        hasModule('PORTOFOLIO');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['id_kategori'] = $request->id_kategori;
            $data['deskripsi'] = $request->deskripsi;
            $data['video'] = $request->video;
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/portofolio', $fileName);
                $file_path = 'uploads/portofolio/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('portofolio')->insert($data);
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

    public function update_portofolio(Request $request)
    {
        hasModule('PORTOFOLIO');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['id_kategori'] = $request->id_kategori;
            $data['deskripsi'] = $request->deskripsi;
            $data['video'] = $request->video;
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/portofolio', $fileName);
                $file_path = 'uploads/portofolio/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('portofolio')->where('id', $request->hidden_id)->update($data);
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

    public function delete_portofolio(Request $request)
    {
        hasModule('PORTOFOLIO');
        // dd($request->id);
        $data = DB::table('portofolio')->where('id', $request->id)->update([
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

    public function service()
    {
        hasModule('SERVICE');
        $data['role'] = 'SERVICE';
        $data['group'] = 'CMS';
        $data['flow_work'] = DB::table('flow_work')->where('deleted', '!=', 1)->get();
        return view('cms.service', compact('data'));
    }

    public function service_(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data = DB::table('service');
            $data->where('deleted', '!=', 1)->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-id_flow_work=' . $field->id_flow_work . '" data-nama=' . $field->nama . '"  data-deskripsi="' . $field->deskripsi . '" data-icon="' . asset($field->icon) . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('icon', function ($field) {
                    $data = asset($field->icon);
                    $icon = '<img src="' . $data . '" alt="icon" style="width:50px;hight:50px" />';
                    return $icon;
                })
                ->addColumn('flow_work', function ($field) {
                    $id = json_decode($field->id_flow_work);
                    $get = DB::table('flow_work')->whereIn('id', $id)->get();
                    $flow = '';
                    foreach ($get as $val) {
                        $flow .= '- ' . $val->nama . '<br>';
                    }
                    return $flow;
                })
                ->rawColumns(['action', 'icon', 'flow_work'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_service(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;
            $data['id_flow_work'] = json_encode($request->id_flow_work);

            if ($request->file('icon')) {
                $file = $request->file('icon');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/icon', $fileName);
                $file_path = 'uploads/icon/' . $fileName;
                $data['icon'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('service')->insert($data);
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

    public function update_service(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;
            $data['id_flow_work'] = json_encode($request->id_flow_work);

            if ($request->file('icon')) {
                $file = $request->file('icon');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/icon', $fileName);
                $file_path = 'uploads/icon/' . $fileName;
                $data['icon'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('service')->where('id', $request->hidden_id)->update($data);
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

    public function delete_service(Request $request)
    {
        hasModule('SERVICE');
        // dd($request->id);
        $data = DB::table('service')->where('id', $request->id)->update([
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

    public function foto_kegiatan()
    {
        hasModule('FOTO_KEGIATAN');
        $data['role'] = 'FOTO_KEGIATAN';
        $data['group'] = 'CMS';
        return view('cms.foto_kegiatan', compact('data'));
    }

    public function foto_kegiatan_(Request $request)
    {
        hasModule('FOTO_KEGIATAN');
        if ($request->ajax()) {
            $data = DB::table('foto_kegiatan');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '"  data-deskripsi="' . $field->deskripsi . '" data-foto="' . asset($field->foto) . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('foto', function ($field) {
                    $data = asset($field->foto);
                    $foto = '<img src="' . $data . '" alt="foto" style="width:50px;hight:50px" />';
                    return $foto;
                })
                ->rawColumns(['action', 'foto'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_foto_kegiatan(Request $request)
    {
        hasModule('FOTO_KEGIATAN');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;

            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/foto_kegiatan', $fileName);
                $file_path = 'uploads/foto_kegiatan/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('foto_kegiatan')->insert($data);
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

    public function update_foto_kegiatan(Request $request)
    {
        hasModule('FOTO_KEGIATAN');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;


            if ($request->file('foto')) {
                $file = $request->file('foto');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/foto_kegiatan', $fileName);
                $file_path = 'uploads/foto_kegiatan/' . $fileName;
                $data['foto'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('foto_kegiatan')->where('id', $request->hidden_id)->update($data);
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

    public function delete_foto_kegiatan(Request $request)
    {
        hasModule('FOTO_KEGIATAN');
        // dd($request->id);
        $data = DB::table('foto_kegiatan')->where('id', $request->id)->update([
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

    public function kenapa_harus_kami()
    {
        hasModule('KENAPA_HARUS_KAMI');
        $data['role'] = 'KENAPA_HARUS_KAMI';
        $data['group'] = 'CMS';
        return view('cms.kenapa_harus_kami', compact('data'));
    }

    public function kenapa_harus_kami_(Request $request)
    {
        hasModule('KENAPA_HARUS_KAMI');
        if ($request->ajax()) {
            $data = DB::table('kenapa_harus_kami');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-judul="' . $field->judul . '" data-deskripsi="' . $field->deskripsi . '" data-icon="' . asset($field->icon) . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('icon', function ($field) {
                    $data = asset($field->icon);
                    $icon = '<img src="' . $data . '" alt="icon" style="width:50px;hight:50px" />';
                    return $icon;
                })
                ->rawColumns(['action', 'icon'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_kenapa_harus_kami(Request $request)
    {
        hasModule('KENAPA_HARUS_KAMI');
        if ($request->ajax()) {
            $data['judul'] = $request->judul;
            $data['deskripsi'] = $request->deskripsi;
            if ($request->file('icon')) {
                $file = $request->file('icon');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/icon', $fileName);
                $file_path = 'uploads/icon/' . $fileName;
                $data['icon'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('kenapa_harus_kami')->insert($data);
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

    public function update_kenapa_harus_kami(Request $request)
    {
        hasModule('KENAPA_HARUS_KAMI');
        if ($request->ajax()) {
            $data['judul'] = $request->judul;
            $data['deskripsi'] = $request->deskripsi;

            if ($request->file('icon')) {
                $file = $request->file('icon');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/icon', $fileName);
                $file_path = 'uploads/icon/' . $fileName;
                $data['icon'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('kenapa_harus_kami')->where('id', $request->hidden_id)->update($data);
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

    public function delete_kenapa_harus_kami(Request $request)
    {
        hasModule('KENAPA_HARUS_KAMI');
        // dd($request->id);
        $data = DB::table('kenapa_harus_kami')->where('id', $request->id)->update([
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

    public function paket()
    {
        hasModule('PAKET');
        $data['role'] = 'PAKET';
        $data['group'] = 'CMS';
        $data['paket_detail'] = DB::table('paket_detail')->where('deleted', '!=', 1)->get();
        return view('cms.paket', compact('data'));
    }

    public function paket_(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            $data = DB::table('paket');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-harga="' . $field->harga . '" data-id_paket_detail=' . $field->id_paket_detail . '><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('paket_detail', function ($field) {
                    $id = json_decode($field->id_paket_detail);
                    $get = DB::table('paket_detail')->whereIn('id', $id)->get();
                    $paket = '';
                    foreach ($get as $val) {
                        $paket .= '- ' . $val->nama . '<br>';
                    }
                    return $paket;
                })
                ->rawColumns(['action', 'paket_detail'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_paket(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            // dd($request);
            $data['nama'] = $request->nama;
            $data['harga'] = $request->harga;
            $data['id_paket_detail'] = json_encode($request->id_paket_detail);


            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('paket')->insert($data);

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

    public function update_paket(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['harga'] = $request->harga;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('paket')->where('id', $request->hidden_id)->update($data);
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

    public function delete_paket(Request $request)
    {
        hasModule('PAKET');
        // dd($request->id);
        $data = DB::table('paket')->where('id', $request->id)->update([
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

    public function paket_detail()
    {
        hasModule('PAKET');
        $data['role'] = 'PAKET';
        $data['group'] = 'CMS';
        return view('cms.paket_detail', compact('data'));
    }

    public function paket_detail_(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            $data = DB::table('paket_detail');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_paket_detail(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;


            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('paket_detail')->insert($data);
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

    public function update_paket_detail(Request $request)
    {
        hasModule('PAKET');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('paket_detail')->where('id', $request->hidden_id)->update($data);
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

    public function delete_paket_detail(Request $request)
    {
        hasModule('PAKET');
        // dd($request->id);
        $data = DB::table('paket_detail')->where('id', $request->id)->update([
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

    public function flow_work()
    {
        hasModule('SERVICE');
        $data['role'] = 'SERVICE';
        $data['group'] = 'CMS';
        return view('cms.flow_work', compact('data'));
    }

    public function flow_work_(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data = DB::table('flow_work');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_flow_work(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;


            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('flow_work')->insert($data);
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

    public function update_flow_work(Request $request)
    {
        hasModule('SERVICE');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['deskripsi'] = $request->deskripsi;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('flow_work')->where('id', $request->hidden_id)->update($data);
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

    public function delete_flow_work(Request $request)
    {
        hasModule('SERVICE');
        // dd($request->id);
        $data = DB::table('flow_work')->where('id', $request->id)->update([
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
