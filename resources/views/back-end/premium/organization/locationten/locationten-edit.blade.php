
@extends('back-end.premium.layout.premium-main')

@section('content')

    <section class="main-contant-section">
    <?php

    use App\Models\Company;

    ?>
        <?php
        foreach ($locations as $location){
            $location1 = $location->location1 ?? "Location1";
            $location2 = $location->location2 ?? "Location2";
            $location3 = $location->location3 ?? "Location3";
            $location4 = $location->location4 ?? "Location4";
            $location5 = $location->location5 ?? "Location5";
            $location6 = $location->location6 ?? "Location6";
            $location7 = $location->location7 ?? "Location7";
            $location8 = $location->location8 ?? "Location8";
            $location9 = $location->location9 ?? "Location9";
            $location10 = $location->location10 ?? "Location10";

        }
        ?>

        <div class=" mb-3">

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
            @foreach($locations_ten as $location_ten)
            <div class="content-box">
                <div class="card">
                 <div class="card-body">
                    <form method="post" action="{{route('update-location-tens')}}" class="form-horizontal" enctype="multipart/form-data">

                        @csrf
                        <div class="row">

                            <input type="hidden" name="id" value="{{$location_ten->id}}">


                                <div class="col-md-4 form-group">
                                    <label>{{$location1}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                    <select name="region_id" id="region_id_edit" class="form-control">
                                    <option selected>Select a Region</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" {{ $location_ten->location_ten_region_id ==  $region->id ? 'selected' : ''}}>{{$region->region_name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location2}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                    <select class="form-control" name="area_id" id="area_id_edit">
                                        <option selected> Plese Select </option>
                                        @foreach($areas as $area)
                                        <option value="{{$area->id}}" {{ $location_ten->location_ten_area_id ==  $area->id ? 'selected' : ''}}>{{$area->area_name}}</option>
                                    @endforeach
                                    </select>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location3}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                    <select class="form-control" name="territory_id" id="territory_id_edit">
                                        <option selected> Please Select </option>
                                        @foreach($territories as $territorie)
                                        <option value="{{$territorie->id}}" {{ $location_ten->location_ten_territory_id ==  $territorie->id ? 'selected' : ''}}>{{$territorie->territory_name}}</option>
                                    @endforeach
                                    </select>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location4}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                    <select class="form-control" name="town_id" id="town_id_edit">
                                        <option selected>Please Selecte</option>
                                        @foreach($towns as $town)
                                        <option value="{{$town->id}}" {{ $location_ten->location_ten_town_id ==  $town->id ? 'selected' : ''}}>{{$town->town_name}}</option>
                                    @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label>{{$location5}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                     <select class="form-control" name="db_house_id" id="db_house_id_edit" required>
                                        <option selected>Please Selecte</option>
                                        @foreach($db_houses as $db_housess)
                                        <option value="{{$db_housess->id}}" {{ $location_ten->location_ten_db_house_id ==  $db_housess->id ? 'selected' : ''}}>{{$db_housess->db_house_name}}</option>
                                    @endforeach
                                     </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>{{$location6}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                     <select class="form-control" name="location_six_id" id="location_six_id_edit" required>
                                        <option selected>Please Selecte</option>
                                        @foreach($locations_six as $location_six)
                                        <option value="{{$location_six->id}}" {{ $location_ten->location_ten_six_id ==  $location_six->id ? 'selected' : ''}}>{{$location_six->location_six_location_six_name}}</option>
                                    @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location7}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                     <select class="form-control" name="location_seven_id" id="location_seven_id_edit" required>
                                        <option selected>Please Selecte</option>
                                        @foreach($locations_seven as $location_seven)
                                        <option value="{{$location_seven->id}}" {{ $location_ten->location_ten_seven_id ==  $location_seven->id ? 'selected' : ''}}>{{$location_seven->location_seven_name}}</option>
                                    @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location8}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                     <select class="form-control" name="location_eight_id" id="location_eight_id_edit" required>
                                        <option selected>Please Selecte</option>
                                        @foreach($locations_eight as $location_eight)
                                        <option value="{{$location_eight->id}}" {{ $location_ten->location_ten_eight_id ==  $location_eight->id ? 'selected' : ''}}>{{$location_eight->location_eights_name}}</option>
                                    @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>{{$location9}}{{__(' Name')}} <span class = "text-danger">*</span></label>
                                     <select class="form-control" name="location_nine_id" id="location_nine_id_edit" required>
                                        <option selected>Please Selecte</option>
                                        @foreach($locations_nine as $location_nine)
                                        <option value="{{$location_nine->id}}" {{ $location_ten->location_ten_nine_id ==  $location_nine->id ? 'selected' : ''}}>{{$location_nine->location_nine_name}}</option>
                                    @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>{{ $location10 }}{{__(' Name')}} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="location_ten_name" value="{{ $location_ten->location_ten_name }}" required class="form-control">
                                        </div>
                                    </div>

                            <div class="col-sm-12 mt-4">

                                <input type="submit" name="action_button" class="btn btn-grad" value="{{__('Edit')}}"/>

                            </div>
                        </div>

                    </form>
                 </div>
                </div>
               </div>
@endforeach
</div>
</section>


@endsection
