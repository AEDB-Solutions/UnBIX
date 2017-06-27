<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include ("database.php");

function get_by_categ_m()
{
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = "select latitude,longitude from Localidades where categoria = 'Banheiro M'";
	$q = $pdo->prepare($sql);
	$q->execute();
	$value = $q->fetchall(PDO::FETCH_OBJ);	
	//var_dump($value);
	return $value;		
}

function get_by_categ_f()
{
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select latitude,longitude from Localidades where categoria = 'Banheiro F'";
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
        $sql = "select latitude,longitude from Localidades where categoria = 'Bebedouro'";
        $q = $pdo->prepare($sql);
        $q->execute();
        $value = $q->fetchall(PDO::FETCH_OBJ);
        //var_dump($value);
        return $value;
}


function which_categ($categ)
{
	if($categ == 'Banheiro M')
	{
		$a = get_by_categ_m();
	}
	elseif($categ == 'Banheiro F')
	{
		$a = get_by_categ_f();
	}
	elseif($categ == 'Bebedouro') 
	{
		$a = get_by_bebedouro();
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
		$b = $a[i]->longitude;
		$c = $a[i]->latitude;
		$dist = dist_calculate($b,$c,$lat_fixed,$long_fixed);
		$a[i]->dist = $dist;
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
                $b = $a[i]->longitude;
                $c = $a[i]->latitude;
                $dist = dist_calculate($b,$c,$lat_fixed,$long_fixed);
                $a[i]->dist = $dist;
        }

        return $a;
}

function calculate_dist_bebedouro()
{
        $lat_fixed= -15.762851; //Reitoria.
        $long_fixed= -47.867131;
        $a = get_by_bebedouro();
        $c = count($a);
        for($i = 0; $i < $c ; $i++)
        {
                $b = $a[i]->longitude;
                $c = $a[i]->latitude;
                $dist = dist_calculate($b,$c,$lat_fixed,$long_fixed);
                $a[i]->dist = $dist;
        }

        return $a;
}

function dist_calculate($lat_key,$long_key,$lat_fixed,$long_fixed)
{
	$r = sqrt(($lat_key-$lat_fixed)*($lat_key-$lat_fixed) + ($long_key - $long_fixed)*($long_key - $long_fixed));
	return $r;
}

function select_by_radius($radius,$array)
{
	$c = count($array);
	$v = array();	
	for($i = 0; $i < $c ; $i++)
	{
		$b = $array[i]->dist;
		if($b <= $radius)
		  array_push($v,$array[i]);
	}
	
	return $v;	
}



//$a = get_by_categ_m();
//echo "<br /><br />";

//echo $a[0]->longitude;
//$a[0]->minharola = "Não tao grande mas funcional";
//echo "<br /><br />";

//echo count($a);

//$b = count($a);
//var_dump($b);

?>
