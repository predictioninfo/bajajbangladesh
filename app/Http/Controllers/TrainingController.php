<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Trainer;
use App\Models\TrainingType;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use Exception;

class TrainingController extends Controller
{
    public function trainingTypeIndex()
    {
        $trainings = TrainingType::where('training_type_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.training.training-type.training-type-index', compact('trainings'));
    }
    public function trainerIndex()
    {
        $trainers = Trainer::where('trainer_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.training.trainers.trainers-index', compact('trainers'));
    }
    public function trainingListIndex()
    {
        $training_types = TrainingType::where('training_type_com_id', Auth::user()->com_id)->get();
        $trainers = Trainer::where('trainer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', Auth::user()->com_id)->get();
        $trainings = Training::where('training_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.training.training-list.training-list-index', compact('training_types', 'trainers', 'employees', 'trainings'));
    }



    public function trainingAdd(Request $request)
    {

        $validated = $request->validate([
            'training_tring_typ_id' => 'required',
            'training_emp_id' => 'required',
            'training_trainer_id' => 'required',
            'training_start_date' => 'required',
            'training_end_date' => 'required',
            'training_start_time' => 'required',
            'training_end_time' => 'required',
            'training_cost' => 'required',
            'training_attachmnt' => 'required',
            'training_desc' => 'required',
        ]);
        try {
            $employee_ids_array = [$request->training_emp_id];
            $trainer_ids_array = [$request->training_trainer_id];

            foreach ($employee_ids_array as $ids) {
                $employee_ids = json_encode($ids);
            }

            foreach ($trainer_ids_array as $trainer_ids) {
                $trainer_ids = json_encode($trainer_ids);
            }

            $training = new Training();
            $training->training_com_id = Auth::user()->com_id;
            $training->training_tring_typ_id = $request->training_tring_typ_id;
            $training->training_emp_id =  $employee_ids;
            $training->training_trainer_id = $trainer_ids;
            $training->training_start_date = $request->training_start_date;
            $training->training_end_date = $request->training_end_date;
            $training->training_start_time = $request->training_start_time;
            $training->training_end_time = $request->training_end_time;
            $training->training_cost = $request->training_cost;

            $image = $request->file('training_attachmnt');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/training-attachments';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $training->training_attachmnt = $imageUrl;

            $training->training_desc = $request->training_desc;
            $training->training_status = "Pending";
            $training->save();


            if ($request->training_emp_id) {

                $employees = User::where('com_id', Auth::user()->com_id)->get();
                foreach ($employees as $employees_value) {
                    foreach ($request->training_emp_id as $employee_indivisual_id) {
                        if ($employee_indivisual_id == $employees_value->id) {

                            $data["email"] = $employees_value->email;
                            $data["request_sender_name"] = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                            $data["subject"] = "Training";

                            $sender_name = array(
                                'sender_name_value' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.training-notice-for-trainer', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        }
                    }
                }
            }

            if ($request->training_trainer_id) {

                $trainers = Trainer::where('trainer_com_id', Auth::user()->com_id)->get();
                foreach ($trainers as $trainers_value) {
                    foreach ($request->training_trainer_id as $trainer_indivisual_id) {
                        if ($trainer_indivisual_id == $trainers_value->id) {

                            $data["email"] = $trainers_value->trainer_email;
                            $data["request_sender_name"] = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                            $data["subject"] = "Training";

                            $sender_name = array(
                                'sender_name_value' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.training-notice-for-employee', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        }
                    }
                }
            }


            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function trainingById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = Training::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function trainingUpdate(Request $request)
    {

        // $validated = $request->validate([
        //     'trainer' => 'required',
        // ]);
        try {
            $training = Training::find($request->id);
            if ($request->training_tring_typ_id) {
                $training->training_tring_typ_id = $request->training_tring_typ_id;
            }
            if ($request->training_emp_id) {

                $employees = User::where('com_id', Auth::user()->com_id)->get();
                foreach ($employees as $employees_value) {
                    foreach ($request->training_emp_id as $employee_indivisual_id) {
                        if ($employee_indivisual_id == $employees_value->id) {

                            $data["email"] = $employees_value->email;
                            $data["request_sender_name"] = $employees_value->first_name . ' ' . $employees_value->last_name;
                            $data["subject"] = "Training";

                            $sender_name = array(
                                'sender_name_value' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.training-notice-for-trainer ', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        }
                    }
                }
            }

            if ($request->training_trainer_id) {

                $trainers = Trainer::where('trainer_com_id', Auth::user()->com_id)->get();
                foreach ($trainers as $trainers_value) {
                    foreach ($request->training_trainer_id as $trainer_indivisual_id) {
                        if ($trainer_indivisual_id == $trainers_value->id) {

                            $data["email"] = $trainers_value->trainer_email;
                            $data["request_sender_name"] = $trainers_value->trainer_first_name . ' ' . $trainers_value->trainer_last_name;
                            $data["subject"] = "Training";

                            $sender_name = array(
                                'sender_name_value' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.training-notice-for-employee', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        }
                    }
                }
            }


            if ($request->training_emp_id) {
                $training->training_emp_id = $request->training_emp_id;
            }
            if ($request->training_trainer_id) {
                $training->training_trainer_id = $request->training_trainer_id;
            }
            $training->training_start_date = $request->training_start_date;
            $training->training_end_date = $request->training_end_date;
            $training->training_start_time = $request->training_start_time;
            $training->training_end_time = $request->training_end_time;

            if ($request->training_attachmnt) {
                $image = $request->file('training_attachmnt');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/training-attachments';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);

                $training->training_attachmnt = $imageUrl;
            }

            $training->training_status = $request->training_status;
            $training->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function trainingDelete($id)
    {
        try {
            $training = Training::find($id);
            $training->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!There are some dependency.Please Contact your IT Support.');
        }
    }
}