<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Auth;

class ProjectController extends Controller
{
    public function employeeSetupProjectStore(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|min:3',
            'assign_to' => 'required',
            'project_start_date' => 'required',
            'project_end_date' => 'required',
            'progress_progress' => 'required',
            'project_priority' => 'required',
            'project_client_name' => 'required',
        ]);
        try {
            $employee_array = [$request->assign_to];

            foreach ($employee_array as $employee_array_data) {

                $project = new Project();
                $project->project_com_id = Auth::user()->com_id;
                $project->assign_to = json_encode($employee_array_data);
                $project->project_name = $request->project_name;
                $project->project_priority = $request->project_priority;
                $project->project_client_name = $request->project_client_name;
                $project->project_start_date = $request->project_start_date;
                $project->project_end_date = $request->project_end_date;
                $project->progress_progress = $request->progress_progress;
                $project->save();
            }
            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeSetupProjectById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeProjectByIds = Project::where($where)->first();

        return response()->json($employeeProjectByIds);
    }

    public function updateEmployeeSetupProject(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|min:3',
            'project_start_date' => 'required',
            'project_end_date' => 'required',
            'progress_progress' => 'required',
            'project_priority' => 'required',
            'project_client_name' => 'required',
        ]);
        try {
            $employee_array = [$request->assign_to];
            foreach ($employee_array as $employee_array_data) {
                $project = Project::find($request->id);
                $project->project_name = $request->project_name;
                $project->assign_to = json_encode($employee_array_data);
                $project->project_priority = $request->project_priority;
                $project->project_client_name = $request->project_client_name;
                $project->project_start_date = $request->project_start_date;
                $project->project_end_date = $request->project_end_date;
                $project->progress_progress = $request->progress_progress;
                $project->save();
            }
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeSetupProject($id)
    {
        $project = Project::where('id', $id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }


    public function projectStore(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|min:4',
            'assign_to' => 'required',
            'project_start_date' => 'required',
            'project_end_date' => 'required',
            'progress_progress' => 'required',
            'project_priority' => 'required',
            'project_client_name' => 'required',
        ]);
        try {
            $employee_array = [$request->assign_to];

            foreach ($employee_array as $employee_array_data) {

                $project = new Project();
                $project->project_com_id = Auth::user()->com_id;
                $project->assign_to = json_encode($employee_array_data);
                $project->project_name = $request->project_name;
                $project->project_priority = $request->project_priority;
                $project->project_client_name = $request->project_client_name;
                $project->project_start_date = $request->project_start_date;
                $project->project_end_date = $request->project_end_date;
                $project->progress_progress = $request->progress_progress;
                $project->save();
            }
            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function projectById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeProjectByIds = Project::where($where)->first();

        return response()->json($employeeProjectByIds);
    }

    public function updateProject(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|min:4',
            'project_start_date' => 'required',
            'project_end_date' => 'required',
            'progress_progress' => 'required',
            'project_priority' => 'required',
            'project_client_name' => 'required',
        ]);
        try {
            $project = Project::find($request->id);
            $project->project_name = $request->project_name;
            $project->project_priority = $request->project_priority;
            $project->project_client_name = $request->project_client_name;
            $project->project_start_date = $request->project_start_date;
            $project->project_end_date = $request->project_end_date;
            $project->progress_progress = $request->progress_progress;
            $project->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteProject($id)
    {
        try {
            $project = Project::where('id', $id)->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function bulkDeleteProject(Request $request)
    {
        try {
            $project = Project::where('project_com_id', $request->bulk_delete_com_id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}