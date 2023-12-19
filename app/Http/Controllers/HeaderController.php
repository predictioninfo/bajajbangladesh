<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Auth;
use Image;

class HeaderController extends Controller
{
  public function index()
  {
    $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
    return view('back-end.premium.template.appointment.header-footer.header', compact('headers'));
  }

  public function headerAdd(Request $request)
  {
    $headers = new Header();
    $headers->header_com_id = Auth::user()->com_id;
    $headers->header_description =  $request->header_desc;

    $image = $request->logo;
    $imageName = $image->move('uploads/logos/', $image->getClientOriginalName());
    $imageUrl = $imageName;
    $headers->logo = $imageUrl;
    $headers->save();

    return back()->with('message', 'Added Successfully');
  }
  public function headerShow(Request $request)
  {
    $header = Header::where('id', $request->id)->first();
    return response()->json(get_defined_vars());
  }
  public function headerUpdate(Request $request)
  {
    $header =  Header::find($request->id);
    $header->header_com_id = Auth::user()->com_id;
    $header->header_description =  $request->edit_header_desc;
    if ($request->edit_logo) {
      $image = $request->edit_logo;
      $imageName = $image->move('uploads/logos/', $image->getClientOriginalName());
      $imageUrl = $imageName;
      $header->logo = $imageUrl;
    }
    $header->save();

    return back()->with('message', 'Update Successfully');
  }
  public function headerDelete($id)
  {
    $header =  Header::where('id', $id)->delete();
    return back()->with('message', 'Delete Successfully');
  }
}
