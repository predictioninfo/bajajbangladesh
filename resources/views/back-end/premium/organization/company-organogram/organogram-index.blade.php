@extends('back-end.premium.layout.premium-main')

@section('content')
    <style>
        /*Now the CSS*/
        * {
            margin: 0;
            padding: 0;
        }

        .tree ul {
            padding-top: 20px;
            position: relative;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        .tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 20px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without
    any siblings*/
        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child {
            padding-top: 0;
        }

        /*Remove left connector from first child and
    right connector from last child*/
        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;

            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover,
        .tree li a:hover+ul li a {
            background: #c8e4f8;
            color: #000;
            border: 1px solid #94a0b4;
        }

        /*Connector styles on hover*/
        .tree li a:hover+ul li::after,
        .tree li a:hover+ul li::before,
        .tree li a:hover+ul::before,
        .tree li a:hover+ul ul::before {
            border-color: #94a0b4;
        }
    </style>
    <?php

    use App\Models\User;

    ?>
    <section class="main-contant-section">
        <div class="container-fluid mb-3">
            <h1 class="text-center">Prediction Learning Associates</h1><br><br>

            {{-- <div class="tree">
			<ul>
				<li>
					<a href="#">MR.ABC</a>
					<ul>
						@foreach ($result_level_one as $result_level_one_value)
						<li>
						<a href="#">{{$result_level_one_value->first_name}}</a>
							<ul>
								<li>
								<a href="#">2.1</a>

								</li>
								<li>
								<a href="#">2.2</a>
								</li>
							</ul>
						</li>
						@endforeach
					</ul>
				</li>
			</ul>
        </div> --}}

            {{--	<div class="tree">
			<ul>
				<li>
					<a href="#">MR.ABC</a>


					<ul>
					<?php
     // function display_children($parent, $level) {
     // 	$count = 0;
     // 	$result = User::where('report_to_parent_id','=', $parent)->get();

     // foreach( $result as $row)
     // 	{

     // 	if($level === 0 || $level === 1){

     // 		 $var_zero = $row['id'];

     // 		if($level === 1){

     // 			$var = $row['id'];

     // 			echo '<li><ul><li>
     // 			<a href="#">'.$var.'</a></li></ul></li>';

     // 		}else{
     // 			echo '<li>
     // 		<a href="#">'.$var_zero.'</a></li>';

     // 		}

     // 	}
     // 	// if($level === 1){

     // 	// 	$var = $row['id'];

     // 	// 	echo '<li><ul><li>
     // 	// 	<a href="#">'.$var.'</a></li></ul></li>';

     // 	// }

     // 		$count += display_children($row['id'], $level+1);
     // 	}

     // 	//echo "<br>";
     // 	return $count; // it will return all user_id count under parent_id
     // }

     // display_children(5, 0);
     ?>

</ul>




				</li>
			</ul>
        </div>

		--}}


            <?php

            function display_children($parent, $level)
            {
                $count = 0;
                $result = User::where('report_to_parent_id', '=', $parent)->get();

                foreach ($result as $row) {
                    if ($level === 0) {
                        $user_names = User::where('id', '=', $row['id'])->get();

                        foreach ($user_names as $user_names_value) {
                            echo $user_names_value->first_name . ' ' . $user_names_value->last_name . '<br>';
                        }
                    } elseif ($level === 1) {
                        $user_names = User::where('id', '=', $row['id'])->get();

                        foreach ($user_names as $user_names_value) {
                            echo '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '*' . $user_names_value->first_name . ' ' . $user_names_value->last_name . '<br>';
                        }

                        //$var = $row['id']."<br>";

                        //echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;
                    } elseif ($level === 2) {
                        $user_names = User::where('id', '=', $row['id'])->get();

                        foreach ($user_names as $user_names_value) {
                            echo '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '*' . $user_names_value->first_name . ' ' . $user_names_value->last_name . '<br>';
                        }

                        // $var = $row['id']."<br>";

                        // echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;
                    } elseif ($level === 3) {
                        $user_names = User::where('id', '=', $row['id'])->get();

                        foreach ($user_names as $user_names_value) {
                            echo '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '*' . $user_names_value->first_name . ' ' . $user_names_value->last_name . '<br>';
                        }

                        // $var = $row['id']."<br>";

                        //  echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;
                    } elseif ($level === 4) {
                        $user_names = User::where('id', '=', $row['id'])->get();

                        foreach ($user_names as $user_names_value) {
                            echo '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '*' . $user_names_value->first_name . ' ' . $user_names_value->last_name . '<br>';
                        }

                        // $var = $row['id']."<br>";

                        //  echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;
                    }

                    $count += display_children($row['id'], $level + 1);
                }

                //echo "<br>";
                return $count; // it will return all user_id count under parent_id
            }

            display_children(5, 0);

            // 	function display_children($parent, $level) {
            // 		$count = 0;
            // 		$result = User::where('report_to_parent_id','=', $parent)->get();

            // 	 foreach( $result as $row)
            // 		{

            // 			if($level === 0){

            // 				$var = $row['id']."<br>";

            // 				echo $var;
            // 			}elseif($level === 1){

            // 				$var = $row['id']."<br>";

            // 				echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

            // 			}elseif($level === 2){

            // 				$var = $row['id']."<br>";

            // 				echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

            // 			}elseif($level === 3){

            // 				$var = $row['id']."<br>";

            // 				echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

            // 			}

            // 			   $count += display_children($row['id'], $level+1);

            // 		}

            // 		echo "<br>";
            // 		return $count; // it will return all user_id count under parent_id
            // 	}

            //    display_children(5, 0);

            ?>

        </div>
    </section>


    <?php

    // 	$result = User::where('report_to_parent_id','=', 5)->get();

    // 	$count = 0;
    //  foreach( $result as $row)
    // 	{

    // 		if($count === 0){

    // 			echo $var = $row['id'];

    // 		}

    // 		   $count +=  $count;

    // 	}
    ?>
@endsection
