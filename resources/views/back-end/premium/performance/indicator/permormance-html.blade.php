@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> Objective Section  </h1>
            </div>
        </div>
        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'Objective')"> Objective Plan </button>
                        <button class="tablinks" onclick="openCity(event, 'Operational')"> Operational Plan </button>
                    </div>

                    <div id="Objective" class="tabcontent">
                        <form action="">
                            <div class="select_depertment">
                                <select name="" id="">
                                    <option value=""> Depertment </option>
                                </select>
                                <select name="" id="">
                                    <option value=""> Designation </option>
                                </select>
                                <select name="" id="">
                                    <option value=""> Employee </option>
                                </select>
                            </div>
                            <table class="form-table" id="Objective_plan">
                                <tr>
                                    <th colspan="5" class="text-center" > <b> strategic objective  (70%) </b> </th>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                    Individual Objective With Timeline
                                    </th>
                                    <th>
                                    Measures Of Success
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOB btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>
                            <table class="form-table" id="Objective_plan1">
                                <tr>
                                    <th colspan="5" class="text-center" > <b> strategic objective  (70%) </b> </th>
                                </tr>
                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                    Individual Objective With Timeline
                                    </th>
                                    <th>
                                    Measures Of Success
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOB1 btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>
                            <button type="submit"  class="btn btn-grad "> save </button>
                        </form>
                    </div>

                    <div id="Operational" class="tabcontent">
                        <form action="">
                            <table class="form-table" id="Operational_plan">
                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                        Development Plan
                                    </th>
                                    <th>
                                        Measures Of Success
                                    </th>
                                    <th>
                                        Action Taken
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOP btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>
                            <table class="form-table" id="Operational_plan1">
                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                        Development Plan
                                    </th>
                                    <th>
                                        Measures Of Success
                                    </th>
                                    <th>
                                        Action Taken
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOP1 btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>
                            <button type="submit"  class="btn btn-grad"> save </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).ready(function(){
        $(".addOB").click(function(){
            $("#Objective_plan").append(`
            <tr valign="top">
                <td> 1 </td>
                <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr>
            `);
        });
        $("#Objective_plan").on('click','.remOB',function(){
            $(this).parent().parent().remove();
        });

        $(".addOB1").click(function(){
            $("#Objective_plan1").append(`
            <tr valign="top">
                <td> 1 </td>
                <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB1 btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr>
            `);
        });
        $("#Objective_plan1").on('click','.remOB1',function(){
            $(this).parent().parent().remove();
        });

        $(".addOP").click(function(){
            $("#Operational_plan").append(`
                <tr valign="top">
                    <td> 1 </td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>

                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
        });
        $("#Operational_plan").on('click','.remOP',function(){
            $(this).parent().parent().remove();
        });

        $(".addOP1").click(function(){
            $("#Operational_plan1").append(`
                <tr valign="top">
                    <td> 1 </td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>

                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP1 btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
        });
        $("#Operational_plan1").on('click','.remOP1',function(){
            $(this).parent().parent().remove();
        });
    });


</script>

@endsection
















