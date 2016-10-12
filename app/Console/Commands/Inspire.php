<?php

namespace App\Console\Commands;

use App\Models\Ordene;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Log;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ordenes = Ordene::where('FechaDeVigencia', '=', date('Y-m-d'))->where('idEstadoOrden', '=', 5)->get();
        foreach ($ordenes as $orden) {
            $orden->fill([
                'idEstadoOrden' => 6,
            ]);
            $orden->save();
            Log::info('Orden actualizada ' . $orden->id);
        }
        Log::info('Numero de ordenes encontradas: ' . $ordenes->count() . 'el dia 3' . date('Y-m-d'));
        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
