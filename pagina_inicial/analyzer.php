<?php

include ("database.php");

//---------------------------------------------------------------------------------Verificador de 60 Dias---------------------------------------------------------------------------------------

//função simples autoexplicativa pelo nome.

function get_user_complaints($userid)
{
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select ComplaintID,Time,Categoria,Validade from Complaints where IDuser = $userid";
        $q = $pdo->prepare($sql);
        $q->execute();
        $complaints = $q->fetchall(PDO::FETCH_OBJ);
	
	return $complaints;
}

function get_all_complaints()
{
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select Time,Pronto,Validade,Categoria from Complaints";
        $q = $pdo->prepare($sql);
        $q->execute();
        $complaints = $q->fetchall(PDO::FETCH_OBJ);

        return $complaints;
}


//função para determinar quais problemas já passaram do prazo de 60 dias.

function analyzer_60($array_comp)
{
	$time_now = time();
	$c = count($array_comp);
	for($i = 0 ; $i < $c ; $i++ )
	{
		$complaintid = $array_comp[$i]->ComplaintID;
		$time_ago = $array_comp[$i]->Time;
		$validade = $array_comp[$i]->Validade;
		$time_ago_plus60 = ($time_ago + (2592000*2));
		if($time_now <= $time_ago_plus60 && $validade == 0)
		{
			$pdo = Database::connect();
		        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		        $sql = "update Complaints set Validade = '1' where ComplaintID = $complaintid";
		        $q = $pdo->prepare($sql);
		        $q->execute();
		}
	}
}

//Função designada para assim que o usuário logar ser validado se ele tem alguma reclamação q ja se passou de 60dias

function verifier_60($array_comp)
{
	$c = count($array_comp);
	$bool = 0;
	for($i = 0 : $i < $c && $bool == 0 ; $i++)
	{
		$validade = $array_comp[$i]->Validade;
		if($validade == 1)
		{
		  	$bool = ($bool +1);
		}
		
	}

	return $bool;
}

//-------------------------------------------------------- Analise de Dados (Relatório Estátistico) --------------------------------------------------------------------------------------------

function ready_comp($complaintid)
{
	$time_pronto = time();
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "update Complaints set Pronto = $time_pronto where ComplaintID = $complaintid";
        $q = $pdo->prepare($sql);
        $q->execute();
}

function time_by_categ_ilu($array_all_comp)
{
	$c = count($array_comp);
	$complaints_pronto = 0;
	$time_passed = 0;
	for($i = 0 ; $i < $c ; $i++)
	{
		$time = $array_all_comp[$i]->Time;
		$time_pronto = $array_all_comp[$i]->Pronto;
		$categ = $array_all_comps[$i]->Categoria;
		for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Iluminacao'; $i++)
		{
			$complaints_pronto = ($complaints_pronto + 1);
			$time_passed = ($time_passed + ($time_pronto - $time));
		}
		
	}
	
	$average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_banhe($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
	$time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Banheiro'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_beb($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
	$time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Bebedouro'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_infra($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
        $time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Infraestrutura'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_seg($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
	$time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Seguranca'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_bar($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
	$time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Barulho'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function time_by_categ_other($array_all_comp)
{
        $c = count($array_comp);
        $complaints_pronto = 0;
	$time_passed = 0;
        for($i = 0 ; $i < $c ; $i++)
        {
                $time = $array_all_comp[$i]->Time;
                $time_pronto = $array_all_comp[$i]->Pronto;
                $categ = $array_all_comps[$i]->Categoria;
                for($i = 0 ; $i < $c && $time_pronto != 0 && $categ == 'Outro'; $i++)
                {
                        $complaints_pronto = ($complaints_pronto + 1);
                        $time_passed = ($time_passed + ($time_pronto - $time));
                }
                
        }
        
        $average = (($time_passed/$complaints_pronto)/86400);
}

function array_result_categ($array_all_comp)
{
	$r = array(time_by_categ_ilu($array_all_comp),time_by_categ_banhe($array_all_comp),time_by_categ_beb($array_all_comp),time_by_categ_infra($array_all_comp),time_by_categ_seg($array_all_comp),time_by_categ_bar($array_all_comp),time_by_categ_other($array_all_comp));
	
	return $r;
}

//echo(var_dump(get_user_complaints(3)));





















?>
