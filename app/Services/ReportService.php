<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 16/09/18
 * Time: 11:15 PM
 */

namespace App\Services;


use App\Clase;
use App\Condominio;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ReportService {

	private $id;

	public function __construct( $id ) {
		$this->id = $id;
	}

	public function clientsWithClassesDue( array $input ) {
		$now       = Carbon::now();
		$startDate = null;
		$endDate   = null;
		$query     = DB::table( 'paquetescomprados' )
		               ->join( 'users', 'users.id', '=', 'paquetescomprados.user_id' );
		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
			$query->where( 'expiracion', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
			$query->where( 'expiracion', '<=', $endDate );
		}
		$query->where( 'paquetescomprados.disponibles', '>', 0 )
		      ->select( 'users.*', DB::raw( 'SUM(paquetescomprados.disponibles) as disponibles' ), 'paquetescomprados.expiracion' )
		      ->groupBy( 'users.id' );
		$data = $query->get();

		return View::make( 'admin.reports.type' . $this->id . '.show', compact( 'data', 'now', 'endDate', 'startDate' ) )->render();
	}

	public function popularityOfClasses( array $input ) {
		$now       = Carbon::now();
		$startDate = $input['from'];
		$endDate   = $input['to'];
		$query     = DB::table( 'clases' )
		               ->join( 'horarios', 'horarios.clase_id', '=', 'clases.id' );
		if ( isset( $input['from'] ) ) {
			$query->where( 'fecha', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$query->where( 'fecha', '<=', $endDate );
		}
		$query->select( 'clases.*', DB::raw( 'SUM(horarios.ocupados) as total' ) )
		      ->groupBy( 'clases.id' );
		$total = 0;
		$data  = $query->get();
		foreach ( $data as $item ) {
			$total += $item->total;
		}

		return View::make( 'admin.reports.type' . $this->id . '.show', compact( 'data', 'now', 'startDate', 'endDate', 'total' ) )->render();
	}


	public function useOfCoupons( array $input ) {
		$now       = Carbon::now();
		$startDate = $input['from'];
		$endDate   = $input['to'];
		$query     = DB::table( 'cupones' );
		if ( isset( $input['from'] ) ) {
			$query->where( 'expiracion', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$query->where( 'expiracion', '<=', $endDate );
		};
		$query->select( 'cupones.*' );
		$data = $query->get();

		return View::make( 'admin.reports.type5.show', compact( 'data', 'now', 'startDate', 'endDate' ) )->render();
	}


	public function classStatus( array $input ) {
		$now              = Carbon::now();
		$start            = new Carbon( 'first day of last month' );
		$classesAvailable = collect( DB::table( 'paquetescomprados' )
		                               ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                               ->get() )->first();
		$expiracionIn7    = collect( DB::table( 'paquetescomprados' )
		                               ->where( 'expiracion', '<=', $now->addDays( 7 ) )
		                               ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                               ->get() )->first();

		$expiracionIn14 = collect( DB::table( 'paquetescomprados' )
		                             ->where( 'expiracion', '<=', $now->addDays( 14 ) )
		                             ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                             ->get() )->first();

		$expiracionIn21 = collect( DB::table( 'paquetescomprados' )
		                             ->where( 'expiracion', '<=', $now->addDays( 21 ) )
		                             ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                             ->get() )->first();

		$expiredInTheMonth = collect( DB::table( 'paquetescomprados' )
		                                ->where( 'expiracion', '>=', $start )
		                                ->where( 'expiracion', '<', $now )
		                                ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                                ->get() )->first();

		$expiredTotal = collect( DB::table( 'paquetescomprados' )
		                           ->where( 'expiracion', '>=', $start )
		                           ->where( 'expiracion', '<', $now )
		                           ->select( DB::raw( 'SUM(paquetescomprados.disponibles) as total' ) )
		                           ->get() )->first();

		$response                    = new \stdClass();
		$response->classesAvailable  = $classesAvailable->total;
		$response->expiracionIn7     = $expiracionIn7->total;
		$response->expiracionIn14    = $expiracionIn14->total;
		$response->expiracionIn21    = $expiracionIn21->total;
		$response->expiredInTheMonth = $expiredInTheMonth->total;
		$response->expiredTotal      = $expiredTotal->total;

		return View::make( 'admin.reports.type4.show', compact( 'response', 'now' ) )->render();

	}


	public function detailedCapacityPerGroup( array $input ) {
		$now          = Carbon::now();
		$condominioId = $input['condominio_id'];
		$condominio   = Condominio::find( $condominioId );
		$query        = DB::table( 'horarios' )
		                  ->join( 'users', 'users.id', '=', 'horarios.user_id' )
		                  ->join( 'clases', 'clases.id', '=', 'horarios.clase_id' );

		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
			$query->where( 'horarios.fecha', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
			$query->where( 'horarios.fecha', '<=', $endDate );
		}
		$query->where( 'horarios.condominio_id', '=', $condominioId )
		      ->select(
			      DB::raw( 'horarios.user_id as coach_id' ),
			      'horarios.clase_id',
			      'users.name',
			      'horarios.hora',
			      'clases.nombre',
			      DB::raw( 'count(*) as total' ),
			      DB::raw( 'avg(horarios.ocupados) as promedio ' )
		      )
		      ->groupBy( DB::raw( 'horarios.hora,horarios.clase_id' ) );
		$data = $query->get();
		foreach ( $data as $item ) {
			$horarios       = DB::table( 'horarios' )
			                    ->where( 'horarios.fecha', '>=', $startDate )
			                    ->where( 'horarios.fecha', '<=', $endDate )
			                    ->where( 'horarios.condominio_id', '=', $condominioId )
			                    ->where( 'horarios.user_id', '=', $item->coach_id )
			                    ->where( 'horarios.clase_id', '=', $item->clase_id )
			                    ->select( 'horarios.fecha', 'horarios.ocupados', 'horarios.cupo' )
			                    ->get();
			$item->horarios = $horarios;
		}

		return View::make( 'admin.reports.type6.show',
			compact( 'data', 'now', 'startDate', 'endDate', 'condominio' ) )->render();
	}


	public function generalCapacityPerGroup( array $input ) {
		$now          = Carbon::now();
		$condominioId = $input['condominio_id'];
		$condominio   = Condominio::find( $condominioId );
		$query        = DB::table( 'horarios' )
		                  ->join( 'users', 'users.id', '=', 'horarios.user_id' )
		                  ->join( 'clases', 'clases.id', '=', 'horarios.clase_id' );
		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
			$query->where( 'horarios.fecha', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
			$query->where( 'horarios.fecha', '<=', $endDate );
		}
		$query->where( 'horarios.condominio_id', '=', $condominioId )
		      ->select(
			      DB::raw( 'horarios.user_id as coach_id' ),
			      'horarios.clase_id',
			      'users.name',
			      'horarios.hora',
			      'clases.nombre',
			      DB::raw( 'count(*) as total' ),
			      DB::raw( 'avg(horarios.ocupados) as promedio ' )
		      )
		      ->groupBy( DB::raw( 'horarios.hora,horarios.clase_id' ) );
		$data = $query->get();

		return View::make( 'admin.reports.type7.show',
			compact( 'data', 'now', 'startDate', 'endDate', 'condominio' ) )->render();
	}

	public function classesOfUser( array $input ) {
		$now      = Carbon::now();
		$clase_id = $input['clase_id'];
		$clase    = Clase::find( $clase_id );
		$query    = DB::table( 'reservaciones' )
		              ->join( 'users', 'users.id', '=', 'reservaciones.user_id' )
		              ->join( 'horarios', 'horarios.id', '=', 'reservaciones.horario_id' );
		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
			$query->where( 'reservaciones.fecha', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
			$query->where( 'reservaciones.fecha', '<=', $endDate );
		}
		$query->where( 'horarios.clase_id', '=', $clase_id )
		      ->select( 'users.name', 'users.email', 'users.tel', DB::raw( 'count(*) as total' ) )
		      ->groupBy( 'reservaciones.user_id' );
		$data = $query->get();

		return View::make( 'admin.reports.type8.show',
			compact( 'data', 'now', 'startDate', 'endDate', 'clase' ) )->render();
	}

	public function classesOfCoach( array $input ) {
		$now      = Carbon::now();
		$coach_id = $input['coach_id'];
		$user     = User::find( $coach_id );
		$query    = DB::table( 'reservaciones' )
		              ->join( 'abonos', 'abonos.reservacion_id', '=', 'reservaciones.id' );
		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
			$query->where( 'reservaciones.fecha', '>=', $startDate );
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
			$query->where( 'reservaciones.fecha', '<=', $endDate );
		}

		$query->where( 'reservaciones.coach_id', '=', $user->id )
		      ->select( 'reservaciones.fecha', 'reservaciones.nombre', 'reservaciones.tipo', 'reservaciones.aforo', 'reservaciones.status', 'abonos.realizado' )
		      ->groupBy( 'reservaciones.user_id' );
		$data = $query->get();

		return View::make( 'admin.reports.type9.show',
			compact( 'data', 'now', 'startDate', 'endDate', 'user' ) )->render();
	}

	public function salesOfGroup( array $input ) {
		$now = Carbon::now();
		$startDate = Carbon::now();
		$endDate = Carbon::now();
		if ( isset( $input['from'] ) ) {
			$startDate = $input['from'];
		}
		if ( isset( $input['to'] ) ) {
			$endDate = $input['to'];
		}
		$condominio_id = $input['condominio_id'];
		$condominio    = Condominio::find( $condominio_id );
		$groups        = collect( DB::table( 'grupos' )
		                            ->join( 'horarios', 'horarios.grupo_id', '=', 'grupos.id' )
		                            ->where( 'horarios.fecha', '>=', $startDate )
		                            ->where( 'horarios.fecha', '<=', $endDate )
		                            ->select( DB::raw( 'count(*) as total' ) )
		                            ->groupBy( 'grupos.id' )
		                            ->get() )->first();

		$clases = collect( DB::table( 'horarios' )
		                     ->where( 'horarios.fecha', '>=', $startDate )
		                     ->where( 'horarios.fecha', '<=', $endDate )
		                     ->select( DB::raw( 'count(*) as total' ) )
		                     ->get() )->first();

		$reservaciones = collect( DB::table( 'reservaciones' )
		                            ->where( 'reservaciones.fecha', '>=', $startDate )
		                            ->where( 'reservaciones.fecha', '<=', $endDate )
		                            ->select( DB::raw( 'count(*) as total' ) )
		                            ->get() )->first();

		$details = DB::table( 'horarios' )
		             ->join( 'clases', 'horarios.clase_id', '=', 'clases.id' )
		             ->where( 'horarios.fecha', '>=', $startDate )
		             ->where( 'horarios.fecha', '<=', $endDate )
		             ->select( 'clases.nombre', 'horarios.hora', DB::raw( 'sum(horarios.ocupados) as total' ) )
		             ->groupBy( DB::raw( 'horarios.clase_id,horarios.hora' ) )
		             ->get();

		return View::make( 'admin.reports.type10.show',
			compact( 'now', 'startDate', 'endDate', 'condominio', 'groups', 'clases', 'reservaciones', 'details' ) )->render();
	}
}