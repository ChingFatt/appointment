<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\EmailConfig;
use App\Models\Outlet;
use Auth;

class EmailConfigController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(EmailConfig::class, 'email_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Outlet $outlet)
    {
        return view('admin.email_configs.create')->with(compact('outlet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $outlet = Outlet::findOrFail($request->outlet_id);
        $request->merge([
            'merchant_id'   => $outlet->merchant->id
        ]);

        if ($request->hasFile('file')) {
            $upload = $this->upload($request);
            $request->merge([
                'signature'     => $upload['signature']
            ]);
        }

        $emailConfig = EmailConfig::create($request->all());
        return redirect()->route('admin.outlet.show', $emailConfig->outlet_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  EmailConfig $emailConfig
     * @return \Illuminate\Http\Response
     */
    public function show(EmailConfig $emailConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  EmailConfig $emailConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailConfig $emailConfig)
    {
        return view('admin.email_configs.edit')->with(compact('emailConfig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  EmailConfig $emailConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailConfig $emailConfig)
    {
        $emailConfig->update($request->except('_method', '_token'));
        return redirect()->route('admin.outlet.show', $emailConfig->outlet_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  EmailConfig $emailConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailConfig $emailConfig)
    {
        //
    }

    private function upload($request)
    {
        if ($request->hasFile('file')) {
            $host = $request->getSchemeAndHttpHost();
            $image = $request->file('file');
            $size = $image->getSize();
            $newImageName = date('YmdHis');
            $extension = $image->getClientOriginalExtension();
            $imagePath = 'public/email_configs/' . $newImageName . '.' . $extension;
            $storage = Storage::disk('local');
            $response = $storage->put($imagePath, file_get_contents($image));
            $uploadPath = $storage->url($imagePath);
                $upload = [
                    'signature' => asset($uploadPath),
                 ];
            return $upload;
        }
    }
}
