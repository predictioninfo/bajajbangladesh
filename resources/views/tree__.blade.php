<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<?php
use App\Models\User;
use App\Models\GradeSetup;
?>

<body>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:400");

        * {
            padding: 0;
            margin: 0;
        }

        body {
            font-size: 14px;
            font-family: Roboto;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .mgt-container {
            flex-grow: 1;
            overflow: auto;
            justify-content: center;
        }

        .basic-style {
            background-color: #efe6e2;
        }

        .mgt-item-parent p {
            font-weight: 400;
            color: #de5454;
        }

        .management-tree {
            background-color: #ffffff;
            font-family: inherit;
            padding: 40px;
        }

        .management-tree .person {
            text-align: center;
        }

        .management-tree .person img {
            max-width: 80px;
            border: 2px solid #d7d7d7;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f7f7f7;
        }

        .management-tree .person p.name {
            background-color: #f7f7f7;
            padding: 5px;
            font-size: 12px;
            font-weight: normal;
            color: #676767;
            margin: 0;
            position: relative;
        }

        .management-tree .person p.name:before {
            content: "";
            position: absolute;
            width: 2px;
            height: 5px;
            background-color: #d7d7d7;
            left: 50%;
            top: 0;
            transform: translateY(-100%);
        }

        .mgt-wrapper {
            display: flex;
        }

        .mgt-wrapper .mgt-item {
            display: flex;
            flex-direction: column;
            margin: auto;
        }

        .mgt-wrapper .mgt-item .mgt-item-parent {
            margin-bottom: 50px;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .mgt-wrapper .mgt-item .mgt-item-parent:after {
            position: absolute;
            content: "";
            width: 2px;
            height: 25px;
            bottom: 0;
            left: 50%;
            background-color: #d7d7d7;
            transform: translateY(100%);
        }

        .mgt-wrapper .mgt-item .mgt-item-children {
            display: flex;
            justify-content: center;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child {
            padding: 0 15px;
            position: relative;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:before,
        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:after {
            content: "";
            position: absolute;
            background-color: #d7d7d7;
            left: 0;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:before {
            left: 50%;
            top: 0;
            transform: translateY(-100%);
            width: 2px;
            height: 25px;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:after {
            top: -23px;
            transform: translateY(-100%);
            height: 2px;
            width: 100%;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:first-child:after {
            left: 50%;
            width: 50%;
        }

        .mgt-wrapper .mgt-item .mgt-item-children .mgt-item-child:last-child:after {
            width: calc(50% + 1px);
        }
    </style>

    <div class="container">
        <div class="horizontal">
            <div class="verticals twelve">
                <section class="management-tree">
                    <div class="mgt-container">
                        <div class="mgt-wrapper">

                            <div class="mgt-item">

                                {{-- <div class="mgt-item-parent">
                                    <div class="person">
                                        <img src="https://cdn0.iconfinder.com/data/icons/user-pictures/100/matureman1-128.png"
                                            alt="">
                                        <p class="name">Level 1 / CEO</p>
                                    </div>
                                </div> --}}

                                {{-- <div class="mgt-item-children"> --}}
                                    @foreach($grades->unique(fn($p) => $p->grade_name ?? '') as $grade)
                                    <div class="mgt-item-child">
                                        <div class="mgt-item">

                                            {{-- <div class="mgt-item-parent">
                                                <div class="person">
                                                    <img src="https://cdn0.iconfinder.com/data/icons/user-pictures/100/malecostume-128.png"
                                                        alt="">
                                                    <p class="name">Level 2 / IT Manager</p>
                                                </div>
                                            </div> --}}

                                            <div class="mgt-item-children">
                                                <?php
                                                $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->where('grade_id',$grade->id)->get();
                                            ?>
                                                @foreach($grade_setups as $grade_setup)
                                                <?php
                                                   $grade_set = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->where('under_dept_id',$grade_setup->under_dept_id)->where('under_desg_id',$grade_setup->under_desg_id)->where('under_grade_id',$grade_setup->under_grade_id)->get();
                                                 ?>

                                                {{-- @foreach($grade_set as $gr) --}}
                                                <div class="mgt-item-child" style="padding-top:-10%;">
                                                    <div class="person">
                                                        <p class="name">{{
                                                            $grade_setup->GardeSetaupDesignation->designation_name ??
                                                            null}}
                                                            <br>
                                                            {{ $grade_setup->gardeSetaupEmployee->first_name ??
                                                            null}} {{ $grade_setup->gardeSetaupEmployee->last_name ??
                                                            null}}
                                                        </p>
                                                        <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/female1-128.png"
                                                            alt="">

                                                    </div>
                                                </div>
                                                <br>
                                                {{-- @endforeach --}}
                                                @endforeach
                                                @foreach($grade_set as $gr)
                                                {{-- <div class="mgt-item-child" style="padding-top:-10%;">
                                                    <div class="person">
                                                        <p class="name">{{
                                                            $gr->GardeSetaupDesignation->designation_name ??
                                                            null}}
                                                            <br>
                                                            {{ $gr->gardeSetaupEmployee->first_name ??
                                                            null}} {{ $gr->gardeSetaupEmployee->last_name ??
                                                            null}}
                                                        </p>
                                                    </div>
                                                </div> --}}
                                                @endforeach
                                                <br>
                                                {{-- <div class="mgt-item-child">
                                                    <div class="person">
                                                        <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/boy-128.png"
                                                            alt="">
                                                        <p class="name">Level 3 / IT Developer</p>
                                                    </div>
                                                </div>

                                                <div class="mgt-item-child">
                                                    <div class="person">
                                                        <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/female1-128.png"
                                                            alt="">
                                                        <p class="name">Level 3 / IT Developer</p>
                                                    </div>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    @endforeach

                                    {{-- <div class="mgt-item-child">
                                        <div class="mgt-item"> --}}

                                            {{-- <div class="mgt-item-parent">
                                                <div class="person">
                                                    <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/female1-128.png"
                                                        alt="">
                                                    <p class="name">Level 2 / Sales Manager</p>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="mgt-item-children"> --}}

                                                {{-- <div class="mgt-item-child">
                                                    <div class="person">
                                                        <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/boy-128.png"
                                                            alt="">
                                                        <p class="name">Level 3 / Sales Exe</p>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="mgt-item-child"> --}}
                                                    {{-- <div class="mgt-item">

                                                        <div class="mgt-item-parent">
                                                            <div class="person">
                                                                <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/boy-128.png"
                                                                    alt="">
                                                                <p class="name">Level 3 / Sales Exe</p>
                                                            </div>
                                                        </div>

                                                        <div class="mgt-item-children">

                                                            <div class="mgt-item-child">
                                                                <div class="person">
                                                                    <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/supportmale-128.png"
                                                                        alt="">
                                                                    <p class="name">Level 4 / Sales Jnr.</p>
                                                                </div>
                                                            </div>

                                                            <div class="mgt-item-child">
                                                                <div class="person">
                                                                    <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/supportfemale-128.png"
                                                                        alt="">
                                                                    <p class="name">Level 4 / Sales Jnr.</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div> --}}
                                                    {{-- </div> --}}

                                                {{-- </div> --}}

                                            {{-- </div>
                                    </div> --}}

                                    {{--
                                </div> --}}

                            </div>

                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

</body>

</html>
