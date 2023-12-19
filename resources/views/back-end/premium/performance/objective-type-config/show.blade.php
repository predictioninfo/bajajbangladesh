@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">


   <div class="card mb-4">
    <div class="card-header with-border">
        <h1 class="card-title"> {{__('Show Objectives')}} </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('objectives-type-configs') }}"><i class="fa fa-plus"> Add </i></a></li>
                <li class="breadcrumb-item"><a href="{{route('edit-objectives-type-configs', $detailsObjective->id) }}"><i class="fa fa-edit"> Edit</i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('objectives-type-configs') }}"><i class="fa fa-list"></i> List </a></li>

                <li class="breadcrumb-item active" aria-current="page"><span>Show - Objective</span></li>
            </ol>
        </nav>
    </div>
</div>

<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
   @csrf
   <div class="">
      <div class="objective-contant">
         <div class="row">
            <div class="col-md-12">
               <div id="Objective" class="">
                  <div class="content-box">
                     <div class="select_depertment row">
                        <select class="form-control col-md-4" name="obj_config_mas_dep_id" id="obj_config_dept_id">000
                           <option>Choose a Department</option>
                           @foreach($departments as $departments_value)
                           <option value="{{ $departments_value->id }}"
                           {{ $detailsObjective->obj_config_mas_dep_id == $departments_value->id ? 'selected' : '' }}>
                           {{ $departments_value->department_name }}</option>
                           @endforeach
                        </select>
                        <select class="form-control col-md-4" name="obj_config_mas_dis_id" id="obj_config_desig_id">
                        @foreach($designations as $designations_value)
                        <option value="{{ $designations_value->id }}"
                        {{ $detailsObjective->obj_config_mas_dis_id == $designations_value->id ? 'selected' : '' }}>
                        {{ $designations_value->designation_name }}</option>
                        @endforeach
                        </select>
                     </div>

                     <table class="form-table" id="Objective_plan">
                     @foreach ($detailsObjectiveTypes as $value)
                        <tr>
                           @foreach($objective_points as $objective_point)
                           <input type="hidden"  class="form-control totalPoint" value="{{$objective_point->objective_point_config_point_number}}">
                           @endforeach
                           <td>{{$value->userobjectivetypefromobjectiveconfig->objective_type_name}}</td>
                           <input type="hidden"  name="obj_config_obj_typ_id[]" value="{{ $value->userobjectivetypefromobjectiveconfig->id }}"/>
                           <td><input type="number"  name="obj_config_percent[]" class="form-control persentage per" id="obj_config_percent" value="{{$value->obj_config_percent}}" placeholder="Percentage(%)" required /></td>
                           <td><input type="number" name="obj_config_target_point[]" id="obj_config_target_point" value="{{$value->obj_config_target_point}}" class="form-control targetPoint" placeholder="Target Point" required /></td>
                           <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i
                              class="fa fa-minus" aria-hidden="true"></i></a> </td>
                        </tr>
                        @endforeach
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
</section>
@endsection
