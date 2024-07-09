<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use JasperPHP\JasperPHP as JasperPHP;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class SaldosController extends Controller
{

  public function dashboard01(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_cos_id = $request['p_cos_id'];
    $p_tipo_monto = $request['p_tipo_monto'];

    $results = DB::select('SELECT * FROM gsaldos.fu_dashboard_01 (?,?,?)', [
      $p_ent_id,
      $p_cos_id,
      $p_tipo_monto
    ]);

    return response()->json($results);
  }

  public function dashboard02(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_cos_id = $request['p_cos_id'];
    $p_tipo_monto = $request['p_tipo_monto'];

    $results = DB::select('SELECT * FROM gsaldos.fu_dashboard_02 (?,?,?)', [
      $p_ent_id,
      $p_cos_id,
      $p_tipo_monto
    ]);

    return response()->json($results);
  }

  public function dashboard03(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_cos_id = $request['p_cos_id'];
    $p_tipo_monto = $request['p_tipo_monto'];

    $results = DB::select('SELECT * FROM gsaldos.fu_dashboard_03 (?,?,?)', [
      $p_ent_id,
      $p_cos_id,
      $p_tipo_monto
    ]);

    return response()->json($results);
  }
  public function dashboard04(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_cos_id = $request['p_cos_id'];
    $p_tipo_monto = $request['p_tipo_monto'];

    $results = DB::select('SELECT * FROM gsaldos.fu_dashboard_04 (?,?,?)', [
      $p_ent_id,
      $p_cos_id,
      $p_tipo_monto
    ]);

    return response()->json($results);
  }


  public function loteContribuyenteIns(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_loc_descripcion = $request['p_loc_descripcion'];
    $p_usu_id = $request['p_usu_id'];

    $results = DB::selectOne('SELECT * FROM gsaldos.spu_lote_contribuyente_ins (?,?,?)', [
      $p_ent_id,
      $p_loc_descripcion,
      $p_usu_id
    ]);

    return response()->json($results);
  }


  public function loteContribuyenteSel(Request $request)
  {
    $p_ent_id = ($request['p_ent_id']) ? $request['p_ent_id'] : 0;
    $p_loc_id = ($request['p_loc_id']) ? $request['p_loc_id'] : 0;
    $p_loc_lote = ($request['p_loc_lote']) ? $request['p_loc_lote'] : 0;
    $p_loc_descripcion = ($request['p_loc_descripcion']) ? $request['p_loc_descripcion'] : '';

    $results = DB::select('SELECT * FROM gsaldos.spu_lote_contribuyente_sel (?,?,?,?)', [
      $p_ent_id,
      $p_loc_id,
      $p_loc_lote,
      $p_loc_descripcion
    ]);

    return response()->json($results);
  }

  public function loteContribuyenteDetalleIns(Request $request)
  {
    $p_ent_id = $request['p_ent_id'];
    $p_loc_id = $request['p_loc_id'];
    $p_persona_id = $request['p_persona_id'];
    $p_usu_id = $request['p_usu_id'];

    $results = DB::selectOne('SELECT * FROM gsaldos.spu_lote_contribuyente_detalle_ins (?,?,?,?)', [
      $p_ent_id,
      $p_loc_id,
      $p_persona_id,
      $p_usu_id
    ]);

    return response()->json($results);
  }

  public function loteContribuyenteDetalleSel(Request $request)
  {
    $p_ent_id = ($request['p_ent_id']) ? $request['p_ent_id'] : 0;
    $p_lod_id = ($request['p_lod_id']) ? $request['p_lod_id'] : 0;
    $p_loc_id = ($request['p_loc_id']) ? $request['p_loc_id'] : 0;
    $p_loc_lote = ($request['p_loc_lote']) ? $request['p_loc_lote'] : 0;
    $p_persona_id = ($request['p_persona_id']) ? $request['p_persona_id'] : 0;

    $results = DB::select('SELECT * FROM gsaldos.spu_lote_contribuyente_detalle_sel (?,?,?,?,?)', [
      $p_ent_id,
      $p_lod_id,
      $p_loc_id,
      $p_loc_lote,
      $p_persona_id
    ]);

    return response()->json($results);
  }

  public function loteContribuyenteProcesar(Request $request)
  {
    $p_loc_id = ($request['p_loc_id']) ? $request['p_loc_id'] : 0;
    $p_usu_id = ($request['p_usu_id']) ? $request['p_usu_id'] : 0;

    $results = DB::selectOne('SELECT * FROM gsaldos.spu_lote_contribuyente_procesar (?,?)', [
      $p_loc_id,
      $p_usu_id
    ]);

    return response()->json($results);
  }

  public function loteControlSaldos(Request $request)
  {
    $p_ent_id = ($request['p_ent_id']) ? $request['p_ent_id'] : 0;
    $p_cos_id = ($request['p_cos_id']) ? $request['p_cos_id'] : 0;
    $p_usu_id = ($request['p_usu_id']) ? $request['p_usu_id'] : 0;

    $results = DB::select('SELECT * FROM gsaldos.spu_controlsaldos_sel (?,?,?)', [
      $p_ent_id,
      $p_cos_id,
      $p_usu_id
    ]);

    return response()->json($results);
  }


  public function planillaSel(Request $request)
  {
    $p_ent_id = ($request['p_ent_id']) ? $request['p_ent_id'] : 0;
    $p_pla_id = ($request['p_pla_id']) ? $request['p_pla_id'] : 0;
    $p_pla_descripcion = ($request['p_pla_descripcion']) ? $request['p_pla_descripcion'] : '';
    $p_pla_fecha_inicio = ($request['p_pla_fecha_inicio']) ? $request['p_pla_fecha_inicio'] : '';
    $p_pla_fecha_fin = ($request['p_pla_fecha_fin']) ? $request['p_pla_fecha_fin'] : '';


    $results = DB::select('SELECT * FROM gsaldos.spu_planilla_sel (?,?,?,?,?)', [
      $p_ent_id,
      $p_pla_id,
      $p_pla_descripcion,
      $p_pla_fecha_inicio,
      $p_pla_fecha_fin
    ]);

    return response()->json($results);
  }

  public function planillaDetalleSel(Request $request)
  {
    $p_pla_id = ($request['p_pla_id']) ? $request['p_pla_id'] : 0;

    $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_sel (?)', [
      $p_pla_id
    ]);

    return response()->json($results);
  }

  public function planillaDetalleProcesoSelPaginado(Request $request)
  {
    $p_ppr_id = ($request['p_ppr_id']) ? $request['p_ppr_id'] : 0;
    $p_rango_ini = ($request['p_rango_ini']) ? $request['p_rango_ini'] : 0;
    $p_rango_fin = ($request['p_rango_fin']) ? $request['p_rango_fin'] : 0;
    $p_segmento_id = ($request['p_segmento_id']) ? $request['p_segmento_id'] : 0;
    $p_zona = ($request['p_zona']) ? $request['p_zona'] : '';
    $p_ordenadopor = ($request['p_ordenadopor']) ? $request['p_ordenadopor'] : '';
    $p_limitefilas = ($request['p_limitefilas']) ? $request['p_limitefilas'] : 0;
    $p_desdequefila = ($request['p_desdequefila']) ? $request['p_desdequefila'] : 0;

    $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel_paginado (?,?,?,?,?,?,?,?)', [
      $p_ppr_id,
      $p_rango_ini,
      $p_rango_fin,
      $p_segmento_id,
      $p_zona,
      $p_ordenadopor,
      $p_limitefilas,
      $p_desdequefila
    ]);

    return response()->json($results);
  }

  public function planillaProcesoTotalFilas(Request $request)
  {
    $p_ppr_id = ($request['p_ppr_id']) ? $request['p_ppr_id'] : 0;
    $p_rango_ini = ($request['p_rango_ini']) ? $request['p_rango_ini'] : 0;
    $p_rango_fin = ($request['p_rango_fin']) ? $request['p_rango_fin'] : 0;
    $p_segmento_id = $request['p_segmento_id'];
    $p_zona = ($request['p_zona']) ? $request['p_zona'] : '';


    $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel_totalfilas (?,?,?,?,?)', [
      $p_ppr_id,
      $p_rango_ini,
      $p_rango_fin,
      $p_segmento_id,
      $p_zona
    ]);

    return response()->json($results);
  }

  public function planillaProcesoXls(Request $request)
  {
    $p_cos_id = $request['p_cos_id'];
    $p_rango_ini = $request['p_rango_ini'];
    $p_rango_fin = $request['p_rango_fin'];
    $p_segmento_id = $request['p_segmento_id'];
    $p_zona = $request['p_zona'];
    $p_ordenadopor = '';
    $p_limitefilas = 0;
    $p_desdequefila = 0;
    $fileName = 'planillaDetalleX.xlsx';

    // Ejecutar la consulta SQL con el parámetro proporcionado
    $results = DB::select("SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel_paginado(?,?,?,?,?,?,?,?)", [$p_cos_id, $p_rango_ini, $p_rango_fin, $p_segmento_id, $p_zona, $p_ordenadopor, $p_limitefilas, $p_desdequefila]);

    $writer = WriterEntityFactory::createXLSXWriter();

    $filePath = storage_path('app/' . $fileName);
    $writer->openToFile($filePath);

    if (!empty($results)) {
      $headerRow = WriterEntityFactory::createRowFromArray(array_keys((array) $results[0]));
      $writer->addRow($headerRow);

      foreach ($results as $result) {
        $row = WriterEntityFactory::createRowFromArray((array) $result);
        $writer->addRow($row);
      }
    }

    $writer->close();
    return response()->download($filePath, $fileName);
    // return response()->file($path);
  }

  // public function exportarXls()
  // {
  //   ini_set('memory_limit', '-1');
  //   return Excel::download(new DataExport(6), 'data.xlsx');
  // }
  public function planillaProcesoCsv(Request $request)
  {
    $p_cos_id = $request['p_cos_id'];
    $p_rango_ini = $request['p_rango_ini'];
    $p_rango_fin = $request['p_rango_fin'];
    $p_segmento_id = $request['p_segmento_id'];
    $p_zona = $request['p_zona'];
    $p_ordenadopor = '';
    $p_limitefilas = 0;
    $p_desdequefila = 0;

    $fileName = 'planillaDetalleC.csv';

    $headers = [
      "Content-type" => "text/csv",
      "Content-Disposition" => "attachment; filename=$fileName",
      "Pragma" => "no-cache",
      "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
      "Expires" => "0"
    ];

    $columns = [
      'con_contrib',
      'contribuyente',
      'tipo_persona',
      'tipo_doc_identidad',
      'nro_doc_identidad',
      'domicilio_fiscal',
      'distrito',
      'domfis_zona',
      'domfis_deno_urb',
      'domfis_via',
      'domfis_numero',
      'domfis_manzana',
      'domfis_lote',
      'correo',
      'telefono_1',
      'telefono_2',
      'agrupacion',
      'ip_ins_2024_01',
      'ip_dee_2024',
      'ip_ins_2024_02',
      'ip_ins_2024_03',
      'ip_ins_2024_04',
      'ip_tot_2024',
      'ar_ins_2024_01',
      'ar_ins_2024_02',
      'ar_ins_2024_03',
      'ar_ins_2024_04',
      'ar_ins_2024_05',
      'ar_ins_2024_06',
      'ar_ins_2024_07',
      'ar_ins_2024_08',
      'ar_ins_2024_09',
      'ar_ins_2024_10',
      'ar_ins_2024_11',
      'ar_ins_2024_12',
      'ar_tot_2024',
      'ia_ins_tot_2024',
      'tot_2024',
      'rango_tot_2024',
      'ip_tot_2023',
      'ar_tot_2023',
      'ia_ins_tot_2023',
      'tot_2023',
      'ip_tot_2022',
      'ar_tot_2022',
      'ia_ins_tot_2022',
      'tot_2022',
      'ip_tot_2021',
      'ar_tot_2021',
      'ia_ins_tot_2021',
      'tot_2021',
      'ip_tot_2020',
      'ar_tot_2020',
      'ia_ins_tot_2020',
      'tot_2020',
      'ip_tot_2019',
      'ar_tot_2019',
      'ia_ins_tot_2019',
      'tot_2019',
      'ip_tot_2018',
      'ar_tot_2018',
      'ia_ins_tot_2018',
      'tot_2018',
      'ip_tot_2017',
      'ar_tot_2017',
      'ia_ins_tot_2017',
      'tot_2017',
      'ip_tot_9016',
      'ar_tot_9016',
      'ia_ins_tot_9016',
      'tot_9016',
      'tot_9023',
      'ip_tot',
      'ar_tot',
      'total',
      'rango_total',
      'tot_2024_vencido',
      'tot_2024_porvencer',
      'tot_2024_futuro',
      'ip_dee_tot',
      'segmento_id',
      'segmento'
    ];

    $callback = function () use ($p_cos_id, $p_rango_ini, $p_rango_fin, $p_segmento_id, $p_zona, $p_ordenadopor, $p_limitefilas, $p_desdequefila, $columns) {
      $file = fopen('php://output', 'w');
      fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
      fputcsv($file, $columns);

      $query = "SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel_paginado(?,?,?,?,?,?,?,?)";
      $pdo = DB::getPdo();
      $stmt = $pdo->prepare($query);
      $stmt->execute([$p_cos_id, $p_rango_ini, $p_rango_fin, $p_segmento_id, $p_zona, $p_ordenadopor, $p_limitefilas, $p_desdequefila]);

      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        fputcsv($file, $row);
      }

      fclose($file);
    };

    return response()->stream($callback, 200, $headers);
  }

  public function planillaDetalleProcesoSel(Request $request)
  {
    // Crear una nueva instancia de Spreadsheet
    ini_set('memory_limit', '-1');
    $p_cos_id = 6;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Obtén los datos de tu función almacenada u otra fuente
    $data = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel(?)', [$p_cos_id]);

    // Añadir cabeceras
    $headers = [
      'cod_contrib',
      'contribuyente',
      'tipo_persona',
      'tipo_doc_identidad',
      'nro_doc_identidad',
      'domicilio_fiscal',
      'distrito',
      'domfis_zona',
      'domfis_deno_urb',
      'domfis_via',
      'domfis_numero',
      'domfis_manzana',
      'domfis_lote',
      'correo',
      'telefono_1',
      'telefono_2',
      'agrupacion',
      'ip_ins_2024_01',
      'ip_dee_2024',
      'ip_ins_2024_02',
      'ip_ins_2024_03',
      'ip_ins_2024_04',
      'ip_tot_2024',
      'ar_ins_2024_01',
      'ar_ins_2024_02',
      'ar_ins_2024_03',
      'ar_ins_2024_04',
      'ar_ins_2024_05',
      'ar_ins_2024_06',
      'ar_ins_2024_07',
      'ar_ins_2024_08',
      'ar_ins_2024_09',
      'ar_ins_2024_10',
      'ar_ins_2024_11',
      'ar_ins_2024_12',
      'ar_tot_2024',
      'ia_ins_tot_2024',
      'tot_2024',
      // 'rango_tot_2024',
      // 'ip_tot_2023',
      // 'ar_tot_2023',
      // 'ia_ins_tot_2023',
      // 'tot_2023',
      // 'ip_tot_2022',
      // 'ar_tot_2022',
      // 'ia_ins_tot_2022',
      // 'tot_2022',
      // 'ip_tot_2021',
      // 'ar_tot_2021',
      // 'ia_ins_tot_2021',
      // 'tot_2021',
      // 'ip_tot_2020',
      // 'ar_tot_2020',
      // 'ia_ins_tot_2020',
      // 'tot_2020',
      // 'ip_tot_2019',
      // 'ar_tot_2019',
      // 'ia_ins_tot_2019',
      // 'tot_2019',
      // 'ip_tot_2018',
      // 'ar_tot_2018',
      // 'ia_ins_tot_2018',
      // 'tot_2018',
      // 'ip_tot_2017',
      // 'ar_tot_2017',
      // 'ia_ins_tot_2017',
      // 'tot_2017',
      // 'ip_tot_9016',
      // 'ar_tot_9016',
      // 'ia_ins_tot_9016',
      // 'tot_9016',
      // 'tot_9023',
      // 'ip_tot',
      // 'ar_tot',
      // 'total',
      // 'rango_total',
      // 'tot_2024_vencido',
      // 'tot_2024_porvencer',
      // 'tot_2024_futuro',
      // 'ip_dee_tot',
      // 'segmento_id',
      // 'segmento'
    ];
    $sheet->fromArray([$headers], null, 'A1');

    // Añadir datos
    // $row = 2;
    $chunkSize = 1000;
    $rowIndex = 2; // Empezamos desde la fila 2 porque la fila 1 son los encabezados
    $offset = 0;
    do {
      // Ejecutar la consulta paginada en chunks
      $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel_paginado(?, ?, ?, ?)', [
        6,
        'cod_contrib',
        $chunkSize,
        $offset
      ]);

      if (empty($results)) {
        break;
      }

      foreach ($results as $row) {
        $data = [
          $row->cod_contrib,
          // Añadir otros datos según sea necesario
        ];
        $sheet->fromArray($data, null, 'A' . $rowIndex);
        $rowIndex++;
      }

      $offset += $chunkSize;

    } while (!empty($results));

    // foreach ($data as $item) {
    //   $sheet->setCellValue('A' . $row, $item->cod_contrib);
    //   $sheet->setCellValue('B' . $row, $item->contribuyente);
    //   $sheet->setCellValue('C' . $row, $item->tipo_persona);
    //   $sheet->setCellValue('D' . $row, $item->tipo_doc_identidad);
    //   $sheet->setCellValue('E' . $row, $item->nro_doc_identidad);
    //   $sheet->setCellValue('F' . $row, $item->domicilio_fiscal);
    //   $sheet->setCellValue('G' . $row, $item->distrito);
    //   $sheet->setCellValue('H' . $row, $item->domfis_zona);
    //   $sheet->setCellValue('I' . $row, $item->domfis_deno_urb);
    //   $sheet->setCellValue('J' . $row, $item->domfis_via);
    //   $sheet->setCellValue('K' . $row, $item->domfis_numero);
    //   $sheet->setCellValue('L' . $row, $item->domfis_manzana);
    //   $sheet->setCellValue('M' . $row, $item->domfis_lote);
    //   $sheet->setCellValue('N' . $row, $item->correo);
    //   $sheet->setCellValue('O' . $row, $item->telefono_1);
    //   $sheet->setCellValue('P' . $row, $item->telefono_2);
    //   $sheet->setCellValue('Q' . $row, $item->agrupacion);
    //   $sheet->setCellValue('R' . $row, $item->ip_ins_2024_01);
    //   $sheet->setCellValue('S' . $row, $item->ip_dee_2024);
    //   $sheet->setCellValue('T' . $row, $item->ip_ins_2024_02);
    //   $sheet->setCellValue('U' . $row, $item->ip_ins_2024_03);
    //   $sheet->setCellValue('V' . $row, $item->ip_ins_2024_04);
    //   $sheet->setCellValue('W' . $row, $item->ip_tot_2024);
    //   $sheet->setCellValue('X' . $row, $item->ar_ins_2024_01);
    //   $sheet->setCellValue('Y' . $row, $item->ar_ins_2024_02);
    //   $sheet->setCellValue('Z' . $row, $item->ar_ins_2024_03);
    //   $sheet->setCellValue('AA' . $row, $item->ar_ins_2024_04);
    //   $sheet->setCellValue('AB' . $row, $item->ar_ins_2024_05);
    //   $sheet->setCellValue('AC' . $row, $item->ar_ins_2024_06);
    //   $sheet->setCellValue('AD' . $row, $item->ar_ins_2024_07);
    //   $sheet->setCellValue('AE' . $row, $item->ar_ins_2024_08);
    //   $sheet->setCellValue('AF' . $row, $item->ar_ins_2024_09);
    //   $sheet->setCellValue('AG' . $row, $item->ar_ins_2024_10);
    //   $sheet->setCellValue('AH' . $row, $item->ar_ins_2024_11);
    //   $sheet->setCellValue('AI' . $row, $item->ar_ins_2024_12);
    //   $sheet->setCellValue('AJ' . $row, $item->ar_tot_2024);
    //   $sheet->setCellValue('AK' . $row, $item->ia_ins_tot_2024);
    //   $sheet->setCellValue('AL' . $row, $item->tot_2024);
    // $sheet->setCellValue('AN' . $row, $item->rango_tot_2024);
    // $sheet->setCellValue('AO' . $row, $item->ip_tot_2023);
    // $sheet->setCellValue('AP' . $row, $item->ar_tot_2023);
    // $sheet->setCellValue('AQ' . $row, $item->ia_ins_tot_2023);
    // $sheet->setCellValue('AR' . $row, $item->tot_2023);
    // $sheet->setCellValue('AS' . $row, $item->ip_tot_2022);
    // $sheet->setCellValue('AT' . $row, $item->ar_tot_2022);
    // $sheet->setCellValue('AU' . $row, $item->ia_ins_tot_2022);
    // $sheet->setCellValue('AV' . $row, $item->tot_2022);
    // $sheet->setCellValue('AW' . $row, $item->ip_tot_2021);
    // $sheet->setCellValue('AX' . $row, $item->ar_tot_2021);
    // $sheet->setCellValue('AY' . $row, $item->ia_ins_tot_2021);
    // $sheet->setCellValue('AZ' . $row, $item->tot_2021);
    // $sheet->setCellValue('BA' . $row, $item->ip_tot_2020);
    // $sheet->setCellValue('BB' . $row, $item->ar_tot_2020);
    // $sheet->setCellValue('BC' . $row, $item->ia_ins_tot_2020);
    // $sheet->setCellValue('BD' . $row, $item->tot_2020);
    // $sheet->setCellValue('BE' . $row, $item->ip_tot_2019);
    // $sheet->setCellValue('BF' . $row, $item->ar_tot_2019);
    // $sheet->setCellValue('BG' . $row, $item->ia_ins_tot_2019);
    // $sheet->setCellValue('BH' . $row, $item->tot_2019);
    // $sheet->setCellValue('BI' . $row, $item->ip_tot_2018);
    // $sheet->setCellValue('BJ' . $row, $item->ar_tot_2018);
    // $sheet->setCellValue('BK' . $row, $item->ia_ins_tot_2018);
    // $sheet->setCellValue('BL' . $row, $item->tot_2018);
    // $sheet->setCellValue('BM' . $row, $item->ip_tot_2017);
    // $sheet->setCellValue('BN' . $row, $item->ar_tot_2017);
    // $sheet->setCellValue('BO' . $row, $item->ia_ins_tot_2017);
    // $sheet->setCellValue('BP' . $row, $item->tot_2017);
    // $sheet->setCellValue('BQ' . $row, $item->ip_tot_9016);
    // $sheet->setCellValue('BR' . $row, $item->ar_tot_9016);
    // $sheet->setCellValue('BS' . $row, $item->ia_ins_tot_9016);
    // $sheet->setCellValue('BT' . $row, $item->tot_9016);
    // $sheet->setCellValue('BU' . $row, $item->tot_9023);
    // $sheet->setCellValue('BV' . $row, $item->ip_tot);
    // $sheet->setCellValue('BW' . $row, $item->ar_tot);
    // $sheet->setCellValue('BX' . $row, $item->total);
    // $sheet->setCellValue('BY' . $row, $item->rango_total);
    // $sheet->setCellValue('BZ' . $row, $item->tot_2024_vencido);
    // $sheet->setCellValue('CA' . $row, $item->tot_2024_porvencer);
    // $sheet->setCellValue('CB' . $row, $item->tot_2024_futuro);
    // $sheet->setCellValue('CC' . $row, $item->ip_dee_tot);
    // $sheet->setCellValue('CD' . $row, $item->segmento_id);
    // $sheet->setCellValue('CE' . $row, $item->segmento);
    //   $row++;
    // }

    // Crear el objeto Writer para Excel (Xlsx)
    $writer = new Xlsx($spreadsheet);

    $fileName = 'planilla_detalle.xlsx';
    $path = storage_path('app/public/exports/' . $fileName); // Ruta completa dentro del directorio storage

    $writer = new Xlsx($spreadsheet);
    $writer->save($path);

    return response()->file($path);

  }
  public function reporteResumido(Request $request)
  {
    $jasper = new JasperPHP();

    $db_connection = array(
      'driver' => 'postgres',
      'host' => '172.17.1.17',
      'port' => '5432',
      'database' => 'mdsmp',
      'username' => 'postgres',
      'password' => '123456789',
    );
    $p_logo = $request['p_logo'];
    $params = array(
      "ruta_image" => storage_path('app/public/reportes/' . $p_logo),
      "p_loc_id" => $request['p_loc_id'],
      "p_usu_id" => $request['p_usu_id'],
      "p_for_id" => $request['p_for_id'],
      "p_ent_id" => $request['p_ent_id'],
      "p_direccion" => $request['p_direccion'],
      "p_ruc" => $request['p_ruc'],
      "p_usuario" => $request['p_usuario'],

      "SUBREPORT_DIR" => storage_path('app/public/reportes/')
    );

    $pdfOutput = $jasper->process(
      storage_path('app/public/reportes/estadoCuenta.jasper'),
      false,
      array("pdf"),
      $params,
      $db_connection

    )->execute();


    if (is_array($pdfOutput) && empty($pdfOutput)) {
      $pdfFile = storage_path('app/public/reportes/estadoCuenta.pdf');
      return response()->file($pdfFile);
    }

  }

  public function reporteDetallado(Request $request)
  {

    $jasper = new JasperPHP();

    $db_connection = array(
      'driver' => 'postgres',
      'host' => '172.17.1.17',
      'port' => '5432',
      'database' => 'mdsmp',
      'username' => 'postgres',
      'password' => '123456789',
    );

    $p_logo = $request['p_logo'];
    $params = array(
      "ruta_image" => storage_path('app/public/reportes/' . $p_logo),
      "p_loc_id" => $request['p_loc_id'],
      "p_usu_id" => $request['p_usu_id'],
      "p_for_id" => $request['p_for_id'],
      "p_ent_id" => $request['p_ent_id'],
      "p_direccion" => $request['p_direccion'],
      "p_ruc" => $request['p_ruc'],
      "p_usuario" => $request['p_usuario'],
      "SUBREPORT_DIR" => storage_path('app/public/reportes/')
    );

    $pdfOutput = $jasper->process(
      storage_path('app/public/reportes/estadoCuentaDetallado.jasper'),
      false,
      array("pdf"),
      $params,
      $db_connection

    )->execute();


    if (is_array($pdfOutput) && empty($pdfOutput)) {
      // echo "La generación de PDF fue exitosa. \n";
      $pdfFile = storage_path('app/public/reportes/estadoCuentaDetallado.pdf');
      // header("Content-type:application/pdf");

      // It will be called downloaded.pdf
      // header("Content-Disposition:attachment;filename=\"downloaded.pdf\"");
      // readfile($pdfFile);
      return response()->file($pdfFile);

    }

  }

  public function segmentoSel(Request $request)
  {
    $p_segmento_id = ($request['p_segmento_id']) ? $request['p_segmento_id'] : 0;

    $results = DB::select('SELECT * FROM gsaldos.spu_segmento_sel (?)', [
      $p_segmento_id
    ]);

    return response()->json($results);
  }

}