<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use Auth;
use Session;

class EmergencyContactController extends Controller
{
    public function emergencyContactEmployeeAdd(Request $request)
    {
        $validated = $request->validate([
            'emergency_contact_name' => 'required',
            'emergency_contact_relation' => 'required',
            'emergency_contact_email' => 'required|email',
            'emergency_contact_phone' => 'required',
            'emergency_contact_address' => 'required',
        ]);
        try {
            $emergency_contact = new EmergencyContact();
            $emergency_contact->emergency_contact_com_id = Auth::user()->com_id;
            $emergency_contact->emergency_contact_employee_id = Session::get('employee_setup_id');
            $emergency_contact->emergency_contact_name = $request->emergency_contact_name;
            $emergency_contact->emergency_contact_relation = $request->emergency_contact_relation;
            $emergency_contact->emergency_contact_email = $request->emergency_contact_email;
            $emergency_contact->emergency_contact_phone = $request->emergency_contact_phone;
            $emergency_contact->emergency_contact_address = $request->emergency_contact_address;
            $emergency_contact->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeEmergencyContactById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeEmergencyContactByIds = EmergencyContact::where($where)->first();

        return response()->json($employeeEmergencyContactByIds);
    }

    public function employeeEmergencyContactUpdate(Request $request)
    {
        $validated = $request->validate([
            'emergency_contact_name' => 'required',
            'emergency_contact_relation' => 'required',
            'emergency_contact_email' => 'required|email',
            'emergency_contact_phone' => 'required',
            'emergency_contact_address' => 'required',
        ]);
        try {
            $emergency_contact = EmergencyContact::find($request->id);
            $emergency_contact->emergency_contact_name = $request->emergency_contact_name;
            $emergency_contact->emergency_contact_relation = $request->emergency_contact_relation;
            $emergency_contact->emergency_contact_email = $request->emergency_contact_email;
            $emergency_contact->emergency_contact_phone = $request->emergency_contact_phone;
            $emergency_contact->emergency_contact_address = $request->emergency_contact_address;
            $emergency_contact->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeEmergencyContact($id)
    {
        try {
            $emergency_contact = EmergencyContact::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}