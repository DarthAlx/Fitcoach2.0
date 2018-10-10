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
                    IF(h.tipo = 'En condominio', h.fecha, r.fecha) as fecha,
                    IF(h.tipo = 'En condominio', h.hora, r.hora) as hora,
                    IF(h.tipo = 'En condominio', hc.identificador, u.name) as direccion,
                    IF(h.tipo = 'En condominio', ch.nombre, r.nombre) as nombre,
                    IF(h.tipo = 'En condominio', (SELECT IF(count(*)=2,'FINALIZADO',(IF(count(*)=1,'COMENZADA','PROXIMA'))) 
                    							  FROM clase_historiales WHERE item_id = h.id AND tipo = 'clase'), r.status) as estado,
                    IF(h.tipo = 'En condominio', ro.nombre,zh.identificador ) as room,
                    h.id as id,
                    IF(h.tipo = 'En condominio', 'clase','reserva' ) as tipo,
                    h.id as horarioId, r.id as reservacionId,
                    (h.cupo-h.ocupados) as aforo
                    from coach.horarios h
                    left JOIN coach.reservaciones r ON (h.id = r.horario_id)
                    left JOIN coach.condominios hc on (hc.id = h.condominio_id)
                    left JOIN coach.zonas zh on (zh.id = h.zona_id)
                    left JOIN coach.grupos gh on (gh.id = h.grupo_id)
                    left JOIN coach.clases ch on (ch.id = h.clase_id)
                    left join coach.rooms ro ON (ro.id = gh.room_id)
                    left join coach.users u on (r.user_id = u.id)
                    where h.user_id = :coach_id 
                    AND (r.status is null or r.status = 'PROXIMA' or r.status = 'COMENZADA')
                    group by fecha,hora
                    order by fecha desc, hora  desc";


    public function __construct()
    {
    }

    /**
     * @param $coachId
     * @return mixed
     */
    public function clasesDeCoach($coachId)
    {
        return DB::select(DB::raw(ClaseRepository::$CLASES_POR_COACH), [
            'coach_id' => $coachId
        ]);
    }
}