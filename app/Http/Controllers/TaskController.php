<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    public function employeeSetupTaskStore(Request $request)
    {

        $validated = $request->validate([
            'task_assigned_to' => 'required',
            'task_title' => 'required',
            'task_start_date' => 'required',
            'task_end_date' => 'required',
            'task_progress' => 'required',
        ]);
        try {
            $task = new Task();
            $task->task_com_id = Auth::user()->com_id;
            $task->task_assigned_to = $request->task_assigned_to;
            $task->task_title = $request->task_title;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_assigned_by = Auth::user()->id;
            $task->task_progress = $request->task_progress;
            $task->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeSetupTaskById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeTaskByIds = Task::where($where)->first();

        return response()->json($employeeTaskByIds);
    }

    public function updateEmployeeSetupTask(Request $request)
    {
        $validated = $request->validate([
            'task_title' => 'required',
            'task_start_date' => 'required',
            'task_end_date' => 'required',
            'task_progress' => 'required',
        ]);
        try {
            $task = Task::find($request->id);
            $task->task_title = $request->task_title;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_progress = $request->task_progress;
            $task->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeSetupTask($id)
    {
        $task = Task::where('id', $id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }

    public function taskStore(Request $request)
    {

        $validated = $request->validate([
            'task_assigned_to' => 'required',
            'task_title' => 'required',
            'task_start_date' => 'required',
            'task_end_date' => 'required',
            'task_progress' => 'required',
        ]);
        try {
            $employee_array = [$request->task_assigned_to];

            foreach ($employee_array as $employee_array_data) {
                $task = new Task();
                $task->task_com_id = Auth::user()->com_id;
                $task->task_title = $request->task_title;
                $task->task_start_date = $request->task_start_date;
                $task->task_end_date = $request->task_end_date;
                $task->task_project_id = $request->task_project_id;
                $task->task_assigned_to = json_encode($employee_array_data);
                $task->task_estimated_hour = $request->task_estimated_hour;
                $task->task_assigned_by = Auth::user()->id;
                $task->task_progress = $request->task_progress;
                $task->save();
            }
            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function taskById(Request $request)
    {

        $where = array('id' => $request->id);
        $taskByIds = Task::where($where)->first();

        return response()->json($taskByIds);
    }

    public function updateTask(Request $request)
    {
        $validated = $request->validate([
            'task_assigned_to' => 'required',
            'task_title' => 'required',
            'task_start_date' => 'required',
            'task_end_date' => 'required',
            'task_progress' => 'required',
        ]);
        try {
            $task = Task::find($request->id);
            $task->task_com_id = Auth::user()->com_id;
            $task->task_title = $request->task_title;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            if ($request->task_project_id) {
                $task->task_project_id = $request->task_project_id;
            }


            if ($request->task_assigned_to) {
                $employee_array = [$request->task_assigned_to];
                foreach ($employee_array as $employee_array_data) {
                    $task->task_assigned_to = json_encode($employee_array_data);
                }
            }

            $task->task_estimated_hour = $request->task_estimated_hour;
            $task->task_assigned_by = Auth::user()->id;
            $task->task_progress = $request->task_progress;
            $task->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::where('id', $id)->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function bulkDeleteTask(Request $request)
    {
        try {
            $task = Task::where('task_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}