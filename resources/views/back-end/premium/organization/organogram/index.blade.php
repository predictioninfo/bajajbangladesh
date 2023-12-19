{{-- <!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title> Organogram</title>

    <script type='text/javascript' src="{{ asset('organogram/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('organogram/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('organogram/css/jquery.orgchart.css') }}" />
    <script src="{{ asset('organogram/js/jquery.orgchart.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script type='text/javascript'>
        $(function() {
            var members;
            $.ajax({
                type: 'GET',
                url: '/org-chart',
                dataType: 'json',
                async: false,
                success: function(data) {
                    console.log(data);
                    members = (data);

                }
            })


            //memberId,parentId,otherInfo
            for (var i = 0; i < members.length; i++) {

                var member = members[i];

                if (i == 0) {
                    $(" #mainContainer").append("<li id=" + member.memberId + "><img src='" + member.Image + "'>" +
                        "<br>" + member.otherInfo + "<br>" + member.firstName + " " + member.lastName + "</li>")
                } else {

                    if ($('#pr_' + member.parentId).length <= 0) {
                        $('#' + member.parentId).append("<ul id='pr_" + member.parentId + "'><li id=" + member
                            .memberId + "><img src='" + member.Image + "'>" + "<br>" + member.otherInfo +
                            "<br>" + member.firstName + " " + member.lastName + "</li></ul>")

                        //   $('#'+member.parentId).append("<ul id='pr_"+member.parentId+"'><li id="+member.memberId+"><img src='"+member.Image+"'>"+"<br>"+member.otherInfo+"<br>"+member.firstName+""+member.lastName+"</li> </ul>")
                    } else {
                        $('#pr_' + member.parentId).append("<li id=" + member.memberId + "><img src='" + member
                            .Image + "'>" + "<br>" + member.otherInfo + "<br>" + member.firstName + " " + member
                            .lastName + "</li>")

                        //   $('#pr_'+member.parentId).append("<li id="+member.memberId+"><img src='"+member.Image+"'>"+"<br>"+member.otherInfo+"<br>"+member.firstName+" "+member.lastName+"</li>")
                    }

                }
            }

            $("#mainContainer").orgChart({
                container: $("#main"),
                interactive: true,
                fade: true,
                speed: 'slow'
            });

        });
    </script>

    <style>
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
            height: auto;
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

        .main-content-box .user-tree-box:after {
            position: absolute;
            content: '';
            width: 4px;
            background: #444;
            height: 20px;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div style="display: none">


        <ul id="mainContainer" class="clearfix"></ul>

    </div>
    <div id="main">

    </div> --}}

{{-- <div class="single-user-priview">
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
    </div> --}}

{{-- 
</body>


</html> --}}
@extends('back-end.premium.layout.premium-main')


@section('content')
    <div style="display: none">
        <ul id="mainContainer" class="clearfix"></ul>

    </div>
    <div id="main">
    </div>
    {{-- <script type='text/javascript' src="{{ asset('organogram/js/jquery.js') }}"></script> --}}
    <link rel="stylesheet" href="{{ asset('organogram/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('organogram/css/jquery.orgchart.css') }}" />
    <script src="{{ asset('organogram/js/jquery.orgchart.js') }}"></script>
    <script type='text/javascript'>
        $(function() {
            var members;
            $.ajax({
                type: 'GET',
                url: '/org-chart',
                dataType: 'json',
                async: false,
                success: function(data) {
                    console.log(data);
                    members = (data);

                }
            })


            //memberId,parentId,otherInfo
            for (var i = 0; i < members.length; i++) {

                var member = members[i];

                if (i == 0) {
                    $(" #mainContainer").append("<li id=" + member.memberId + "><img class='organogram_image' src='" + member.Image + "'>" +
                        "<br>" + member.otherInfo + "<br>" + member.firstName + " " + member.lastName + "</li>")
                } else {

                    if ($('#pr_' + member.parentId).length <= 0) {
                        $('#' + member.parentId).append("<ul id='pr_" + member.parentId + "'><li id=" + member
                            .memberId + "><img class='organogram_image' src='" + member.Image + "'>" + "<br>" + member.otherInfo +
                            "<br>" + member.firstName + " " + member.lastName + "</li></ul>")

                        //   $('#'+member.parentId).append("<ul id='pr_"+member.parentId+"'><li id="+member.memberId+"><img src='"+member.Image+"'>"+"<br>"+member.otherInfo+"<br>"+member.firstName+""+member.lastName+"</li> </ul>")
                    } else {
                        $('#pr_' + member.parentId).append("<li id=" + member.memberId + "><img class='organogram_image' src='" + member
                            .Image + "'>" + "<br>" + member.otherInfo + "<br>" + member.firstName + " " + member
                            .lastName + "</li>")

                        //   $('#pr_'+member.parentId).append("<li id="+member.memberId+"><img src='"+member.Image+"'>"+"<br>"+member.otherInfo+"<br>"+member.firstName+" "+member.lastName+"</li>")
                    }

                }
            }

            $("#mainContainer").orgChart({
                container: $("#main"),
                interactive: true,
                fade: true,
                speed: 'slow'
            });

        });
    </script>
@endsection
