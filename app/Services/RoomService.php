<?php
namespace App\Services;

use App\Horario;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 5/09/18
 * Time: 04:48 PM
 */

class RoomService
{

    public function __construct()
    {
    }

    public function getRoomsbyCondominio($condominioId)
    {
        $rooms = DB::table('grupos')
            ->join('rooms', 'rooms.id', '=', 'grupos.room_id')
            ->where('grupos.condominio_id', $condominioId)
            ->groupBy('rooms.id')
            ->select('rooms.*')
            ->get();
        return $rooms;
    }

    public function getRoombyCondominio($condominioId, $roomId)
    {
        $rooms = DB::table('grupos')
            ->join('rooms', 'rooms.id', '=', 'grupos.room_id')
            ->where('grupos.condominio_id', $condominioId)
            ->where('rooms.id', $roomId)
            ->groupBy('rooms.id')
            ->select('rooms.*')
            ->get();
        return $rooms;
    }

    public static function getHoursByCondominio($condominioId, $roomId)
{
    $horarios = Horario::with('clase')
        ->with('user')
        ->with('grupo.room')
        ->where('tipo', 'En condominio')
        ->where('condominio_id', $condominioId)
        ->orderBy('hora', 'asc')->get();
    $dataHours = [];
    foreach ($horarios as $value) {
        if ($value->grupo != null && $value->grupo->room != null && $value->grupo->room->id == $roomId) {
            array_push($dataHours, $value);
        }
    }
    return $dataHours;
}
}