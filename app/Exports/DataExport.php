<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DataExport implements FromCollection, WithHeadings, WithMapping, WithChunkReading
{
    protected $p_cos_id;

    public function __construct($p_cos_id)
    {
        $this->p_cos_id = $p_cos_id;
    }


    public function collection()
    {
        // Ejecuta la función PostgreSQL y devuelve los resultados como una LazyCollection
        return collect(DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel(?)', [$this->p_cos_id]))->lazy();
    }
    // public function query()
    // {
    //     $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel(6)');
    //     return collect($results);
    // }

    public function headings(): array
    {
        // Define los encabezados del archivo Excel
        return [
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
    }

    public function map($row): array
    {
        // Mapea cada fila de datos según sea necesario
        return [
            $row->cod_contrib,
            $row->contribuyente,
            $row->tipo_persona,
            $row->tipo_doc_identidad,
            $row->nro_doc_identidad,
            $row->domicilio_fiscal,
            $row->distrito,
            $row->domfis_zona,
            $row->domfis_deno_urb,
            $row->domfis_via,
            $row->domfis_numero,
            $row->domfis_manzana,
            $row->domfis_lote,
            $row->correo,
            $row->telefono_1,
            $row->telefono_2,
            $row->agrupacion,
            $row->ip_ins_2024_01,
            $row->ip_dee_2024,
            $row->ip_ins_2024_02,
            $row->ip_ins_2024_03,
            $row->ip_ins_2024_04,
            $row->ip_tot_2024,
            $row->ar_ins_2024_01,
            $row->ar_ins_2024_02,
            $row->ar_ins_2024_03,
            $row->ar_ins_2024_04,
            $row->ar_ins_2024_05,
            $row->ar_ins_2024_06,
            $row->ar_ins_2024_07,
            $row->ar_ins_2024_08,
            $row->ar_ins_2024_09,
            $row->ar_ins_2024_10,
            $row->ar_ins_2024_11,
            $row->ar_ins_2024_12,
            $row->ar_tot_2024,
            $row->ia_ins_tot_2024,
            $row->tot_2024,
            $row->rango_tot_2024,
            $row->ip_tot_2023,
            $row->ar_tot_2023,
            $row->ia_ins_tot_2023,
            $row->tot_2023,
            $row->ip_tot_2022,
            $row->ar_tot_2022,
            $row->ia_ins_tot_2022,
            $row->tot_2022,
            $row->ip_tot_2021,
            $row->ar_tot_2021,
            $row->ia_ins_tot_2021,
            $row->tot_2021,
            $row->ip_tot_2020,
            $row->ar_tot_2020,
            $row->ia_ins_tot_2020,
            $row->tot_2020,
            $row->ip_tot_2019,
            $row->ar_tot_2019,
            $row->ia_ins_tot_2019,
            $row->tot_2019,
            $row->ip_tot_2018,
            $row->ar_tot_2018,
            $row->ia_ins_tot_2018,
            $row->tot_2018,
            $row->ip_tot_2017,
            $row->ar_tot_2017,
            $row->ia_ins_tot_2017,
            $row->tot_2017,
            $row->ip_tot_9016,
            $row->ar_tot_9016,
            $row->ia_ins_tot_9016,
            $row->tot_9016,
            $row->tot_9023,
            $row->ip_tot,
            $row->ar_tot,
            $row->total,
            $row->rango_total,
            $row->tot_2024_vencido,
            $row->tot_2024_porvencer,
            $row->tot_2024_futuro,
            $row->ip_dee_tot,
            $row->segmento_id,
            $row->segmento
        ];
    }

    public function chunkSize(): int
    {
        return 10000; // Ajusta el tamaño del chunk según sea necesario
    }
}
