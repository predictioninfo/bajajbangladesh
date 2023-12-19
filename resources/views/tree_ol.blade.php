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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }

        .main-content-box {
            width: 100%;
            display: flex;
            height: 100%;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 15px 0;
        }

        .main-content-box .user-profile-content {
            display: flex;
            align-items: center;
            justify-content: start;
            flex-direction: row;
            gap: 5px;
            width: 100%;
        }

        .main-content-box .user-tree-box {
            background: #f1f1f1;
            padding: 10px;
            min-width: 200px;
            border-radius: 3px;
            box-shadow: rgb(209 209 209 / 20%) 0px 7px 29px 0px;
        }

        .main-content-box .user-designation h4 {
            margin-top: 0;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .main-content-box .user-profile-content img {
            width: 50px;
        }

        .main-content-box .user-tree-box .user-count-btn {
            text-align: right;
        }

        .main-content-box .user-tree-box .user-count-btn button {
            border: 1px solid #bbb;
            padding: 2px 6px;
            font-size: 10px;
            border-radius: 1px;
        }

        .single-user-priview {
            background: #fff;
            padding: 15px;
            max-width: 350px;
            border-radius: 5px;
            position: absolute;
            top: 2%;
            right: 0;
            box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
        }

        .single-user-priview .user-img img {
            width: 200px;
            margin: 0 auto;
            border-radius: 5px;
        }

        .single-user-priview .user-img {
            text-align: center;
        }

        .single-user-priview article h4 {
            font-size: 20px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 5px;
        }

        .single-user-priview article h5 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 13px;
        }

        .single-user-priview article p {
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 600;
            margin: 5px 0;
        }

        .user-contact .contant-title h4 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 13px;
        }

        .user-contact p {
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 600;
            margin: 5px 0;
        }

        .user-about .about-title h4 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 13px;
        }

        .user-about p {
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 600;
            margin: 5px 0;
        }

        .user-skill .skill-title h4 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 13px;
        }

        .user-interest .interest-title h4 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 700;
            margin: 0;
            margin-bottom: 13px;
        }

        .user-skill span {
            border: 1px solid #555;
            margin: 0 3px;
            border-radius: 25px;
            padding: 3px 5px;
            font-size: 15px;
            color: #666;
        }

        .user-interest span {
            border: 1px solid #555;
            margin: 0 3px;
            border-radius: 25px;
            padding: 3px 5px;
            font-size: 15px;
            color: #666;
        }

        .single-user-priview .user-basic-info article {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .user-skill {
            margin-top: 15px;
        }

        .user-interest {
            margin-top: 15px;
        }

        #main-content-box .user-tree-box {
            display: block;
            max-width: 250px;
            margin: 0 auto;
        }

        .single-user-priview {
            display: none;
        }

        .user-tree-box {
            display: none;
        }

        .main-content-box.new-class .user-tree-box {
            display: block;
        }

        .single-user-priview.active {
            display: block;
        }
    </style>
    <?php
    use App\Models\User;
    use App\Models\GradeSetup;
    ?>
    <div class="conatiner">
        <div class="row">
            <div class="col col-md-12">
                @foreach($grades->unique(fn($p) => $p->grade_name ?? '') as $grade)
                <?php
            $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->where('grade_id',$grade->id)->get();
            // $grade_setups = GradeSetup::groupBy('grade_sort_order');
        ?>
                {{-- {{ $grade->grade_name ?? null }} <br> --}}
                @foreach($grade_setups as $grade_setup)
                <div style="display:inline-block; color:#1de296" class="user-designation btn btn-primary">
                    {{-- <div class="btn user-designation"> --}}
                        {{ $grade_setup->GardeSetaupDesignation->designation_name ??
                        null}}
                        {{-- </div> --}}
                </div>

                @endforeach
                <br>
                @endforeach
            </div>
        </div>
    </div>



    {{-- @foreach($grades->unique(fn($p) => $p->grade_name ?? '') as $grade) --}}
    <?php
                    // $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->where('grade_id',$grade->id)->get();
                    // $grade_setups = GradeSetup::groupBy('grade_sort_order');
                ?>
    {{-- @foreach($grade_setups as $grade_setup) --}}
    <div class="main-content-box" id="main-content-box">
        <div class="user-tree-box">
            <div class="user-designation">
                {{-- <h4> {{ $grade_setup->GardeSetaupDesignation->designation_name ??
                    null}}
                </h4> --}}
            </div>
            <div class="user-profile-content">
                <div class="user-img">
                    <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
                </div>
                <div class="user-name">
                    <h5> Nahid Hassan </h5>
                </div>
            </div>
            <div class="user-count-btn">
                <button type="button" class="user-count-btn"> 4 <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    {{-- @endforeach
    @endforeach --}}
    <div class="main-content-box">
        <div class="user-tree-box">
            <div class="user-designation">
                <h4> co founder </h4>
            </div>
            <div class="user-profile-content">
                <div class="user-img">
                    <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
                </div>
                <div class="user-name">
                    <h5> Nahid Hassan </h5>
                </div>
            </div>
            <div class="user-count-btn">
                <button type="button" class="user-count-btn"> 4 <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="user-tree-box">
            <div class="user-designation">
                <h4> co founder </h4>
            </div>
            <div class="user-profile-content">
                <div class="user-img">
                    <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
                </div>
                <div class="user-name">
                    <h5> Nahid Hassan </h5>
                </div>
            </div>
            <div class="user-count-btn">
                <button type="button" class="user-count-btn"> 4 <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="user-tree-box">
            <div class="user-designation">
                <h4> co founder </h4>
            </div>
            <div class="user-profile-content">
                <div class="user-img">
                    <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
                </div>
                <div class="user-name">
                    <h5> Nahid Hassan </h5>
                </div>
            </div>
            <div class="user-count-btn">
                <button type="button" class="user-count-btn"> 4 <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="user-tree-box">
            <div class="user-designation">
                <h4> co founder </h4>
            </div>
            <div class="user-profile-content">
                <div class="user-img">
                    <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
                </div>
                <div class="user-name">
                    <h5> Nahid Hassan </h5>
                </div>
            </div>
            <div class="user-count-btn">
                <button type="button" class="user-count-btn"> 4 <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="single-user-priview">
        <div class="user-basic-info">
            <div class="user-img">
                <img src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg" alt="">
            </div>
            <article>
                <h4> Guillermo Tucker </h4>
                <h5> CoFounder </h5>
                <p> Austin </p>
                <p> Started on January 2, 2019 </p>
            </article>
        </div>
        <div class="user-contact">
            <div class="contant-title">
                <h4> contact </h4>
            </div>
            <p> <b> Email: </b> nahidhassan@gmail.com </p>
            <p> <b> Office phone: </b> 01725229295 </p>
        </div>
        <div class="user-about">
            <div class="about-title">
                <h4> About </h4>
            </div>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum </p>
        </div>
        <div class="user-skill">
            <div class="skill-title">
                <h4> Skills </h4>
            </div>
            <span> Resourcefulness </span> <span> Communication </span> <span> Focus </span>
        </div>
        <div class="user-interest">
            <div class="interest-title">
                <h4> Interests </h4>
            </div>
            <span> Cake </span> <span> Deals </span> <span> Cakes </span>
        </div>
    </div>


    <script>
        let profileBtn = document.getElementsByClassName("user-count-btn");
        let profileContent = document.getElementsByClassName("main-content-box");
        let userProfileContent = document.getElementsByClassName("user-profile-content");
        let singleUserPriview = document.querySelector(".single-user-priview");

        for(let singleBtn of profileBtn) {
            singleBtn.addEventListener("click", function() {
                showFunction()
            });
        }

        for(let userProfile of userProfileContent) {
            userProfile.addEventListener("click", function() {
                singleUserPriview.classList.add("active")
            });
        }

        function showFunction () {
            for(let singleProfile of profileContent) {
                singleProfile.classList.add("new-class");
            }
        }

    </script>
</body>

</html>
