<?php

namespace Vgplay\Giftcode\Models;

use Hacoidev\CachingModel\Contracts\Cacheable;
use Hacoidev\CachingModel\HasCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vgplay\Contracts\Deliverable;
use Vgplay\Contracts\Player;
use Vgplay\Giftcode\Exceptions\GiftcodeLimitExceededException;
use Vgplay\Giftcode\Traits\HasFactory;

class Giftcode extends Model implements Cacheable, Deliverable
{
    use HasFactory;
    use SoftDeletes;
    use HasCache;

    protected $fillable = [
        'name',
        'stats',
        'game_id'
    ];

    protected $casts = [
        'stats' => 'array',
    ];

    public function giftcodeRecords()
    {
        return $this->hasMany(GiftcodeRecord::class);
    }

    public function deliver(Player $buyer, array $data = [])
    {
        /**
         * @var GiftcodeRecord
         */
        $record = GiftcodeRecord::where('giftcode_id', $this->id)
            ->where(function ($query) {
                $query->where('claimed_at', null)
                    ->orWhere('is_shared', true);
            })->first();

        if (is_null($record)) {
            throw new GiftcodeLimitExceededException();
        }

        $record->claim($buyer);

        return $record;
    }
}
