<?php

namespace App\Http\Controllers;

use App\Models\Immigrant;
use Illuminate\Http\Request;
use Auth;
use Session;

class ImmigrantController extends Controller
{
    //
    public function immigrantEmployeeAdd(Request $request)
    {
        if (Immigrant::where('immigrant_com_id', Auth::user()->com_id)->where('immigrant_employee_id', Session::get('employee_setup_id'))->exists()) {
            return back()->with('message', 'Already Added!!!');
        } else {
            $validated = $request->validate([
                'immigrant_document_type' => 'required',
                'immigrant_document_number' => 'required',
                'immigrant_issue_date' => 'required',
                'immigrant_expired_date' => 'required',
                'immigrant_eligible_review_date' => 'required',
                'immigrant_document_file' => 'required',
                'immigrant_country' => 'required',
            ]);
            try {
                $immigrant = new Immigrant();
                $immigrant->immigrant_com_id = Auth::user()->com_id;
                $immigrant->immigrant_employee_id = Session::get('employee_setup_id');
                $immigrant->immigrant_document_type = $request->immigrant_document_type;
                $immigrant->immigrant_document_number = $request->immigrant_document_number;
                $immigrant->immigrant_issue_date = $request->immigrant_issue_date;
                $immigrant->immigrant_expired_date = $request->immigrant_expired_date;
                $immigrant->immigrant_eligible_review_date = $request->immigrant_eligible_review_date;
                //$immigrant->immigrant_document_file = $request->immigrant_document_file;

                $image = $request->file('immigrant_document_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/immigrant-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);

                $immigrant->immigrant_document_file = $imageUrl;
                $immigrant->immigrant_country = $request->immigrant_country;
                $immigrant->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Added Successfully');
        }
    }

    public function employeeImmigrantById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeImmigrantByIds = Immigrant::where($where)->first();

        return response()->json($employeeImmigrantByIds);
    }

    public function employeeImmigrantUpdate(Request $request)
    {
        $validated = $request->validate([
            'immigrant_document_type' => 'required',
            'immigrant_document_number' => 'required',
            'immigrant_issue_date' => 'required',
            'immigrant_expired_date' => 'required',
            'immigrant_eligible_review_date' => 'required',
            'immigrant_country' => 'required',
        ]);
        try {
            $immigrant = Immigrant::find($request->id);
            $immigrant->immigrant_document_type = $request->immigrant_document_type;
            $immigrant->immigrant_document_number = $request->immigrant_document_number;
            $immigrant->immigrant_issue_date = $request->immigrant_issue_date;
            $immigrant->immigrant_expired_date = $request->immigrant_expired_date;
            $immigrant->immigrant_eligible_review_date = $request->immigrant_eligible_review_date;

            if ($request->file('immigrant_document_file')) {
                $image = $request->file('immigrant_document_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/immigrant-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
            } else {
                $imageUrl = $request->immigrant_document_file_hidden;
            }

            $immigrant->immigrant_document_file = $imageUrl;
            $immigrant->immigrant_country = $request->immigrant_country;
            $immigrant->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeImmigrant($id)
    {
        try {
            $immigrant = Immigrant::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}