<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FileManager;
use App\Models\FileConfig;
use App\Models\Document;
use App\Models\Permission;
use App\Models\VariableType;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use Image;

class FileManagerController extends Controller
{
    public function FileManagerIndex()
    {
        $file_manager_sub_module_one_add = "14.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $file_manager_sub_module_one_edit = "14.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $file_manager_sub_module_one_delete = "14.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $file_managers = FileManager::join('departments', 'file_managers.file_manager_department_id', '=', 'departments.id')
            ->select('file_managers.*', 'departments.department_name')
            ->where('file_manager_com_id', Auth::user()->com_id)
            ->get();
        return view('back-end.premium.file-manager.file-manager.file-manager-index', compact('departments', 'file_managers', 'add_permission', 'edit_permission', 'delete_permission'));
    }
    public function officialDocumentIndex()
    {

        $file_manager_sub_module_two_add = "14.2.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $file_manager_sub_module_two_edit = "14.2.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $file_manager_sub_module_two_delete = "14.2.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        //$document_details = Document::where('document_com_id','=',Auth::user()->com_id)->get();
        $document_details = Document::with('documentUploadedByEmployee', 'documentEmployee')
            // ->select('documents.*', 'users.first_name', 'users.last_name')
            ->where('document_com_id', Auth::user()->com_id)
            ->get();
        $documnets_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Document-Type')->get();
        $users = User::where('com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.file-manager.official-document.official-document-index', compact('document_details', 'add_permission', 'edit_permission', 'delete_permission', 'documnets_types', 'users'));
    }

    public function fileConfigureIndex()
    {
        $file_configs = FileConfig::where('file_config_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.file-manager.file-config.file-config-index', compact('file_configs'));
    }

    public function fileManagerAdd(Request $request)
    {
        $validated = $request->validate([
            'file_manager_name' => 'required',
            'file_manager_department_id' => 'required',
            'file_manager_external_link' => 'required',
            'file_manager_file' => 'required',
        ]);
        try {
            $file_manager = new FileManager();
            $file_manager->file_manager_com_id = Auth::user()->com_id;
            $file_manager->file_manager_department_id = $request->file_manager_department_id;
            $file_manager->file_manager_name = $request->file_manager_name;
            $file_manager->file_manager_external_link = $request->file_manager_external_link;

            $image = $request->file('file_manager_file');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/file-managers';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $imageFileSizeInByte = filesize($imageUrl);
            $imageFileSizeInMb = ($imageFileSizeInByte / 1024) / 1024;

            if (FileConfig::where('file_config_com_id', Auth::user()->com_id)->exists()) {
                $file_configs = FileConfig::where('file_config_com_id', Auth::user()->com_id)->get('file_config_file_size');
                foreach ($file_configs as $file_configs_value) {
                    if ($file_configs_value->file_config_file_size >= $imageFileSizeInMb) {
                        $file_manager->file_manager_file = $imageUrl;
                    } else {
                        return back()->with('message', 'File Size Sould Be Less Than or Equal To The Configured File Size!!!');
                    }
                }
            } else {
                $file_manager->file_manager_file = $imageUrl;
            }
            $file_manager->file_manager_file = $imageUrl;
            $file_manager->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function fileManagerById(Request $request)
    {

        $where = array('id' => $request->id);
        $fileManagerByIds = FileManager::where($where)->first();

        return response()->json($fileManagerByIds);
    }

    public function fileManagerUpdate(Request $request)
    {
        $validated = $request->validate([
            'file_manager_name' => 'required',
            'file_manager_department_id' => 'required',
            'file_manager_external_link' => 'required',
            'file_manager_file' => 'required',
        ]);
        try {
            $file_manager = FileManager::find($request->id);
            $file_manager->file_manager_department_id = $request->file_manager_department_id;
            $file_manager->file_manager_name = $request->file_manager_name;
            $file_manager->file_manager_external_link = $request->file_manager_external_link;
            if ($request->file('file_manager_file')) {
                $image = $request->file('file_manager_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/file-managers';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $file_manager->file_manager_file = $imageUrl;
            }
            $file_manager->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }
    public function deleteFileManager($id)
    {
        try {
            $file_manager = FileManager::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteFileManager(Request $request)
    {
        $file_manager = FileManager::where('file_manager_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}