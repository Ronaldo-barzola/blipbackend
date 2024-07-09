<?php

namespace App\Exports;

use App\Models\Planilla;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\FromQuery;

class PlanillaDetalleExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $p_cos_id;
    public function __construct($p_cos_id)
    {
        $this->p_cos_id = $p_cos_id;
    }
    public function collection()
    {
        // Ejecutar la función almacenada para obtener todos los datos
        $results = DB::select('SELECT * FROM gsaldos.spu_planilla_proceso_saldo_sel(?)', [$this->p_cos_id]);

        // Convertir los resultados en una colección de Laravel
        return collect($results);
    }

    // public function chunkSize(): int
    // {
    //     return 1000; // Ajusta el tamaño del chunk según sea necesario
    // }
}
