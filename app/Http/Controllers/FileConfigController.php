<?php

namespace App\Http\Controllers;
use App\Models\FileConfig;
use Illuminate\Http\Request;
use Auth;

class FileConfigController extends Controller
{
    public function fileConfigAdd (Request $request)
	{
        $validated = $request->validate([
            'file_config_file_size' => 'required',
        ]);

        if($request->file_config_file_size <= 20){
            if(FileConfig::where('file_config_com_id',Auth::user()->com_id)->exists()){
                $file_configs = FileConfig::where('file_config_com_id',Auth::user()->com_id)->get('id');
                foreach($file_configs as $file_configs_value){
                    $file_config = FileConfig::find($file_configs_value->id);
                    $file_config->file_config_file_size = $request->file_config_file_size;
                    $file_config->save(); 
                }
            }else{
                $file_config = new FileConfig();
                $file_config->file_config_com_id = Auth::user()->com_id;
                $file_config->file_config_file_size = $request->file_config_file_size;
                $file_config->save();
            }
            return back()->with('message','Added Successfully'); 
        }else{
            return back()->with('message','File Config Should be Less than or Equal to 20'); 
        }
        
	}
    public function deleteFileConfig($id)
    {
        $file_config = FileConfig::where('id',$id)->delete();
        return back()->with('message','Deleted Successfully');
    }
}
