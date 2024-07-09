<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\UtilController as UtilController;

class UsuarioController extends Controller
{


    public function login(Request $request)
    {
        $p_usu_login = $request['p_usu_login'];
        $p_usc_claveencript = md5($request['p_usc_clave']);
        $p_usc_clave = $request['p_usc_clave'];
        $p_usc_controlpostgres = true;

        $results = DB::selectOne('SELECT * FROM sic_ssi2.spu_autenticacion (?,?,?,?)', [
            $p_usu_login,
            $p_usc_claveencript,
            $p_usc_clave,
            $p_usc_controlpostgres
        ]);

        return response()->json($results);
    }

    public function usuarioAccesoIns(Request $request)
    {
        $getIp = new UtilController;

        $p_usu_id = $request['p_usu_id'];
        $p_sis_id = ($request['p_sis_id']) ? $request['p_sis_id'] : 1;
        $p_nav_descripcion = ($request['p_nav_descripcion']) ? $request['p_nav_descripcion'] : '';
        $p_nav_version = ($request['p_nav_version']) ? $request['p_nav_version'] : '';
        $p_ip = $getIp->getIp();
        $p_host = ($request['p_host']) ? $request['p_host'] : '';
        $p_macaddress = ($request['p_macaddress']) ? $request['p_macaddress'] : '';

        $results = DB::selectOne('SELECT * FROM public.spu_usuarioacceso_ins (?,?,?,?,?,?,?)', [
            $p_usu_id,
            $p_sis_id,
            $p_nav_descripcion,
            $p_nav_version,
            $p_ip,
            $p_host,
            $p_macaddress
        ]);

        return response()->json($results);
    }


    public function usuarioSistemaSel(Request $request)
    {
        $getIp = new UsuarioController;
        $p_usu_id = $request['p_usu_id'];
        $p_sis_id = ($request['p_sis_id']) ? $request['p_sis_id'] : 0;
        $p_nav_descripcion = ($request['p_nav_descripcion']) ? $request['p_nav_descripcion'] : '';
        $p_nav_version = ($request['p_nav_version']) ? $request['p_nav_version'] : '';
        $p_ip = $getIp->getIp();
        $p_host = ($request['p_host']) ? $request['p_host'] : '';
        $p_macaddress = ($request['p_macaddress']) ? $request['p_macaddress'] : '';

        $results = DB::selectOne('SELECT * FROM sic_ssi2.spu_usuariosistema_sel(?,?,?,?,?,?)', [
            $p_usu_id,
            $p_sis_id,
            $p_nav_descripcion,
            $p_nav_version,
            $p_ip,
            $p_host,
            $p_macaddress
        ]);

        return response()->json($results);
    }

    public function entidadSel(Request $request)
    {
        $p_ent_id = $request['p_ent_id'];

        $results = DB::selectOne('SELECT * FROM public.spu_entidad_sel(?)', [
            $p_ent_id
        ]);

        return response()->json($results);
    }


    


}