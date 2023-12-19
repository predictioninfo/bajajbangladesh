



    <script type="text/javascript">

        $(document).ready( function () {


            $('#region_id').on('change', function() {
               var regionID = $(this).val();
               if(regionID) {
                   $.ajax({
                       url: '/get-area/'+regionID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#area_id').empty();
                            $('#area_id').append('<option hidden value="">Choose Area</option>');
                            $.each(data, function(key, areas){
                                $('select[name="area_id"]').append('<option value="'+ areas.id +'">' + areas.area_name+ '</option>');
                            });
                        }else{
                            $('#areas').empty();
                        }
                     }
                   });
               }else{
                 $('#areas').empty();
               }
            });





            $('#area_id').on('change', function() {
               var areaID = $(this).val();
               if(areaID) {
                   $.ajax({
                       url: '/get-territory/'+areaID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#territory_id').empty();
                            $('#territory_id').append('<option hidden value="">Choose Territory</option>');
                            $.each(data, function(key, territories){
                                $('select[name="territory_id"]').append('<option value="'+ territories.id +'">' + territories.territory_name+ '</option>');
                            });
                        }else{
                            $('#territories').empty();
                        }
                     }
                   });
               }else{
                 $('#territories').empty();
               }
            });

            $('#territory_id').on('change', function() {
               var territoryID = $(this).val();
               if(territoryID) {
                   $.ajax({
                       url: '/get-town/'+territoryID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#town_id').empty();
                            $('#town_id').append('<option hidden value="">Choose Town</option>');
                            $.each(data, function(key, towns){
                                $('select[name="town_id"]').append('<option value="'+ towns.id +'">' + towns.town_name+ '</option>');
                            });
                        }else{
                            $('#towns').empty();
                        }
                     }
                   });
               }else{
                 $('#towns').empty();
               }
            });



            $('#town_id').on('change', function() {
               var dbhouseID = $(this).val();
               if(dbhouseID) {
                   $.ajax({
                       url: '/get-db-house/'+dbhouseID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#db_house_id').empty();
                            $('#db_house_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, db_houses){
                                $('select[name="db_house_id"]').append('<option value="'+ db_houses.id +'">' + db_houses.db_house_name+ '</option>');
                            });
                        }else{
                            $('#db_houses').empty();
                        }
                     }
                   });
               }else{
                 $('#db_houses').empty();
               }
            });


            $('#db_house_id').on('change', function() {
               var locationsixID = $(this).val();
               if(locationsixID) {
                   $.ajax({
                       url: '/get-location-six/'+locationsixID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_six_id').empty();
                            $('#location_six_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationsixes){
                                $('select[name="location_six_id"]').append('<option value="'+ locationsixes.id +'">' + locationsixes.location_six_location_six_name+ '</option>');
                            });
                        }else{
                            $('#locationsixes').empty();
                        }
                     }
                   });
               }else{
                 $('#locationsixes').empty();
               }
            });


            $('#location_six_id').on('change', function() {
               var locationsevenID = $(this).val();
               if(locationsevenID) {
                   $.ajax({
                       url: '/get-location-seven/'+locationsevenID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_seven_id').empty();
                            $('#location_seven_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationsevens){
                                $('select[name="location_seven_id"]').append('<option value="'+ locationsevens.id +'">' + locationsevens.location_seven_name+ '</option>');
                            });
                        }else{
                            $('#locationsevens').empty();
                        }
                     }
                   });
               }else{
                 $('#locationsevens').empty();
               }
            });

            $('#location_seven_id').on('change', function() {
               var locationeightID = $(this).val();
               if(locationeightID) {
                   $.ajax({
                       url: '/get-location-eight/'+locationeightID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_eight_id').empty();
                            $('#location_eight_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationeights){
                                $('select[name="location_eight_id"]').append('<option value="'+ locationeights.id +'">' + locationeights.location_eights_name+ '</option>');
                            });
                        }else{
                            $('#locationeights').empty();
                        }
                     }
                   });
               }else{
                 $('#locationeights').empty();
               }
            });

            $('#location_eight_id').on('change', function() {
               var locationnineID = $(this).val();
               if(locationnineID) {
                   $.ajax({
                       url: '/get-location-nine/'+locationnineID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_nine_id').empty();
                            $('#location_nine_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationnines){
                                $('select[name="location_nine_id"]').append('<option value="'+ locationnines.id +'">' + locationnines.location_nine_name+ '</option>');
                            });
                        }else{
                            $('#locationnines').empty();
                        }
                     }
                   });
               }else{
                 $('#locationnines').empty();
               }
            });

            $('#location_nine_id').on('change', function() {
               var locationtenID = $(this).val();
               if(locationtenID) {
                   $.ajax({
                       url: '/get-location-ten/'+locationtenID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_ten_id').empty();
                            $('#location_ten_id').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationtens){
                                $('select[name="location_ten_id"]').append('<option value="'+ locationtens.id +'">' + locationtens.location_ten_name+ '</option>');
                            });
                        }else{
                            $('#locationtens').empty();
                        }
                     }
                   });
               }else{
                 $('#locationtens').empty();
               }
            });



              $('#region_id_edit').on('change', function() {
                 var regionID = $(this).val();
                 if(regionID) {
                     $.ajax({
                         url: '/get-area/'+regionID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#area_id_edit').empty();
                              $('#area_id_edit').append('<option hidden value="">Choose Area</option>');
                              $.each(data, function(key, areas){
                                  $('select[name="area_id"]').append('<option value="'+ areas.id +'">' + areas.area_name+ '</option>');
                              });
                          }else{
                              $('#areas').empty();
                          }
                       }
                     });
                 }else{
                   $('#areas').empty();
                 }
              });



              $('#area_id_edit').on('change', function() {
                 var areaID = $(this).val();
                 if(areaID) {
                     $.ajax({
                         url: '/get-territory/'+areaID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#territory_id_edit').empty();
                              $('#territory_id_edit').append('<option hidden value="">Choose Territory</option>');
                              $.each(data, function(key, territories){
                                  $('select[name="territory_id"]').append('<option value="'+ territories.id +'">' + territories.territory_name+ '</option>');
                              });
                          }else{
                              $('#territories').empty();
                          }
                       }
                     });
                 }else{
                   $('#territories').empty();
                 }
              });



              $('#territory_id_edit').on('change', function() {
                 var territoryID = $(this).val();
                 if(territoryID) {
                     $.ajax({
                         url: '/get-town/'+territoryID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#town_id_edit').empty();
                              $('#town_id_edit').append('<option hidden value="">Choose Town</option>');
                              $.each(data, function(key, towns){
                                  $('select[name="town_id"]').append('<option value="'+ towns.id +'">' + towns.town_name+ '</option>');
                              });
                          }else{
                              $('#towns').empty();
                          }
                       }
                     });
                 }else{
                   $('#towns').empty();
                 }
              });


              $('#town_id_edit').on('change', function() {
                 var dbhouseID = $(this).val();
                 if(dbhouseID) {
                     $.ajax({
                         url: '/get-db-house/'+dbhouseID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#db_house_id_edit').empty();
                              $('#db_house_id_edit').append('<option hidden value="">Choose Location</option>');
                              $.each(data, function(key, db_houses){
                                  $('select[name="db_house_id"]').append('<option value="'+ db_houses.id +'">' + db_houses.db_house_name+ '</option>');
                              });
                          }else{
                              $('#db_houses').empty();
                          }
                       }
                     });
                 }else{
                   $('#db_houses').empty();
                 }
              });

              $('#db_house_id_edit').on('change', function() {
                 var locationsixID = $(this).val();
                 if(locationsixID) {
                     $.ajax({
                         url: '/get-location-six/'+locationsixID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#location_six_id_edit').empty();
                              $('#location_six_id_edit').append('<option hidden value="">Choose Location</option>');
                              $.each(data, function(key, locationsixes){
                                  $('select[name="location_six_id"]').append('<option value="'+ locationsixes.id +'">' + locationsixes.location_six_location_six_name+ '</option>');
                              });
                          }else{
                              $('#locationsixes').empty();
                          }
                       }
                     });
                 }else{
                   $('#locationsixes').empty();
                 }
              });

              $('#location_six_id_edit').on('change', function() {
                 var locationsevenID = $(this).val();
                 if(locationsevenID) {
                     $.ajax({
                         url: '/get-location-seven/'+locationsevenID,
                         type: "GET",
                         data : {"_token":"{{ csrf_token() }}"},
                         dataType: "json",
                         success:function(data)
                         {
                           if(data){
                              $('#location_seven_id_edit').empty();
                              $('#location_seven_id_edit').append('<option hidden value="">Choose Location</option>');
                              $.each(data, function(key, locationsevens){
                                  $('select[name="location_seven_id"]').append('<option value="'+ locationsevens.id +'">' + locationsevens.location_seven_name+ '</option>');
                              });
                          }else{
                              $('#locationsevens').empty();
                          }
                       }
                     });
                 }else{
                   $('#locationsevens').empty();
                 }
              });


            $('#location_seven_id_edit').on('change', function() {
               var locationeightID = $(this).val();
               if(locationeightID) {
                   $.ajax({
                       url: '/get-location-eight/'+locationeightID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_eight_id_edit').empty();
                            $('#location_eight_id_edit').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationeights){
                                $('select[name="location_eight_id"]').append('<option value="'+ locationeights.id +'">' + locationeights.location_eights_name+ '</option>');
                            });
                        }else{
                            $('#locationeights').empty();
                        }
                     }
                   });
               }else{
                 $('#locationeights').empty();
               }
            });

            $('#location_eight_id_edit').on('change', function() {
               var locationnineID = $(this).val();
               if(locationnineID) {
                   $.ajax({
                       url: '/get-location-nine/'+locationnineID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_nine_id_edit').empty();
                            $('#location_nine_id_edit').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationnines){
                                $('select[name="location_nine_id"]').append('<option value="'+ locationnines.id +'">' + locationnines.location_nine_name+ '</option>');
                            });
                        }else{
                            $('#locationnines').empty();
                        }
                     }
                   });
               }else{
                 $('#locationnines').empty();
               }
            });


            $('#location_nine_id_edit').on('change', function() {
               var locationtenID = $(this).val();
               if(locationtenID) {
                   $.ajax({
                       url: '/get-location-ten/'+locationtenID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#location_ten_id_edit').empty();
                            $('#location_ten_id_edit').append('<option hidden value="">Choose Location</option>');
                            $.each(data, function(key, locationtens){
                                $('select[name="location_ten_id"]').append('<option value="'+ locationtens.id +'">' + locationtens.location_ten_name+ '</option>');
                            });
                        }else{
                            $('#locationtens').empty();
                        }
                     }
                   });
               }else{
                 $('#locationtens').empty();
               }
            });

     });

      </script>
