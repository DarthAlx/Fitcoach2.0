<?php

namespace App\Console\Commands;

use App\Horario;
use App\Reservacion;
use Illuminate\Console\Command;

class ActualizarHorarios extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'horarios:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Comando para actualizar horarios';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $reservaciones = Reservacion::all();
        foreach ($reservaciones as $reservacion){
        	$horario = Horario::find($reservacion->horario_id);
        	$horario->estado = $reservacion->status;
        	$horario->save();
        }
    }
}
