<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::first();
        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Contact::first();
        if ($setting) {
            $logo = $request->oldImage;
            if ($request->file('logo')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $logo = $request->file('logo')->store('setting-images');
            }

            $setting->update([
                'name' => $request->name,
                'address' => $request->address,
                'map' => $request->map,
                'phone' => $request->phone,
                'logo' => $logo,
            ]);
            return redirect()->back()->with('success', 'Kontak Tersimpan');
        } else {
            $logo = NULL;
            if ($request->file('logo')) {
                $logo = $request->file('logo')->store('setting-images');
            }
            Contact::create([
                'name' => $request->name,
                'address' => $request->address,
                'map' => $request->map,
                'phone' => $request->phone,
                'logo' => $logo,
            ]);

            return redirect()->back()->with('success', 'Kontak Tersimpan');
        }
    }
}
