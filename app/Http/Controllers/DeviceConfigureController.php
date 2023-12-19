<?php


namespace App\Http\Controllers;

use App\Http\traits\CommonMethod;
use App\Models\Area;
use App\Models\DeviceArea;
use App\Models\DeviceConfigure;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use Auth;

class DeviceConfigureController extends Controller
{
    use CommonMethod;
    public function setIp()
    {
        $finger_print_sub_module_five_add = "20.5.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $finger_print_sub_module_five_edit = "20.5.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $finger_print_sub_module_five_delete = "20.5.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $ip = DeviceConfigure::where('com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.device-config.configuration.index', get_defined_vars());
    }
    public function addDeviceIp(Request $request)
    {
        $validated = $request->validate([
            'device_ip' => 'required',
        ]);
        $deviceConfig = new DeviceConfigure();
        $deviceConfig->com_id = Auth::user()->com_id;
        $deviceConfig->ip = 'http://' . $request->device_ip . '/';
        $deviceConfig->save();
        return redirect()->back()->with('message', 'Ip address saved successfully');
    }
    public function ipById(Request $request)
    {
        $ip = DeviceConfigure::where('com_id', Auth::user()->com_id)->where('id', $request->id)->first();
        return response()->json($ip);
    }
    public function ipUpdate(Request $request)
    {
        $ip =  DeviceConfigure::where('id', $request->id)->first();
        $ip->com_id = Auth::user()->com_id;
        $ip->ip = 'http://' . $request->ip_code . '/';
        $ip->save();
        return redirect()->back()->with('message', 'Updated Success');
    }
    public function ipDelete(Request $request)
    {
        DeviceConfigure::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Deleted Success');
    }
    public function tokenGenerate()
    {
        $finger_print_sub_module_six_add = "20.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $finger_print_sub_module_six_edit = "20.6.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }
        $token = DeviceToken::where('com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.device-config.token.index', get_defined_vars());
    }
    public function addDeviceToken(Request $request)
    {
        // Retrieve the first record from the 'DeviceConfigure' model where 'com_id' matches the authenticated user's 'com_id'
        $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();

        // Check if $ipCheck is null, meaning there is no matching record
        if ($ipCheck == null) {
            // If no matching record is found, redirect back with a message and a link to the 'set-ip' route
            return redirect()->back()->with('message', 'Firstly set <a href="' . route('set-ip') . '">IP Address</a>');
        } else {
            // Retrieve the 'ip' property from the $ipCheck result
            $ip = $ipCheck->ip;
            // If a matching record is found, continue with the following logic:

            // Validate the 'username' and 'password' fields in the request
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            try {
                // Make a POST request to an external API located at 'http://127.0.0.1:8090/jwt-api-token-auth/'
                $response = Http::post($ip . 'jwt-api-token-auth/', [
                    'username' => $request->username,
                    'password' => $request->password,
                    // Other fields as needed
                ]);

                // Convert the response content to JSON
                $responseData = $response->json();

                // Get the HTTP status code of the response
                $status = $response->getStatusCode();

                // If the status code is 200 (OK), proceed to save the device token
                if ($status === 200) {
                    $deviceToken = new DeviceToken;
                    $deviceToken->com_id = Auth::user()->com_id;
                    $deviceToken->token = $responseData['token'];
                    $deviceToken->save();
                }

                // Check the status code and return an appropriate message
                if ($status === 400) {
                    return redirect()->back()->with('message', 'Check Username or Password carefully');
                } else {
                    return redirect()->back()->with('message', 'Token generated');
                }
            } catch (\Exception $e) {
                // Handle exceptions (errors) that occur during the API request and return a 500 (Internal Server Error) response
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function tokenById(Request $request)
    {
        $token = DeviceToken::where('com_id', Auth::user()->com_id)->where('id', $request->id)->first();
        return response()->json($token);
    }
    public function tokenByUpdate(Request $request)
    {

        // Retrieve the first record from the 'DeviceConfigure' model where 'com_id' matches the authenticated user's 'com_id'
        $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();

        // Check if $ipCheck is null, meaning there is no matching record
        if ($ipCheck == null) {
            // If no matching record is found, redirect back with a message and a link to the 'set-ip' route
            return redirect()->back()->with('message', 'Firstly set <a href="' . route('set-ip') . '">IP Address</a>');
        } else {
            // Retrieve the 'ip' property from the $ipCheck result
            $ip = $ipCheck->ip;
            // If a matching record is found, continue with the following logic:

            // Validate the 'username' and 'password' fields in the request
            $validated = $request->validate([
                'token_update' => 'required',
            ]);

            try {
                // Make a POST request to an external API located at 'http://127.0.0.1:8090/jwt-api-token-auth/'
                $response = Http::post($ip . 'jwt-api-token-refresh/', [
                    'token' => $request->token_update,
                    // Other fields as needed
                ]);

                // Convert the response content to JSON
                $responseData = $response->json();
                // Get the HTTP status code of the response
                $status = $response->getStatusCode();

                // If the status code is 200 (OK), proceed to save the device token
                if ($status === 200) {
                    $deviceToken =  DeviceToken::where('id', $request->id)->first();
                    $deviceToken->com_id = Auth::user()->com_id;
                    $deviceToken->token = $responseData['token'];
                    $deviceToken->save();
                }

                // Check the status code and return an appropriate message
                if ($status === 400) {
                    return redirect()->back()->with('message', 'Something went wrong');
                } else {
                    return redirect()->back()->with('message', 'Token Update Successfully');
                }
            } catch (\Exception $e) {
                // Handle exceptions (errors) that occur during the API request and return a 500 (Internal Server Error) response
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function deviceArea()
    {
        try {


            $finger_print_sub_module_one_add = "20.1.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $finger_print_sub_module_one_edit = "20.1.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $finger_print_sub_module_one_delete = "20.1.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();

            if ($ipCheck == null) {
                return redirect('set-ip')->with('message', 'Firstly set IP Address');
            } elseif ($device_token == null) {
                return redirect('token-list')->with('message', 'Firstly set Device Token');
            } else {
                $ip = $ipCheck->ip;
                $response = Http::withHeaders([
                    'Authorization' => 'JWT ' . $device_token->token,
                ])->get($ip . 'personnel/api/areas/?page_size=200');

                // Process the response
                $responseData = $response->json();
                // Handle the response data and return a response to the client
                return view('back-end.premium.device-config.area.index', [
                    'data' => $responseData['data'], 'add_permission' => $add_permission, 'edit_permission' => $edit_permission, 'delete_permission' => $delete_permission,
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deviceAreaAdd(Request $request)
    {

        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->post($ipCheck->ip . 'personnel/api/areas/', [
                'area_code' => $request->device_area_id,
                'area_name' => $request->device_area_name,
                'parent_area' => null,
                // Other fields as needed
            ]);

            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();
            if ($status === 201) {
                $device_area = new DeviceArea;
                $device_area->com_id = Auth::user()->com_id;
                $device_area->area_code = $request->device_area_id;
                $device_area->area_name = $request->device_area_name;
                $device_area->save();
            }
            // return $status;
            if ($status === 400) {
                return redirect()->back()->with('message', 'Area Code is Unique');
            } else {
                return redirect()->back()->with('message', 'Insert Success');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deviceAreaById(Request $request)
    {
        $id = $request->input('id');
        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            $url = $ipCheck->ip . "personnel/api/areas/$id/";
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->get($url);

            // Process the response
            $responseData = $response->json();
            return response()->json($responseData);
            // Handle the response data and return a response to the client
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deviceAreaByUpdate(Request $request)
    {
        $id = $request->input('id');

        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->put($ipCheck->ip . "personnel/api/areas/$id/", [
                'area_code' => $request->area_code,
                'area_name' => $request->area_name,
                'parent_area' => null,
                // Other fields as needed
            ]);

            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();

            $device_area =  DeviceArea::where('id', $id)->first();
            $device_area->com_id = Auth::user()->com_id;
            $device_area->area_code = $request->area_code;
            $device_area->area_name = $request->area_name;
            $device_area->save();
            // return $status;
            if ($status === 400) {
                return redirect()->back()->with('message', 'Update failed');
            } else {
                return redirect()->back()->with('message', 'Update Success');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deviceAreaDelete(Request $request)
    {
        $id = $request->input('id');

        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->delete($ipCheck->ip . "personnel/api/areas/$id/");

            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();
            if ($status === 204) {
                DeviceArea::where('id', $id)->delete();
            }
            // return $status;
            if ($status === 500) {
                return redirect()->back()->with('message', 'Delete Not Possible because this area already used');
            } else {
                return redirect()->back()->with('message', 'Delete Success');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getDeviceAreaList()
    {
        $get_device_area = DeviceArea::get();
        return response()->json($get_device_area);
    }
    public function deviceList(Request $request)
    {
        try {
            $finger_print_sub_module_re_boot = "20.2.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $finger_print_sub_module_re_boot . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $finger_print_sub_module_re_boot = "Yes";
            } else {
                $finger_print_sub_module_re_boot = "No";
            }
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            if ($ipCheck == null) {
                return redirect('set-ip')->with('message', 'Firstly set IP Address');
            } elseif ($device_token == null) {
                return redirect('token-list')->with('message', 'Firstly set Device Token');
            } else {
                $response = Http::withHeaders([
                    'Authorization' => 'JWT ' . $device_token->token,
                ])->get($ipCheck->ip . 'iclock/api/terminals/');

                // Process the response
                $responseData = $response->json();
                $areas = DeviceArea::where('com_id', Auth::user()->com_id)->get();
                // Handle the response data and return a response to the client
                return view('back-end.premium.device-config.devices.index', [
                    'data' => $responseData['data'], 'finger_print_sub_module_re_boot' => $finger_print_sub_module_re_boot, 'areas' => $areas
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deviceReBoot(Request $request)
    {
        $id = $request->input('reboot');
        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->post($ipCheck->ip . 'iclock/api/terminals/reboot/', [
                'terminals' => $id
                // Other fields as needed
            ]);
            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();
            if ($status !== 200) {
                return redirect()->back()->with('message', 'Please Configure Device Properly');
            } else {
                return redirect()->back()->with('message', 'Device Restart Successfully');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function employeeWithFp()
    {
        try {
            $employee_with_finger_print_sub_module = "20.4.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_with_finger_print_sub_module . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_finger_print = "Yes";
            } else {
                $delete_finger_print = "No";
            }
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            if ($ipCheck == null) {
                return redirect('set-ip')->with('message', 'Firstly set IP Address');
            } elseif ($device_token == null) {
                return redirect('token-list')->with('message', 'Firstly set Device Token');
            } else {
                $response = Http::withHeaders([
                    'Authorization' => 'JWT ' . $device_token->token,
                ])->get($ipCheck->ip . 'personnel/api/employees/?page_size=200');

                // Process the response
                $responseData = $response->json();

                // Handle the response data and return a response to the client
                return view('back-end.premium.device-config.employee.index', [
                    'data' => $responseData['data'], 'delete_finger_print' => $delete_finger_print

                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getDeviceArea(Request $request)
    {
        $device_area = DeviceArea::where('com_id', AUth::user()->com_id)->get();
        return response()->json($device_area);
    }

    public function deleteEmployeeWithFp(Request $request)
    {
        $id = $request->input('id');

        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            //For Employee Attendance type change 
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->get($ipCheck->ip . "personnel/api/employees/$id/");
            $responseData = $response->json();
            $userDetails = User::where('company_assigned_id', $responseData['emp_code'])->update([
                'attendance_type' => 'ip_based',
                'device_area' => NULL,
            ]);

            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->delete($ipCheck->ip . "personnel/api/employees/$id/");

            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();
            if ($status === 204) {
                DeviceArea::where('id', $id)->delete();
            }
            // return $status;
            if ($status === 500) {
                return redirect()->back()->with('message', 'Delete Not Possible because this area already used');
            } else {
                return redirect()->back()->with('message', 'Delete Employee Successfully from Finger print Device Database, now this employee can give attendance regularly!! ');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function employeeWithoutFp()
    {
        $employee_with_finger_print_sub_module = "20.3.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_with_finger_print_sub_module . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_finger_print = "Yes";
        } else {
            $add_finger_print = "No";
        }
        $employee_without_fp = User::where('com_id', Auth::user()->com_id)->whereNull('company_profile')->whereNull('device_area')
            ->select('id', 'company_assigned_id', 'first_name', 'last_name', 'email')
            ->get();
        return view('back-end.premium.device-config.employee.employee-without-fp', get_defined_vars());
    }
    public function employeeWithFpAdd(Request $request)
    {
        $device_area[] = $request->device_area_id;
        $user_details = User::where('id', $request->employeeId)->select('id', 'company_assigned_id', 'first_name', 'last_name')->first();

        try {
            $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
            $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
            // Make request to external API
            $response = Http::withHeaders([
                'Authorization' => 'JWT ' . $device_token->token,
            ])->post($ipCheck->ip . 'personnel/api/employees/', [
                'emp_code' => $user_details->company_assigned_id,
                'first_name' => $user_details->first_name,
                'last_name' => $user_details->last_name,
                'department' => 1,
                'area'     => $device_area,
                // Other fields as needed
            ]);
            $userDetails = User::where('id', $request->employeeId)->update([
                'attendance_type' => 'finger_print',
                'device_area' => $request->device_area_id,
            ]);
            // Process the response
            $responseData = $response->json();

            // Handle the response data and return a response to the client
            $status = $response->getStatusCode();
            if ($status == 201) {
                return redirect()->back()->with('message', 'Employee Eligibility for Finger Print!!!');
            } else {
                return redirect()->back()->with('message', 'Something went wrong!!!');
            }
        } catch (\Exception $e) {
            // Handle exceptions (errors) that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
