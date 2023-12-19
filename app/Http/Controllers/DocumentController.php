<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Auth;
use Session;

class DocumentController extends Controller
{
    public function documentEmployeeAdd(Request $request)
    {
        $validated = $request->validate([
            'document_title' => 'required',
            'document_type' => 'required',
            'document_description' => 'required',
            'document_file' => 'required',
        ]);
        try {
            $employee_document = new Document();
            $employee_document->document_com_id = Auth::user()->com_id;
            // $employee_document->document_uploaded_employee_id  = Auth::user()->id;
            $employee_document->document_employee_id = $request->id;
            $employee_document->document_type = $request->document_type;
            $employee_document->document_title = $request->document_title;
            $employee_document->document_description = $request->document_description;

            $image = $request->file('document_file');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/employee-document-files';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $employee_document->document_file = $imageUrl;
            $employee_document->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
       
    }

    public function documentAddByEmployee(Request $request)
    {
        $validated = $request->validate([
            'document_title' => 'required',
            'document_type' => 'required',
            'document_description' => 'required',
            'document_file' => 'required',
        ]);
        try {
            $employee_document = new Document();
            $employee_document->document_com_id = Auth::user()->com_id;
            $employee_document->document_employee_id = $request->id;
            // $employee_document->document_uploaded_employee_id = $request->id;
            $employee_document->document_type = $request->document_type;
            $employee_document->document_title = $request->document_title;
            $employee_document->document_description = $request->document_description;

            $image = $request->file('document_file');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/employee-document-files';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $employee_document->document_file = $imageUrl;
            $employee_document->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeDocumentById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeDocumentByIds = Document::where($where)->first();

        return response()->json($employeeDocumentByIds);
    }

    public function employeeDocumentUpdate(Request $request)
    {
        $validated = $request->validate([
            'document_title' => 'required',
            'document_type' => 'required',
            'document_description' => 'required',
        ]);
        try {
            $employee_document = Document::find($request->id);
            $employee_document->document_type = $request->document_type;
            $employee_document->document_title = $request->document_title;
            $employee_document->document_description = $request->document_description;
            if ($request->file('document_file')) {
                $image = $request->file('document_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-document-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
            } else {
                $imageUrl = $request->document_file_hidden;
            }
            $employee_document->document_file = $imageUrl;
            $employee_document->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeDocument($id)
    {
        try {
            $employee_document = Document::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteOfficeDocument(Request $request)
    {
        try {
            $document = Document::where('document_com_id', $request->bulk_delete_com_id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}