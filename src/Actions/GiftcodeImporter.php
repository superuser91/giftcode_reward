<?php

namespace Vgplay\Giftcode\Actions;;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Vgplay\Giftcode\Models\Giftcode;
use Vgplay\Giftcode\Models\GiftcodeRecord;

class GiftcodeImporter
{
    protected $imported = 0;

    public function import(Giftcode $giftcode, array $files)
    {
        $this->validate($files);

        foreach ($files as $file) {
            $data = explode(PHP_EOL, $file->get());
            $this->handle($giftcode, $data);
        }

        return $this->imported;
    }

    public function seed(array $files)
    {
        foreach ($files as $file) {
            $giftcode = Giftcode::where('name', basename($file, '.txt'))->first();
            if (!is_null($giftcode)) {
                $data = explode(PHP_EOL, file_get_contents($file));
                $this->handle($giftcode, $data);
            }
        }

        return $this->imported;
    }

    protected function validate(array $files)
    {
        $validator = Validator::make($files, [
            '*' => 'file|mimes:txt,csv'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    protected function handle(Giftcode $giftcode, array $data)
    {
        foreach ($data as $row) {
            $row = explode(",", $row);
            $code = trim($row[0]);
            $isShared = !empty($row[1]);
            if (empty($code)) {
                continue;
            }
            $this->saveGiftcode($giftcode, $code, $isShared);
            $this->imported++;
        }
    }

    protected function saveGiftcode(Giftcode $giftcode, string $code, bool $isShared = false): GiftcodeRecord
    {
        return GiftcodeRecord::firstOrCreate(
            ['giftcode_id' => $giftcode->id, 'code' => $code, 'is_shared' => $isShared],
        );
    }
}
