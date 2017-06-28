<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include ("database.php");

function get_by_categ_m()
{
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = "select latitude,longitude,localID,descricao from Localidades where categoria = 'Banheiro M' and keypoint = 1";
	$q = $pdo->prepare($sql);
	$q->execute();
	$value = $q->fetchall(PDO::FETCH_OBJ);	
	//var_dump($value[0]->latitude);
	return $value;		
}

function get_by_categ_f()
{
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select latitude,longitude,localID,descricao from Localidades where categoria = 'Banheiro F' and keypoint = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $value = $q->fetchall(PDO::FETCH_OBJ);
	//var_dump($value);
	return $value;
}

function get_by_bebedouro()
{
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select latitude,longitude,localID,descricao from Localidades where categoria = 'Bebedouro' and keypoint = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $value = $q->fetchall(PDO::FETCH_OBJ);
        //var_dump($value);
        return $value;
}


function which_categ($categ,$radius)
{
	if($categ == 'Banheiro M')
	{
		$a = result1($radius);
	}
	elseif($categ == 'Banheiro F')
	{
		$a = result2($radius);
	}
	elseif($categ == 'Bebedouro') 
	{
		$a = result3($radius);
	}

	return $a;
}

function calculate_dist_m()
{
	$lat_fixed= -15.762851; //Reitoria
	$long_fixed= -47.867131;
	$a = get_by_categ_m();
	$c = count($a);
	for($i = 0; $i < $c ; $i++)
	{
		$b = $a[$i]->longitude;
		$d = $a[$i]->latitude;
		$dist = dist_calculate($d,$b,$lat_fixed,$long_fixed);
		$a[$i]->dist = $dist;
	}
	
	return $a;
}

function calculate_dist_f()
{
        $lat_fixed= -15.762851; //Reitoria.
        $long_fixed= -47.867131;
        $a = get_by_categ_f();
        $c = count($a);
        for($i = 0 ; $i < $c ; $i++)
        {
                $b = $a[$i]->longitude;
                $d = $a[$i]->latitude;
                $dist = dist_calculate($d,$b,$lat_fixed,$long_fixed);
                $a[$i]->dist = $dist;
        }

        return $a;
}

function calculate_dist_bebedouro()
{
        $lat_fixed= -15.762851; //Reitoria.
        $long_fixed= -47.867131;
	//$lat_fixed = -15.763463;
	//$long_fixed = -47.872672;
        $a = get_by_bebedouro();
	//echo var_dump($a);
        $c = count($a);
        for($i = 0; $i < $c ; $i++)
        {
                $b = $a[$i]->longitude;
                $d = $a[$i]->latitude;
                $dist = dist_calculate($d,$b,$lat_fixed,$long_fixed);
                $a[$i]->dist = $dist;
        }

        return $a;
}



function dist_calculate($lat_key,$long_key,$lat_fixed,$long_fixed)
{
	$theta = $long_key - $long_fixed;
  	$dist = sin(deg2rad($lat_key)) * sin(deg2rad($lat_fixed)) +  cos(deg2rad($lat_key)) * cos(deg2rad($lat_fixed)) * cos(deg2rad($theta));
  	$dist = acos($dist);
  	$dist = rad2deg($dist);
  	$miles = $dist * 60 * 1.1515;
	$miles_1 = $miles*1000;
  	$new_miles_2 = ($miles_1*0.6994424508)+$miles_1;
	return ($new_miles_2);
}

function select_by_radius($radius,$array)
{
	$c = count($array);
	$v = array();	
	for($i = 0; $i < $c ; $i++)
	{
		$b = $array[$i]->dist;
		if($b <= $radius)
		  array_push($v,$array[$i]);
	}
	
	return $v;	
}

