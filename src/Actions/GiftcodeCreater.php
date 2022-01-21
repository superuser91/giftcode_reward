<?php

namespace Vgplay\Giftcode\Actions;;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Vgplay\Giftcode\Models\Giftcode;

class GiftcodeCreater
{
    public function create(array $data)
    {
        $data = $this->validate($data);

        return Giftcode::create($data);
    }

    protected function validate(array $data)
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
