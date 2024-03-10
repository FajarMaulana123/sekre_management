<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
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
        $data['profile'] = getProfile();
        $data['kategori'] = DB::table('kategori_porto')->get();
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->orderBy('portofolio.created_date', 'desc')->take(6)->get();

        return view('frontend.home', compact('data'));
    }

    public function portofolio()
    {

        $data['kategori'] = DB::table('kategori_porto')->get();
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->orderBy('portofolio.created_date', 'desc')->take(6)->get();

        return view('frontend.list_portofolio', compact('data'));
    }

    public function detail_portofolio($id)
    {
        $id_ = Crypt::decrypt($id);
        $data['portofolio'] = DB::table('portofolio')->leftJoin('kategori_porto', 'kategori_porto.id', '=', 'portofolio.id_kategori')->select('portofolio.*', 'kategori_porto.nama as kategori')->where('deleted', '!=', 1)->where('portofolio.id', $id_)->first();
        $data['video'] = $this->getEmbedYt($data['portofolio']->video);
        return view('frontend.detail_portofolio', compact('data'));
    }
}
