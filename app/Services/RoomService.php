<?php
namespace App\Services;

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
}