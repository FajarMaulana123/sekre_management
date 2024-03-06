<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class KeuanganController extends Controller
{
    public function transaksi()
    {
        hasModule('TRANSAKSI');
        $data['role'] = 'TRANSAKSI';
        $data['group'] = 'KEUANGAN';
        $data['project'] = DB::table('project')->where('deleted', 0)->get();
        return view('keuangan.transaksi', compact('data'));
    }

    public function transaksi_(Request $request)
    {
        hasModule('TRANSAKSI');
        if ($request->ajax()) {
            $data = DB::table('transaksi');
            $data->leftJoin('project', 'project.id', '=', 'transaksi.id_project');
            $data->leftJoin('jenis_project', 'jenis_project.id', '=', 'project.id_jenis_project');
            $data->leftJoin('client', 'client.id', '=', 'project.id_client');
            $data->leftJoin('perusahaan', 'perusahaan.id', '=', 'project.id_perusahaan');
            $data->select(DB::raw('transaksi.id as id_transaksi,transaksi.status as status_transaksi, transaksi.bukti_tf, transaksi.keterangan, project.*, jenis_project.jenis_project, client.nama as nama_client, client.email as email_client, client.no_hp as no_hp_client, client.alamat as alamat_client,
            perusahaan.nama as nama_perusahaan, perusahaan.email as email_perusahaan, perusahaan.no_hp as no_hp_perusahaan, perusahaan.alamat as alamat_perusahaan'));
            $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id_transaksi . '" data-id_project="' . $field->id . '" data-status="' . $field->status_transaksi . '"><i class="fas fa-pen fa-xs"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('status_project', function ($field) {
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

                    $st = '<a href="javascript:void(0);" class="' . $class . '">' . $status . '</a>';
                    return $st;
                })
                ->addColumn('status_transaksi', function ($field) {
                    if ($field->status_transaksi == 'BELUM_LUNAS') {
                        $status_transaksi = 'Belum Lunas';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-danger';
                    } else if ($field->status_transaksi == 'DP') {
                        $status_transaksi = 'DP';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-primary';
                    } else if ($field->status_transaksi == 'LUNAS') {
                        $status_transaksi = 'Lunas';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-success';
                    } else {
                        $status_transaksi = 'UNDEFINED';
                        $class = 'btn btn-xs waves-effect waves-light btn-outline-secondary';
                    }

                    $st = '<a href="javascript:void(0);" class="' . $class . '">' . $status_transaksi . '</a>';
                    return $st;
                })
                ->addColumn('bukti_tf', function ($field) {


                    $st = '<a href="' . $field->bukti_tf . '" class="btn btn-xs waves-effect waves-light btn-outline-primary" target="_blank">Lihat</a>';
                    return $st;
                })
                ->addColumn('harga', function ($field) {

                    $hasil_rupiah = "Rp " . number_format($field->harga, 0, ',', '.');
                    return $hasil_rupiah;
                })
                ->rawColumns(['action', 'status_project', 'status_transaksi', 'harga', 'bukti_tf'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_transaksi(Request $request)
    {
        hasModule('TRANSAKSI');
        if ($request->ajax()) {
            $data['id_project'] = $request->id_project;
            $data['status'] = $request->status;
            $data['keterangan'] = $request->keterangan;
            if ($request->file('bukti_tf')) {
                $file = $request->file('bukti_tf');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/bukti_transfer', $fileName);
                $file_path = 'uploads/bukti_transfer/' . $fileName;
                $data['bukti_tf'] = $file_path;
            }

            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = auth()->user()->id;
            // dd(auth()->user()->roles);
            DB::beginTransaction();
            try {
                DB::table('transaksi')->insert($data);
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

    public function update_transaksi(Request $request)
    {
        hasModule('TRANSAKSI');
        if ($request->ajax()) {
            $data['id_project'] = $request->id_project;
            $data['status'] = $request->status;
            $data['keterangan'] = $request->keterangan;
            if ($request->file('bukti_tf')) {
                $file = $request->file('bukti_tf');
                $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
                $file->move('uploads/bukti_transfer', $fileName);
                $file_path = 'uploads/bukti_transfer/' . $fileName;
                $data['bukti_tf'] = $file_path;
            }

            $data['edited_date'] = date('Y-m-d');
            $data['edited_by'] = auth()->user()->id;
            // dd($data, $request->hidden_id);
            DB::beginTransaction();
            try {
                DB::table('transaksi')->where('id', $request->hidden_id)->update($data);
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
}
