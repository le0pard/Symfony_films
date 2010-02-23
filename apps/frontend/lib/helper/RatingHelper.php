<?php

function rating_smile_for_film($rating){
	if ($rating){
		$img_b = '<img class="vote_smile" ';
		$img_e = ' />';
		$img = "";
		if ($rating >= 0 && $rating < 2){
			$img = 'src="/images/coocoo_smiles/crap.png" alt="Очень плохо" title="Очень плохо ('.$rating.')"';
		} elseif ($rating >= 2 && $rating < 4){
			$img = 'src="/images/coocoo_smiles/bad.png" alt="Плохо" title="Плохо ('.$rating.')"';
		} elseif ($rating >= 4 && $rating < 6){
			$img = 'src="/images/coocoo_smiles/normal.png" alt="Нормально" title="Нормально ('.$rating.')"';
		} elseif ($rating >= 6 && $rating < 8){
			$img = 'src="/images/coocoo_smiles/good.png" alt="Круто" title="Круто ('.$rating.')"';
		} elseif ($rating >= 8 && $rating < 10){
			$img = 'src="/images/coocoo_smiles/awesome.png" alt="Очень круто" title="Очень круто ('.$rating.')"';
		} else {
			$img = 'src="/images/coocoo_smiles/normal.png" alt="Нормально" title="Нормально ('.$rating.')"';
		}
		
		return $img_b.$img.$img_e;
	} else {
		return "";
	}
}