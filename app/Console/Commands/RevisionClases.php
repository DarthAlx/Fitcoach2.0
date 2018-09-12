<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RevisionClases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clases:revision';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para actualizar clases';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now= Carbon::now();
        DB::table('reservaciones')
            ->where('status', 'PROXIMA')
            ->where('fecha','<',$now->toDateString())
            ->update(['status' => 'EN REVISIÓN']);
        $this->info('Comando ejecutado');
    }
}
