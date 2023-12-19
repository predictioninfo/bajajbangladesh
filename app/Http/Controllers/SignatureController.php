<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use App\Models\User;
use Auth;
use Image;

class SignatureController extends Controller
{
    public function addsignature(Request $request)
    {
        $validated = $request->validate([
            'signature_name' => 'required',
            'signature_bangla_name' => 'required',
            'signature_com_name' => 'required',
            'signature_com_bangla_name' => 'required',
            'signature_designation' => 'required',
            'signature_bangla_designation' => 'required',
            'signature_photo' => 'required',
        ]);
        try {
            $signature = new Signature();
            $signature->signature_com_id = Auth::user()->com_id;
            $signature->signature_name = $request->signature_name;
            $signature->signature_bangla_name = $request->signature_bangla_name;
            $signature->signature_com_name = $request->signature_com_name;
            $signature->signature_com_bangla_name = $request->signature_com_bangla_name;
            $signature->signature_designation = $request->signature_designation;
            $signature->signature_bangla_designation = $request->signature_bangla_designation;

            $image = $request->file('signature_photo');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/asset-images';
            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $signature->signature_photo = $imageUrl;

            $filePath = 'uploads/asset-images/before-resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);

            $signature->save();
            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function Updatesignature(Request $request)
    {
        $validated = $request->validate([
            'signature_name' => 'required',
            'signature_bangla_name' => 'required',
            'signature_com_name' => 'required',
            'signature_com_bangla_name' => 'required',
            'signature_designation' => 'required',
            'signature_bangla_designation' => 'required',

        ]);
        try {
            $signature = Signature::find($request->id);
            $signature->signature_com_id = Auth::user()->com_id;
            $signature->signature_name = $request->signature_name;
            $signature->signature_bangla_name = $request->signature_bangla_name;
            $signature->signature_com_name = $request->signature_com_name;
            $signature->signature_com_bangla_name = $request->signature_com_bangla_name;
            $signature->signature_designation = $request->signature_designation;
            $signature->signature_bangla_designation = $request->signature_bangla_designation;
            if ($request->signature_photo) {
                $image = $request->file('signature_photo');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/asset-images';
                $img = Image::make($image->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $input['imagename']);
                $imageUrl = $filePath . '/' . $input['imagename'];
                $signature->signature_photo = $imageUrl;

                $filePath = 'uploads/asset-images/before-resized/';
                $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            }
            $signature->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function SignatureDelete($id)
    {
        try {
            $signature = Signature::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function Signatureapprove(Request $request)
    {
        $validated = $request->validate([
            'signature_id' => 'required',

        ]);
        try {
            $signature = User::find($request->id);
            $signature->signature_id = $request->signature_id;
            $signature->save();
            return back()->with('message', 'Sigantory Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}