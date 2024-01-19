<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\UserCRM;
use App\Http\Controllers\PaymentGatewayController;

class UsuarioController extends Controller
{

    public function __construct()
    {
    }

    public function registrarUsuario(Request $request)
    {
        $p_tdo_id = ($request['p_tdo_id']) ? $request['tdo_id'] : 0;
        $p_usu_numdoc = $request['p_usu_numdoc'] ? $request['p_usu_numdoc'] : '';
        $p_usu_apepat = $request['p_usu_apepat'] ? $request['p_usu_apepat'] : '';
        $p_usu_apemat = $request['p_usu_apemat'] ? $request['p_usu_apemat'] : '';
        $p_usu_nombre = $request['p_usu_nombre'] ? $request['p_usu_nombre'] : '';
        $p_usu_direcc = $request['p_usu_direcc'] ? $request['p_usu_direcc'] : '';
        $p_usu_nrotel = $request['p_usu_nrotel'] ? $request['p_usu_nrotel'] : '';
        $p_usu_correo = $request['p_usu_correo'] ? $request['p_usu_correo'] : '';
        $p_usu_contra = $request['p_usu_contra'] ? $request['p_usu_contra'] : '';
        $p_tiu_id = $request['p_tiu_id'] ? $request['p_tiu_id'] : 0;
        $p_tac_id = $request['p_tac_id'] ? $request['p_tac_id'] : 0;
        $p_usu_fecnac = $request['p_usu_fecnac'] ? $request['p_usu_fecnac'] : NULL;
        $p_tge_id = $request['p_tge_id'] ? $request['p_tge_id'] : 0;

        $results = DB::selectOne('SELECT * FROM usuario.spu_usuario_reg(?,?,?,?,?,?,?,?,?,?,?,?,?);', [
            $p_tdo_id,
            $p_usu_numdoc,
            $p_usu_apepat,
            $p_usu_apemat,
            $p_usu_nombre,
            $p_usu_direcc,
            $p_usu_nrotel,
            $p_usu_correo,
            $p_usu_contra,
            $p_tiu_id,
            $p_tac_id,
            $p_usu_fecnac,
            $p_tge_id
        ]);

        return response()->json($results);
    }

    public function listarTipoDocumento(Request $request)
    {
        $results = DB::select('SELECT * FROM maestro.spu_tipodocumento_sel();', []);

        return response()->json($results);
    }

    public function listarTipoGenero(Request $request)
    {
        $results = DB::select('SELECT * FROM maestro.spu_tipo_genero();', []);

        return response()->json($results);
    }


}