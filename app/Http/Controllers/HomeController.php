<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // $fix = 2;
    // $kelipatan = 2;
    // $start = 3;
    // $total = 0;
    // for ($i = 0; $i < 100; $i++) {
    //     if ($i > 0) {
    //         $start += $fix;
    //         $fix += $kelipatan;
    //     }
    // }
    // return $start;

    // public function RecursiveRandomNumberGenerator($n = 100, $seed = 1)
    // {
    //     $a = (int)1103;
    //     $c = (int)1234;
    //     $m = pow(2, 31);

    //     if ($n == 0) {
    //         return $seed;
    //     }

    //     // dd($m);

    //     $previousNumber = (int) $this->RecursiveRandomNumberGenerator($n - 1, $seed);
    //     $newNumber = ($a * $previousNumber + $c) % $m;
    //     return $newNumber;
    // }

    private function getEmbedYt($url)
    {
        return "https://www.youtube.com/embed/" . $this->getYtId($url);
    }

    private function getYtId($url)
    {
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        if (isset($params['v']) && strlen($params['v']) > 0) {
            return $params['v'];
        } else {
            return '';
        }
    }

    public function home()
    {
        $data['mitra'] = DB::table('mitra')->where('deleted', '!=', 1)->get();
        $data['team'] = DB::table('team')->where('deleted', '!=', 1)->get();
        $data['testimoni'] = DB::table('testimoni')->where('deleted', '!=', 1)->get();
        $data['service'] = DB::table('service')->where('deleted', '!=', 1)->get();
        $data['foto_kegiatan'] = DB::table('foto_kegiatan')->where('deleted', '!=', 1)->get();
        $data['profile'] = getProfile();
        // $data['kategori'] = DB::table('kategori_porto')->get();
        $data['kenapa_harus_kami'] = DB::table('kenapa_harus_kami')->where('deleted', '!=', 1)->get();
        $data['paket'] = DB::table('paket')->where('deleted', '!=', 1)->get();
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->orderBy('portofolio.created_date', 'desc')->take(8)->get();

        return view('frontend.home', compact('data'));
    }

    public function about()
    {

        $data['profile'] = getProfile();
        $data['team'] = DB::table('team')->where('deleted', '!=', 1)->get();
        return view('frontend.about', compact('data'));
    }

    public function portofolio()
    {

        $data['kategori'] = DB::table('kategori_porto')->get();
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->orderBy('portofolio.created_date', 'desc')->get();

        return view('frontend.list_portofolio', compact('data'));
    }

    public function detail_portofolio($id)
    {
        $id_ = Crypt::decrypt($id);
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->where('portofolio.id', $id_)->first();
        $data['video'] = $this->getEmbedYt($data['portofolio']->video);
        return view('frontend.detail_portofolio', compact('data'));
    }

    public function detail_service($id)
    {
        $id_ = Crypt::decrypt($id);
        $data['profile'] = getProfile();
        $data['service'] = DB::table('service')->where('deleted', '!=', 1)->where('id', $id_)->first();
        // dd($data);
        $data['flow_work'] = DB::table('flow_work')->where('deleted', '!=', 1)->whereIn('id', json_decode($data['service']->id_flow_work))->get();
        return view('frontend.detail_service', compact('data'));
    }
}
