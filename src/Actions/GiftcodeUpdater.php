<?php

namespace Vgplay\Giftcode\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Vgplay\Giftcode\Models\Giftcode;

class GiftcodeUpdater
{
    public function update(Giftcode $giftcode, array $data)
    {
        $data = $this->validate($giftcode, $data);

        return $giftcode->update($data);
    }

    protected function validate(Giftcode $giftcode, array $data)
    {
        $data['stats'] = json_decode($data['stats']);
        
        $validator = Validator::make($data, [
            'name' => 'required|string|max:191',
            'game_id' => 'required|integer',
            'picture' => 'nullable|string|max:2048',
            'stats' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $data;
    }
}
