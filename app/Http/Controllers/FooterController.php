<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use Auth;

class FooterController extends Controller
{
    public function footer()
    {
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.template.appointment.header-footer.footer', compact('footers'));
    }


    public function footerAdd(Request $req)
    {
        $footers = new Footer();
        $footers->footer_com_id = Auth::user()->com_id;
        $footers->footer_description =  $req->footer_desc;
        $footers->save();

        return back()->with('message', 'Added Successfully');
    }

    public function footerUpdate(Request $req, $id)
    {
        $footers =  Footer::findOrFail($id);
        $footers->footer_com_id = Auth::user()->com_id;
        $footers->footer_description =  $req->footer_desc;
        $footers->save();

        return back()->with('message', 'Update Successfully');
    }
    
    public function footerDelete($id)
    {
        $footers =  Footer::where('id', $id)->delete();
        return back()->with('message', 'Delete Successfully');
    }
}
