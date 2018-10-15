<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 5/10/18
 * Time: 06:07 PM
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ClaseRepository
{

    private static $CLASES_POR_COACH = "SELECT 
                    r.fecha as fecha,
                    r.hora as hora,
					IF(h.tipo = 'En condominio', hc.identificador, u.name) as direccion,                    r.nombre as nombre,
                    r.status as estado,
                    r.horario_id as horarioId,
                    zh.identificador  as room,
                    r.id as id,
                    IF(r.tipo = 'En condominio', 'clase','reserva' ) as tipo,
                    r.id as reservacionId,
                    (h.cupo-h.ocupados) as aforo
                    from  reservaciones r 
                    left JOIN horarios h ON (r.horario_id=h.id)
                    left JOIN condominios hc on (hc.id = h.condominio_id)
                    left JOIN zonas zh on (zh.id = h.zona_id)
                    left JOIN grupos gh on (gh.id = h.grupo_id)
                    left JOIN clases ch on (ch.id = h.clase_id)
                    left join rooms ro ON (ro.id = gh.room_id)
                    left join users u on (r.user_id = u.id)
                    where h.user_id = :coach_id 
                    AND (r.status = 'PROXIMA' or r.status = 'COMENZADA')
                    group by fecha,hora
                    order by fecha desc, hora  desc";

	private static $CLASES_PASADAS_COACH = "SELECT 
                    r.fecha as fecha,
                    r.hora as hora,
					IF(h.tipo = 'En condominio', hc.identificador, u.name) as direccion,                    r.nombre as nombre,
                    r.nombre as nombre,
                    r.status as estado,
                    r.horario_id as horarioId,
                    zh.identificador  as room,
                    r.id as id,
                    IF(r.tipo = 'En condominio', 'clase','reserva' ) as tipo,
                    r.id as reservacionId,
                    (h.cupo-h.ocupados) as aforo
                    from  reservaciones r 
                    left JOIN horarios h ON (r.horario_id=h.id)
                    left JOIN condominios hc on (hc.id = h.condominio_id)
                    left JOIN zonas zh on (zh.id = h.zona_id)
                    left JOIN grupos gh on (gh.id = h.grupo_id)
                    left JOIN clases ch on (ch.id = h.clase_id)
                    left join rooms ro ON (ro.id = gh.room_id)
                    left join users u on (r.user_id = u.id)
                    where h.user_id = :coach_id 
                    AND (r.status = 'FINALIZADA' or r.status = 'CANCELADA' OR r.status = 'EN REVISIÓN' OR r.status = 'COMPLETA')
                    group by fecha,hora
                    order by fecha desc, hora  desc";


	private static $CLASES = "SELECT 
                    IF(h.tipo = 'En condominio', h.fecha, r.fecha) as fecha,
                    IF(h.tipo = 'En condominio', h.hora, r.hora) as hora,
                    IF(h.tipo = 'En condominio', hc.identificador, u.name) as direccion,
                    IF(h.tipo = 'En condominio', ch.nombre, r.nombre) as nombre,
                    IF(h.tipo = 'En condominio', h.estado, r.status) as estado,
                    IF(h.tipo = 'En condominio', ro.nombre,zh.identificador ) as room,
                    h.id as id,
                    IF(h.tipo = 'En condominio', 'clase','reserva' ) as tipo,
                    h.id as horarioId, r.id as reservacionId,
                    (h.cupo-h.ocupados) as aforo,
                    h.user_id as coach_id,
                    r.metadata as metadata  
                    from horarios h
                    left JOIN reservaciones r ON (h.id = r.horario_id)
                    left JOIN condominios hc on (hc.id = h.condominio_id)
                    left JOIN zonas zh on (zh.id = h.zona_id)
                    left JOIN grupos gh on (gh.id = h.grupo_id)
                    left JOIN clases ch on (ch.id = h.clase_id)
                    left join rooms ro ON (ro.id = gh.room_id)
                    left join users u on (r.user_id = u.id)
                    left join users coach on (h.user_id = coach.id)
                    where (h.fecha BETWEEN :fecha_inicio AND :fecha_fin or r.fecha  BETWEEN :fecha_inicio2 AND :fecha_fin2 ) 
                    group by fecha,hora
                    order by fecha desc, hora  desc";

	private static $CLASES_Y_ESTADO = "SELECT 
                    IF(h.tipo = 'En condominio', h.fecha, r.fecha) as fecha,
                    IF(h.tipo = 'En condominio', h.hora, r.hora) as hora,
                    IF(h.tipo = 'En condominio', hc.identificador, u.name) as direccion,
                    IF(h.tipo = 'En condominio', ch.nombre, r.nombre) as nombre,
                    IF(h.tipo = 'En condominio', h.estado, r.status) as estado,
                    IF(h.tipo = 'En condominio', ro.nombre,zh.identificador ) as room,
                    h.id as id,
                    IF(h.tipo = 'En condominio', 'clase','reserva' ) as tipo,
                    h.id as horarioId, r.id as reservacionId,
                    (h.cupo-h.ocupados) as aforo
                    from horarios h
                    left JOIN reservaciones r ON (h.id = r.horario_id)
                    left JOIN condominios hc on (hc.id = h.condominio_id)
                    left JOIN zonas zh on (zh.id = h.zona_id)
                    left JOIN grupos gh on (gh.id = h.grupo_id)
                    left JOIN clases ch on (ch.id = h.clase_id)
                    left join rooms ro ON (ro.id = gh.room_id)
                    left join users u on (r.user_id = u.id)
                    where fecha BETWEEN :fecha_inicio AND :fecha_fin
                    AND estado = :estado
                    group by fecha,hora
                    order by fecha desc, hora  desc";

    public function __construct()
    {
    }


    public function clasesDeCoach($coachId)
    {
        return DB::select(DB::raw(ClaseRepository::$CLASES_POR_COACH), [
            'coach_id' => $coachId
        ]);
    }


	public function clasesPasadas($coachId)
	{
		return DB::select(DB::raw(ClaseRepository::$CLASES_PASADAS_COACH), [
			'coach_id' => $coachId
		]);
	}

	public function clases($fecha_inicio,$fecha_fin,$estado = null){

		    return DB::select(DB::raw(ClaseRepository::$CLASES), [
			    'fecha_inicio' => $fecha_inicio,
			    'fecha_fin' => $fecha_fin,
			    'fecha_inicio2' => $fecha_inicio,
			    'fecha_fin2' => $fecha_fin,
		    ]);

	}
}