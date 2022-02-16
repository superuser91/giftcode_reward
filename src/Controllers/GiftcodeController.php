<?php

namespace Vgplay\Giftcode\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Vgplay\Giftcode\Actions\GiftcodeCreater;
use Vgplay\Giftcode\Actions\GiftcodeUpdater;
use Vgplay\Giftcode\Models\Giftcode;
use Vgplay\Giftcode\Models\GiftcodeRecord;

class GiftcodeController
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Giftcode::class);

        $giftcodes = Giftcode::fromCache()->all();

        return view('vgplay::giftcodes.index', compact('giftcodes'));
    }

    public function show(Request $request, $id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('show', $giftcode);

        if ($request->ajax() || $request->wantsJson()) {
            return datatables()->of(
                GiftcodeRecord::where('giftcode_id', $giftcode->id)
            )->make(true);
        }

        return view('vgplay::giftcodes.show', compact('giftcode'));
    }

    public function create()
    {
        $this->authorize('create', Giftcode::class);

        return view('vgplay::giftcodes.create');
    }

    public function store(Request $request, GiftcodeCreater $giftcodeCreater)
    {
        $this->authorize('create', Giftcode::class);

        try {
            $giftcodeCreater->create($request->all());

            session()->flash('status', 'Thêm Giftcode mới thành công');

            return redirect(route('giftcodes.index'));
        } catch (ValidationException $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('update', $giftcode);

        return view('vgplay::giftcodes.edit', compact('giftcode'));
    }

    public function update(Request $request, GiftcodeUpdater $giftcodeUpdater, $id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('update', $giftcode);

        try {
            $giftcodeUpdater->update($giftcode, $request->all());

            session()->flash('status', 'Cập nhật Giftcode thành công');

            return redirect(route('giftcodes.index'));
        } catch (ValidationException $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $giftcode = Giftcode::fromCache()->find($id);

        if (is_null($giftcode)) abort(404);

        $this->authorize('delete', $giftcode);

        try {
            $giftcode->delete();

            session()->flash('status', 'Xoá Giftcode thành công');

            return redirect(route('giftcodes.index'));
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back();
        }
    }
}
