<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'mails';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
    ];

    protected $guarded = ['id'];

    public function getTemplateChatAttribute()
    {

        $name = $this->name ?? 'Pelanggan';
        $phone = $this->phone ?? '(tidak ada nomor telepon)';
        $message = $this->message ?? '(tidak ada pesan)';

        return "Halo {$name},\nTerima kasih atas pesan Anda. Kami akan segera menghubungi Anda di nomor telepon: {$phone}.\nPesan Anda: {$message}";
    }
}
