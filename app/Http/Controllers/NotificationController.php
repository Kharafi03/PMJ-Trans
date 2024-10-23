<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification; 
use App\Traits\ApiResponder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponder;

    /**
     * @OA\Get(
     *     path="/api/notification",
     *     tags={"Notification"},
     *     summary="Get Data Notification",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Notifikasi berhasil ditemukan",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sesi Anda telah berakhir. Silahkan login kembali."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tidak ada notifikasi."
     *     ),
     * )
     */
    public function index(Request $request)
    {
        // $user = auth('super')->user();
        // if (!$user) {
        //     return $this->errorResponse('Pengguna tidak terautentikasi.', 401);
        // }

        $notifications = Notification::where('notifiable_type', 'App\Models\Notifikasi')
            ->where('notifiable_id', $user->id)
            ->latest()
            ->limit(20)
            ->get();

        if ($notifications->isEmpty()) {
            return $this->errorResponse('Tidak ada notifikasi.', 404);
        }

        $notifications = $notifications->map(function ($notification) {
            $data = json_decode($notification->data);
            $data->created_at = Carbon::parse($notification->created_at)->diffForHumans();

            return $data;
        });

        return $this->successResponse($notifications, 'Notifikasi berhasil ditemukan');
    }
}
