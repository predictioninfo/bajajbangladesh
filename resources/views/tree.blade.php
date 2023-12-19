@extends('back-end.premium.layout.premium-main')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
use App\Models\User;
use App\Models\GradeSetup;
?>

<section>

    <div class="container-fluid">

        <br><br><br><br><br><br><br><br><br><br>


        @foreach ($users as $user)
        <hr>
        <div>

            <h1 style="color: red;">employee {{ $user->first_name }}</h1><br>
        </div>

        <?php
            $sup_1st =User::where('com_id',Auth::user()->com_id)->where('id', $user->report_to_parent_id)->get(['report_to_parent_id','first_name']);
        ?>

        @foreach ($sup_1st as $sup)
        <div>

            <h1 style="color: green;"> 1st {{ $sup->first_name }} {{ $sup->last_name }}</h1>
        </div>

        <?php
        $sup_2nd =User::where('com_id',Auth::user()->com_id)->where('id', $sup->report_to_parent_id)->get(['report_to_parent_id','first_name']);
        ?>
        @foreach ($sup_2nd as $sec)
        <div>
            <h1 style="color: green;"> 2nd {{ $sec->first_name }} {{ $sec->last_name }}</h1>
        </div>

        <?php
            $sup_3rd =User::where('com_id',Auth::user()->com_id)->where('id', $sec->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                ?>
        @foreach ($sup_3rd as $third)
        <div>
            <h1 style="color: green;"> 3rd {{ $third->first_name }} {{ $third->last_name }}</h1>
        </div>

        <?php
        $sup_4th =User::where('com_id',Auth::user()->com_id)->where('id', $third->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                ?>
        @foreach ($sup_4th as $four)
        <div>
            <h1 style="color: green;"> 4th {{ $four->first_name }} {{ $four->last_name }}</h1>
        </div>

        <?php
        $sup_5th =User::where('com_id',Auth::user()->com_id)->where('id', $four->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                                ?>
        @foreach ($sup_5th as $five)
        <div>
            <h1 style="color: green;"> 5th {{ $five->first_name }} {{ $five->last_name }}</h1>
        </div>

        <?php
         $sup_6th =User::where('com_id',Auth::user()->com_id)->where('id', $five->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                                                ?>
        @foreach ($sup_6th as $six)
        <div>
            <h1 style="color: green;"> 6th {{ $six->first_name }} {{ $six->last_name }}</h1>
        </div>

        <?php
        $sup_7th =User::where('com_id',Auth::user()->com_id)->where('id', $six->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                                                                ?>
        @foreach ($sup_7th as $sev)
        <div>
            <h1 style="color: green;"> 7th {{ $sev->first_name }} {{ $sev->last_name }}</h1>
        </div>
        <?php
        $sup_8th =User::where('com_id',Auth::user()->com_id)->where('id', $sev->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                                                                                ?>
        @foreach ($sup_8th as $eight)
        <div>
            <h1 style="color: green;"> 8th {{ $eight->first_name }} {{ $eight->last_name }}</h1>
        </div>
        <?php
        $sup_9th =User::where('com_id',Auth::user()->com_id)->where('id', $eight->report_to_parent_id)->get(['report_to_parent_id','first_name']);
                                                                                                                ?>
        @foreach ($sup_9th as $nine)
        <div>
            <h1 style="color: green;"> 9th {{ $nine->first_name }} {{ $nine->last_name }}</h1>
        </div>
        <?php
            $sup_10th =User::where('com_id',Auth::user()->com_id)->where('id', $nine->report_to_parent_id)->get(['report_to_parent_id','first_name']);                                                                                                                                ?>
        @foreach ($sup_10th as $ten)
        <div>
            <h1 style="color: green;"> 10th {{ $ten->first_name }} {{ $ten->last_name }}</h1>
        </div>
        <hr>
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach
        @endforeach


    </div>
</section>

<style>
    /* RESET STYLES & HELPER CLASSES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    :root {
        --level-1: #8dccad;
        --level-2: #f5cc7f;
        --level-3: #7b9fe0;
        --level-4: #f27c8d;
        --black: black;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    ol {
        list-style: none;
    }

    body {
        margin: 50px 0 100px;
        text-align: center;
        font-family: "Inter", sans-serif;
    }

    .container {
        max-width: 1000px;
        padding: 0 10px;
        margin: 0 auto;
    }

    .rectangle {
        position: relative;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }


    /* LEVEL-1 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .level-1 {
        width: 50%;
        margin: 0 auto 40px;
        background: var(--level-1);
    }

    .level-1::before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: var(--black);
    }


    /* LEVEL-2 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .level-2-wrapper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .level-2-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 25%;
        width: 50%;
        height: 2px;
        background: var(--black);
    }

    .level-2-wrapper::after {
        display: none;
        content: "";
        position: absolute;
        left: -20px;
        bottom: -20px;
        width: calc(100% + 20px);
        height: 2px;
        background: var(--black);
    }

    .level-2-wrapper li {
        position: relative;
    }

    .level-2-wrapper>li::before {
        content: "";
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: var(--black);
    }

    .level-2 {
        width: 70%;
        margin: 0 auto 40px;
        background: var(--level-2);
    }

    .level-2::before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: var(--black);
    }

    .level-2::after {
        display: none;
        content: "";
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-100%, -50%);
        width: 20px;
        height: 2px;
        background: var(--black);
    }


    /* LEVEL-3 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .level-3-wrapper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-column-gap: 20px;
        width: 90%;
        margin: 0 auto;
    }

    .level-3-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: calc(25% - 5px);
        width: calc(50% + 10px);
        height: 2px;
        background: var(--black);
    }

    .level-3-wrapper>li::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -100%);
        width: 2px;
        height: 20px;
        background: var(--black);
    }

    .level-3 {
        margin-bottom: 20px;
        background: var(--level-3);
    }


    /* LEVEL-4 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .level-4-wrapper {
        position: relative;
        width: 80%;
        margin-left: auto;
    }

    .level-4-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: -20px;
        width: 2px;
        height: calc(100% + 20px);
        background: var(--black);
    }

    .level-4-wrapper li+li {
        margin-top: 20px;
    }

    .level-4 {
        font-weight: normal;
        background: var(--level-4);
    }

    .level-4::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-100%, -50%);
        width: 20px;
        height: 2px;
        background: var(--black);
    }


    /* MQ STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    @media screen and (max-width: 700px) {
        .rectangle {
            padding: 20px 10px;
        }

        .level-1,
        .level-2 {
            width: 100%;
        }

        .level-1 {
            margin-bottom: 20px;
        }

        .level-1::before,
        .level-2-wrapper>li::before {
            display: none;
        }

        .level-2-wrapper,
        .level-2-wrapper::after,
        .level-2::after {
            display: block;
        }

        .level-2-wrapper {
            width: 90%;
            margin-left: 10%;
        }

        .level-2-wrapper::before {
            left: -20px;
            width: 2px;
            height: calc(100% + 40px);
        }

        .level-2-wrapper>li:not(:first-child) {
            margin-top: 50px;
        }
    }


    /* FOOTER
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .page-footer {
        position: fixed;
        right: 0;
        bottom: 20px;
        display: flex;
        align-items: center;
        padding: 5px;
    }

    .page-footer a {
        margin-left: 4px;
    }
</style>





<div class="container">

    <h1 class="level-1 rectangle">CEO</h1>
    <ol class="level-2-wrapper">
        <li>
            <h2 class="level-2 rectangle">Director A</h2>
            <ol class="level-3-wrapper">
                <li>
                    <h3 class="level-3 rectangle">Manager A</h3>
                    <ol class="level-4-wrapper">
                        <li>
                            <h4 class="level-4 rectangle">Person A</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person B</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person C</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person D</h4>
                        </li>
                    </ol>
                </li>
                <li>
                    <h3 class="level-3 rectangle">Manager B</h3>
                    <ol class="level-4-wrapper">
                        <li>
                            <h4 class="level-4 rectangle">Person A</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person B</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person C</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person D</h4>
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>
            <h2 class="level-2 rectangle">Director B</h2>
            <ol class="level-3-wrapper">
                <li>
                    <h3 class="level-3 rectangle">Manager C</h3>
                    <ol class="level-4-wrapper">
                        <li>
                            <h4 class="level-4 rectangle">Person A</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person B</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person C</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person D</h4>
                        </li>
                    </ol>
                </li>
                <li>
                    <h3 class="level-3 rectangle">Manager D</h3>
                    <ol class="level-4-wrapper">
                        <li>
                            <h4 class="level-4 rectangle">Person A</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person B</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person C</h4>
                        </li>
                        <li>
                            <h4 class="level-4 rectangle">Person D</h4>
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
    </ol>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="col col-md-12">
        @foreach($grades->unique(fn($p) => $p->grade_name ?? '') as $grade)
        <?php
          $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->where('grade_id',$grade->id)->get();
        ?>
        {{-- {{ $grade->grade_name ?? null }} <br> --}} <br>
        @foreach($grade_setups as $grade_setup)
        <div style="display:inline-block; color:#1de296" class="rectangle"
            style=" position: relative;display: grid;grid-template-columns: repeat({{ $grade->grade_sort_order }});">
            <div class="btn">
                {{ $grade_setup->GardeSetaupDesignation->designation_name ??
                null}} <br>
                {{ $grade_setup->gardeSetaupEmployee->first_name ??
                null}} {{ $grade_setup->gardeSetaupEmployee->last_name ??
                null}}
            </div>
        </div>
        @endforeach
        <br>
        @endforeach
    </div>
</div>
@endsection
