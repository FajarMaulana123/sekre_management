<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $data['role'] = '';
        $data['group'] = '';
        return view('index', compact('data'));
    }

    public function user_management()
    {
        hasModule('USER_MANAGEMENT');
        $data['role'] = 'USER_MANAGEMENT';
        $data['group'] = 'SETTING';
        // $data['toko'] = DB::table('toko')->where('deleted', 0)->get();
        return view('setting.user', compact('data'));
    }

    public function usermanagement_(Request $request)
    {
        hasModule('USER_MANAGEMENT');
        if ($request->ajax()) {
            $data = DB::table('users')->where('deleted', '=', 0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->name . '" data-email="' . $field->email . '" data-role="' . $field->roles . '" data-username="' . $field->username . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('islocked', function ($field) {
                    $d = ($field->locked == 1) ? '<span class="badge bg-danger">Locked</span>' : '<span class="badge bg-warning">Unlocked</span>';
                    $status = "<a href='# type='button' class='locked' data-id='" . $field->id . "'>" . $d . "</a>";
                    return $status;
                })
                ->rawColumns(['action', 'islocked'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_usermanagement(Request $request)
    {
        hasModule('USER_MANAGEMENT');
        if ($request->ajax()) {
            $data['name'] = $request->nama;
            $data['email'] = $request->email;
            $data['username'] = $request->username;
            $data['password'] = Hash::make($request->password);
            $data['roles'] = $request->role;
            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd($data);
            DB::beginTransaction();
            try {
                $id_user = DB::table('users')->insertGetId($data);
                $name = $request->permission;
                if ($name != null) {
                    foreach ($name as $key => $n) {
                        $user_modul['id_modul'] = $n;
                        $user_modul['id_user'] = $id_user;
                        DB::table('user_modul')->insert($user_modul);
                    }
                }
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

    public function update_usermanagement(Request $request)
    {
        hasModule('USER_MANAGEMENT');
        if ($request->ajax()) {
            $id = $request->hidden_id;
            $data['name'] = $request->nama;
            $data['email'] = $request->email;
            $data['username'] = $request->username;
            $data['roles'] = $request->role;
            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            if ($request->password != '') {
                $data['password'] = Hash::make($request->password);
            }

            DB::beginTransaction();
            try {
                DB::table('users')->where('id', '=', $id)->update($data);
                $cek = DB::table('user_modul')->where('id_user', '=', $id)->get();
                if (count($cek) > 0) {
                    DB::table('user_modul')->where('id_user', '=', $id)->delete();
                }

                $name = $request->permission;
                if ($name != null) {
                    foreach ($name as $key => $n) {
                        $user_modul['id_modul'] = $n;
                        $user_modul['id_user'] = $id;

                        DB::table('user_modul')->insert($user_modul);
                    }
                }
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

    public function get_modul(Request $request)
    {
        hasModule('USER_MANAGEMENT');
        $id = $request->id;
        $arr['data_modul'] = DB::table('user_modul')->where('id_user', '=', $id)->get();
        echo json_encode($arr);
        return;
    }

    public function delete_user(Request $request)
    {
        hasModule('USERMANAGEMENT');
        // dd($request->id);
        $data = DB::table('users')->where('id', $request->id)->update([
            'deleted' => 1,
            'deletedBy' => auth()->user()->id,
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

    public function locked_user(Request $request)
    {
        hasModule('USERMANAGEMENT');
        $cek = DB::table('users')->where('id', $request->id)->first();
        if ($cek->locked == 1) {
            $data = DB::table('users')->where('id', $request->id)->update([
                'locked' => 0,
            ]);

            if ($data) {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil Unlocked!';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
        } else {
            $data = DB::table('users')->where('id', $request->id)->update([
                'locked' => 1,
            ]);
            if ($data) {
                $r['title'] = 'Sukses!';
                $r['icon'] = 'success';
                $r['status'] = 'Berhasil Locked';
            } else {
                $r['title'] = 'Maaf!';
                $r['icon'] = 'error';
                $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
            }
        }

        return response()->json($r);
    }

    public function client()
    {
        hasModule('CLIENT');
        $data['role'] = 'CLIENT';
        $data['group'] = 'MASTER_DATA';
        return view('master_data.client', compact('data'));
    }

    public function client_(Request $request)
    {
        hasModule('CLIENT');
        if ($request->ajax()) {
            $data = DB::table('client');
            $data->where('client.deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-email="' . $field->email . '" data-no_hp="' . $field->no_hp . '" data-alamat="' . $field->alamat . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($field) {
                    if ($field->status == 'PROSPEK') {
                        $status = 'Prospek';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-info';
                    } else if ($field->status == 'FOLLOWUP') {
                        $status = 'Follow Up';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-primary';
                    } else if ($field->status == 'OFFERING') {
                        $status = 'Offering';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-warning';
                    } else if ($field->status == 'INVOICE') {
                        $status = 'Invoice';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-info';
                    } else if ($field->status == 'DEALING') {
                        $status = 'Dealing';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-success';
                    } else if ($field->status == 'DONE') {
                        $status = 'Done';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-primary';
                    } else {
                        $status = 'UNDEFINED';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-danger';
                    }

                    $st = '<a href="javascript:void(0);" class="' . $class . ' status" data-id="' . $field->id . '" data-status="' . $field->status . '">' . $status . '</a>';
                    return $st;
                })
                // ->addColumn('image', function ($field) {
                //     $img = ($field->image != null) ? asset($field->image) : asset('/uploads/noimage.jpg');
                //     $cover = '<img src="' . $img . '" width="50" alt="" class="rounded" />';
                //     return $cover;
                // })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_client(Request $request)
    {
        hasModule('CLIENT');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['email'] = $request->email;
            $data['no_hp'] = $request->no_hp;
            $data['alamat'] = $request->alamat;

            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            //     $file->move('uploads/produk', $fileName);
            //     $file_path = 'uploads/produk/' . $fileName;
            //     $data['image'] = $file_path;
            // }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd($data);
            DB::beginTransaction();
            try {
                DB::table('client')->insert($data);
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

    public function update_client(Request $request)
    {
        hasModule('CLIENT');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['email'] = $request->email;
            $data['no_hp'] = $request->no_hp;
            $data['alamat'] = $request->alamat;

            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            //     $file->move('uploads/produk', $fileName);
            //     $file_path = 'uploads/produk/' . $fileName;
            //     $data['image'] = $file_path;
            // }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('client')->where('id', $request->hidden_id)->update($data);
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

    public function delete_client(Request $request)
    {
        hasModule('CLIENT');
        // dd($request->id);
        $data = DB::table('client')->where('id', $request->id)->update([
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

    public function update_status_client(Request $request)
    {
        hasModule('CLIENT');
        // dd($request);
        $data['status'] = $request->status;
        $data['edited_date'] = date('Y-m-d');
        $data['edited_by'] = auth()->user()->id;
        $datas = DB::table('client')->where('id', $request->hidden_id)->update($data);
        if ($datas) {
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

    public function perusahaan()
    {
        hasModule('PERUSAHAAN');
        $data['role'] = 'PERUSAHAAN';
        $data['group'] = 'MASTER_DATA';
        return view('master_data.perusahaan', compact('data'));
    }

    public function perusahaan_(Request $request)
    {
        hasModule('PERUSAHAAN');
        if ($request->ajax()) {
            $data = DB::table('perusahaan');
            $data->where('perusahaan.deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-email="' . $field->email . '" data-no_hp="' . $field->no_hp . '" data-alamat="' . $field->alamat . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                // ->addColumn('image', function ($field) {
                //     $img = ($field->image != null) ? asset($field->image) : asset('/uploads/noimage.jpg');
                //     $cover = '<img src="' . $img . '" width="50" alt="" class="rounded" />';
                //     return $cover;
                // })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_perusahaan(Request $request)
    {
        hasModule('PERUSAHAAN');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['email'] = $request->email;
            $data['no_hp'] = $request->no_hp;
            $data['alamat'] = $request->alamat;

            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            //     $file->move('uploads/produk', $fileName);
            //     $file_path = 'uploads/produk/' . $fileName;
            //     $data['image'] = $file_path;
            // }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd($data);
            DB::beginTransaction();
            try {
                DB::table('perusahaan')->insert($data);
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

    public function update_perusahaan(Request $request)
    {
        hasModule('PERUSAHAAN');
        if ($request->ajax()) {
            $data['nama'] = $request->nama;
            $data['email'] = $request->email;
            $data['no_hp'] = $request->no_hp;
            $data['alamat'] = $request->alamat;

            // if ($request->file('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            //     $file->move('uploads/produk', $fileName);
            //     $file_path = 'uploads/produk/' . $fileName;
            //     $data['image'] = $file_path;
            // }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('perusahaan')->where('id', $request->hidden_id)->update($data);
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

    public function delete_perusahaan(Request $request)
    {
        hasModule('PERUSAHAAN');
        // dd($request->id);
        $data = DB::table('perusahaan')->where('id', $request->id)->update([
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

    public function jenis_project()
    {
        hasModule('JENIS_PROJECT');
        $data['role'] = 'JENIS_PROJECT';
        $data['group'] = 'MASTER_DATA';
        return view('master_data.jenis_project', compact('data'));
    }

    public function jenis_project_(Request $request)
    {
        hasModule('JENIS_PROJECT');
        if ($request->ajax()) {
            $data = DB::table('jenis_project');
            $data->where('deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-jenis_project="' . $field->jenis_project . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_jenis_project(Request $request)
    {
        hasModule('JENIS_PROJECT');
        if ($request->ajax()) {
            $data['jenis_project'] = $request->jenis_project;

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('jenis_project')->insert($data);
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

    public function update_jenis_project(Request $request)
    {
        hasModule('JENIS_PROJECT');
        if ($request->ajax()) {
            $data['jenis_project'] = $request->jenis_project;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('jenis_project')->where('id', $request->hidden_id)->update($data);
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

    public function delete_jenis_project(Request $request)
    {
        hasModule('JENIS_PROJECT');
        // dd($request->id);
        $data = DB::table('jenis_project')->where('id', $request->id)->update([
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

    public function project()
    {
        hasModule('PROJECT');
        $data['role'] = 'PROJECT';
        $data['group'] = 'MASTER_DATA';
        $data['jenis_project'] = DB::table('jenis_project')->where('deleted', 0)->get();
        $data['client'] = DB::table('client')->where('deleted', 0)->get();
        $data['perusahaan'] = DB::table('perusahaan')->where('deleted', 0)->get();
        return view('master_data.project', compact('data'));
    }

    public function project_(Request $request)
    {
        hasModule('PROJECT');
        if ($request->ajax()) {
            $data = DB::table('project');
            $data->leftJoin('jenis_project', 'jenis_project.id', '=', 'project.id_jenis_project');
            $data->leftJoin('client', 'client.id', '=', 'project.id_client');
            $data->leftJoin('perusahaan', 'perusahaan.id', '=', 'project.id_perusahaan');
            $data->select(DB::raw('project.*, jenis_project.jenis_project, client.nama as nama_client, client.email as email_client, client.no_hp as no_hp_client, client.alamat as alamat_client,
            perusahaan.nama as nama_perusahaan, perusahaan.email as email_perusahaan, perusahaan.no_hp as no_hp_perusahaan, perusahaan.alamat as alamat_perusahaan'));
            $data->where('project.deleted', '!=', 1)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-id_jenis_project="' . $field->id_jenis_project . '"  data-id_client="' . $field->id_client . '" data-id_perusahaan="' . $field->id_perusahaan . '" data-nama_project="' . $field->nama_project . '" data-durasi_project="' . $field->durasi_project . '" data-tgl_mulai="' . $field->tgl_mulai . '" data-tgl_akhir="' . $field->tgl_akhir . '" data-harga="' . $field->harga . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($field) {
                    if ($field->status == 'OFFERING') {
                        $status = 'Offering';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-warning';
                    } else if ($field->status == 'INVOICE') {
                        $status = 'Invoice';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-info';
                    } else if ($field->status == 'DEALING') {
                        $status = 'Dealing';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-success';
                    } else if ($field->status == 'DONE') {
                        $status = 'Done';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-primary';
                    } else {
                        $status = 'UNDEFINED';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-danger';
                    }

                    $st = '<a href="javascript:void(0);" class="' . $class . ' status" data-id="' . $field->id . '" data-status="' . $field->status . '">' . $status . '</a>';
                    return $st;
                })
                ->addColumn('harga', function ($field) {

                    $hasil_rupiah = "Rp " . number_format($field->harga, 0, ',', '.');
                    return $hasil_rupiah;
                })
                ->rawColumns(['action', 'status', 'harga'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_project(Request $request)
    {
        hasModule('PROJECT');
        if ($request->ajax()) {
            $data['id_jenis_project'] = $request->id_jenis_project;
            $data['id_client'] = $request->id_client;
            $data['id_perusahaan'] = $request->id_perusahaan;
            $data['nama_project'] = $request->nama_project;
            $data['durasi_project'] = $request->durasi_project;
            $data['tgl_mulai'] = $request->tgl_mulai;
            $data['tgl_akhir'] = $request->tgl_akhir;
            $data['harga'] = $request->harga;
            $data['status'] = 'OFFERING';

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('project')->insert($data);
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

    public function update_project(Request $request)
    {
        hasModule('PROJECT');
        if ($request->ajax()) {
            $data['id_jenis_project'] = $request->id_jenis_project;
            $data['id_client'] = $request->id_client;
            $data['id_perusahaan'] = $request->id_perusahaan;
            $data['nama_project'] = $request->nama_project;
            $data['durasi_project'] = $request->durasi_project;
            $data['tgl_mulai'] = $request->tgl_mulai;
            $data['tgl_akhir'] = $request->tgl_akhir;
            $data['harga'] = $request->harga;

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('project')->where('id', $request->hidden_id)->update($data);
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

    public function delete_project(Request $request)
    {
        hasModule('PROJECT');
        // dd($request->id);
        $data = DB::table('project')->where('id', $request->id)->update([
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

    public function update_status_project(Request $request)
    {
        hasModule('PROJECT');
        // dd($request);
        $data['status'] = $request->status;
        $data['edited_date'] = date('Y-m-d');
        $data['edited_by'] = auth()->user()->id;
        $datas = DB::table('project')->where('id', $request->hidden_id)->update($data);
        if ($datas) {
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
