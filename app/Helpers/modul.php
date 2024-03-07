<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Write code on Method
 *
 * @return response()
 */

if (!function_exists('getProfile')) {
    function getProfile()
    {
        $data = DB::table('profile')->first();
        return $data;
    }
}

if (!function_exists('groupModul')) {
    function groupModul()
    {
        $data = DB::table('modul')->selectRaw('`group`, count(`group`) as jumlah')->where('status', 'ACTIVE')->groupBy('group')->orderBy('jumlah', 'asc')->get();
        return $data;
    }
}

if (!function_exists('subModul')) {
    function subModul($group)
    {
        $data = DB::table('modul')->where('status', '=', 'ACTIVE')->where('group', '=', $group)->get();
        return $data;
    }
}

if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        // dd(Session::get('admin_modules'));
        if (is_null(Session::get('admin_modules'))) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('hasModule')) {
    function hasModule($module)
    {
        $module = $module;
        if (array_search($module, Session::get('admin_modules')) === false) {
            $forbidden = true;
            $active = "";
            Session::put('module', "");
            Session::put('active', $active);
            abort(404);
        } else {
            $active = "active";
            Session::put('active', $active);
            Session::put('module', $module);
        }
    }
}

if (!function_exists('forModule')) {
    function forModule($module)
    {
        if (array_search($module, Session::get('admin_modules')) !== false) {
            $module = $module;
            Session::put('module', $module);
            return true;
        } else {
            Session::put('module', '');
            return false;
        }
    }
}


if (!function_exists('allModule')) {
    function allModule($search = null)
    {
        if (array_intersect((array)$search, Session::get('admin_modules'))) {
            return 'ada';
        } else {
            return 'tidak ada';
        }
    }
}

if (!function_exists('forModuleGroup')) {
    function forModuleGroup($module)
    {
        if (array_search($module, Session::get('admin_module_group')) !== false) {
            $groupM = $module;
            Session::put('group', $groupM);
            return true;
        } else {
            Session::put('group', '');
            return false;
        }
    }
}
