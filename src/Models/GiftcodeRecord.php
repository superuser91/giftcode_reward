<?php

namespace Vgplay\Giftcode\Models;

use Vgplay\Giftcode\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vgplay\Contracts\Player;
use Vgplay\Giftcode\Exceptions\GiftcodeRecordJustTakenException;

class GiftcodeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'giftcode_id',
        'code',
        'user_id',
        'claimed_at',
        'is_shared'
    ];

    protected $casts = [
        'claimed_at' => 'datetime'
    ];

    public function giftcode()
    {
        return $this->belongsTo(Giftcode::class);
    }

    public function claim(Player $player)
    {
        return $this->update([
            'user_id' => $player->getId(),
            'claimed_at' => now()
        ]);
    }
}