function associate_complaints($array)
{ 
	$a = $array;
	$c = count($array);
	for($i= 0; $i<$c ;$i++)
	{
		$d = $array[$i]->localID;
		$pdo = Database::connect();
        	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$sql = "select count(ComplaintID) as Complaints from Complaints where LocalID = $d";
        	$q = $pdo->prepare($sql);
        	$q->execute();
        	$value = $q->fetch(PDO::FETCH_ASSOC);
		$a[$i]->complaints = $value['Complaints'];
		
	}
	
	return $a;
	
}


	
function grade_location($array)
{
	$a = $array;
	$c = count($array);
	for($i = 0 ; $i < $c ;$i++)
	{
		$dist = $a[$i]->dist;
 		$complaint = $a[$i]->complaints;
	 	$grade = ((2*$dist) + (3*$complaint*100))/5;
		$a[$i]->nota = $grade;
	}
	
	
	return $a;
}

function select_the_best($array)
{
	$c = count($array);
	$d = 0;
	$best_ID = 0;
	for($i=0 ; $i < $c ; $i++)
	{
		$nota = $array[$i]->nota;
		if($d == 0)
		{
			$d = $nota;
		}
		elseif($d != 0 && $nota < $d)
		{
		        $d = $nota;
			$best_ID = $array[$i]->localID;		
		}
	}
	
	return $best_ID;
}

function funcao_larissa($id,$array)
{
	$a = $array;
	$c = count($array);
	for($i = 0 ; $i < $c ; $i++)
	{
		$array_id = $a[$i]->localID;
		if($id == $array_id)
		{
			$a[$i]->best = 1;
		}
		elseif($id != $array_id)
		{
			$a[$i]->best = 0;
		}
	}
	
	return $a;
}

function result1($radius)
{
	$a = funcao_larissa(select_the_best(grade_location(associate_complaints(select_by_radius($radius,calculate_dist_m())))),grade_location(associate_complaints(select_by_radius($radius,calculate_dist_m()))));
	return $a;
}

function result2($radius)
{
	$a = funcao_larissa(select_the_best(grade_location(associate_complaints(select_by_radius($radius,calculate_dist_f())))),grade_location(associate_complaints(select_by_radius($radius,calculate_dist_f()))));
	return $a;
}

function result3($radius)
{
	$a = funcao_larissa(select_the_best(grade_location(associate_complaints(select_by_radius($radius,calculate_dist_bebedouro())))),grade_location(associate_complaints(select_by_radius($radius,calculate_dist_bebedouro()))));
	return $a;
}

//var_dump(select_the_best(grade_location(associate_complaints(select_by_radius(500,calculate_dist_m())))));
//var_dump(select_the_best(grade_location(associate_complaints(select_by_radius(500,calculate_dist_bebedouro())))));
//var_dump(select_the_best(grade_location(associate_complaints(select_by_radius(500,calculate_dist_f())))));
//var_dump(grade_location(associate_complaints(select_by_radius(500,calculate_dist_f()))));)


//var_dump(result1(500));
//var_dump(which_categ('Banheiro M',500));
//var_dump(which_categ('Banheiro F',500));
//var_dump(which_categ('Bebedouro',500));
//var_dump(calculate_dist_f());
//var_dump(dist_calculate(-15.763463,-47.872682,-15.763226,-47872365,6371000));
//var_dump(get_by_bebedouro());
//var_dump(select_by_radius(100,calculate_dist_bebedouro()));
//var_dump(which_categ('Banheiro M'));
//var_dump(calculate_dist_bebedouro()));
//var_dump(select_the_best(grade_location(associate_complaints(calculate_dist_m()))));
//var_dump(funcao_larissa(select_the_best(grade_location(associate_complaints(calculate_dist_m()))),grade_location(associate_complaints(calculate_dist_m()))));
//var_dump(select_the_best(grade_location(associate_complaints(calculate_dist_m()))));
//var_dump(associate_complaints(calculate_dist_m()));
//$a = get_by_categ_m();
//echo "<br /><br />";

//echo $a[0]->longitude;
//$a[0]->minharola = "Não tao grande mas funcional";
//echo "<br /><br />";

//echo count($a);

//$b = count($a);
//var_dump($b);

?>
