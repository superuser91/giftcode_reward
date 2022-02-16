<?php

namespace Vgplay\Giftcode\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Vgplay\Giftcode\Actions\GiftcodeImporter;
use Vgplay\Giftcode\Models\Giftcode;

class GiftcodeRecordController
{
    use AuthorizesRequests;

    public function showImportForm(Request $request, $id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('import', $giftcode);

        return view('vgplay::giftcodes.import', compact('giftcode'));
    }

    public function import(Request $request, GiftcodeImporter $importer, $id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('import', $giftcode);

        try {
            $imported = $importer->import($giftcode, $request->allFiles());

            session()->flash('status', 'Đã import thành công ' . $imported . ' Giftcode');

            return redirect(route('giftcodes.show', $id));
        } catch (ValidationException $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }
}
