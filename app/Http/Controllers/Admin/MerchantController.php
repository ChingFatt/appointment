<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\DataTables\MerchantDataTable;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MerchantDataTable $dataTable)
    {
        $merchants = Merchant::with('industry')->latest()->get();
        return view('admin.merchants.index')->with(compact('merchants'));
        //return $dataTable->render('admin.merchants.index');
        //return datatables(Merchant::all())->toJson();
        //return Datatables::of(Merchant::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::orderBy('name')->pluck('name', 'id');
        return view('admin.merchants.create')->with(compact('industries'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_publish' => ($request->is_publish) ? $request->is_publish : 0
        ]);
        $merchant = Merchant::create($request->all());
        $this->merchant_code($merchant); 

        return redirect()->route('admin.merchant.show', $merchant);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $services = $merchant->services->pluck('name', 'service_code');
        return view('admin.merchants.show')->with(compact('merchant', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        $industries = Industry::orderBy('name')->pluck('name', 'id');
        return view('admin.merchants.edit')->with(compact('merchant', 'industries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $request->merge([
            'is_publish' => ($request->is_publish) ? $request->is_publish : 0
        ]);

        $merchant->update($request->except('_method', '_token'));
        return redirect()->route('admin.merchant.show', $merchant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return redirect()->route('admin.merchant.index');
    }

    public function merchant_code($merchant)
    {
        $merchant_code = 'MERCH'. sprintf('%05d', $merchant->id);

        $merchant->merchant_code = $merchant_code;
        $merchant->save();
    }
}
