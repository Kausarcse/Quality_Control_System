<?php

/*******************************************************************************
* Script :  PDF_Code128
* Version : 1.2
* Date :    2016-01-31
* Auteur :  Roland Gautier
*
* Version   Date        Detail
* 1.2       2016-01-31  Compatibility with FPDF 1.8
* 1.1       2015-04-10  128 control characters FNC1 to FNC4 accepted
* 1.0       2008-05-20  First release
*
* Code128($x, $y, $code, $w, $h)
*     $x,$y :     angle sup�rieur gauche du code � barre
*                 upper left corner of the barcode
*     $code :     le code � cr�er
*                 ascii text to convert to barcode
*     $w :        largeur hors tout du code dans l'unit� courante
*                 (pr�voir 5 � 15 mm de blanc � droite et � gauche)
*                 barcode total width (current unit)
*                 (keep 5 to 15 mm white on left and right sides)
*     $h :        hauteur hors tout du code dans l'unit� courante
*                 barcode total height (current unit)
*
* Commutation des jeux ABC automatique et optimis�e
* Automatic and optimized A/B/C sets selection and switching
*
*
*   128 barcode control characters
*   ASCII   Aset            Bset        [ne pas utiliser][do not use]
*   ---------------------------
*   200     FNC3            FNC3
*   201     FNC2            FNC2
*   202     ShiftA          ShiftB
*   203     [SwitchToCset]  [SwitchToCset]
*   204     [SwitchToBset]  FNC4
*   205     FNC4            [SwitchToAset]
*   206     FNC1            FNC1
*******************************************************************************/

Include('fpdf.php');

class PDF_Code128 extends FPDF {

protected $T128;                                         // Tableau des codes 128
protected $ABCset = "";                                  // jeu des caract�res �ligibles au C128
protected $Aset = "";                                    // Set A du jeu des caract�res �ligibles
protected $Bset = "";                                    // Set B du jeu des caract�res �ligibles
protected $Cset = "";                                    // Set C du jeu des caract�res �ligibles
protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caract�res de s�lection de jeu au d�but du C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caract�res de changement de jeu

//____________________________ Extension du constructeur _______________________
function __construct($orientation='P', $unit='mm', $format='A4') {

	parent::__construct($orientation,$unit,$format);

	$this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caract�res
	$this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
	$this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
	$this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
	$this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
	$this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
	$this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
	$this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
	$this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
	$this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
	$this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
	$this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
	$this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
	$this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
	$this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
	$this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
	$this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
	$this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
	$this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
	$this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
	$this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
	$this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
	$this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
	$this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
	$this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
	$this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
	$this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
	$this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
	$this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
	$this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
	$this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
	$this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
	$this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
	$this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
	$this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
	$this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
	$this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
	$this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
	$this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
	$this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
	$this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
	$this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
	$this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
	$this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
	$this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
	$this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
	$this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
	$this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
	$this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
	$this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
	$this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
	$this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
	$this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
	$this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
	$this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
	$this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
	$this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
	$this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
	$this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
	$this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
	$this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
	$this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
	$this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
	$this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
	$this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
	$this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
	$this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
	$this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
	$this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
	$this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
	$this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
	$this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
	$this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
	$this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
	$this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
	$this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
	$this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
	$this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
	$this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
	$this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
	$this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
	$this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
	$this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
	$this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
	$this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
	$this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
	$this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
	$this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
	$this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
	$this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
	$this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
	$this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
	$this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
	$this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
	$this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
	$this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
	$this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
	$this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
	$this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
	$this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
	$this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
	$this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
	$this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
	$this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
	$this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
	$this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
	$this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
	$this->T128[] = array(2, 1);                       //107 : [END BAR]

	for ($i = 32; $i <= 95; $i++) {                                            // jeux de caract�res
		$this->ABCset .= chr($i);
	}
	$this->Aset = $this->ABCset;
	$this->Bset = $this->ABCset;
	
	for ($i = 0; $i <= 31; $i++) {
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
	}
	for ($i = 96; $i <= 127; $i++) {
		$this->ABCset .= chr($i);
		$this->Bset .= chr($i);
	}
	for ($i = 200; $i <= 210; $i++) {                                           // controle 128
		$this->ABCset .= chr($i);
		$this->Aset .= chr($i);
		$this->Bset .= chr($i);
	}
	$this->Cset="0123456789".chr(206);

	for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
		@$this->SetFrom["A"] .= chr($i);
		@$this->SetFrom["B"] .= chr($i + 32);
		@$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
		@$this->SetTo["B"] .= chr($i);
	}
	for ($i=96; $i<107; $i++) {                                                 // contr�le des jeux A & B
		@$this->SetFrom["A"] .= chr($i + 104);
		@$this->SetFrom["B"] .= chr($i + 104);
		@$this->SetTo["A"] .= chr($i);
		@$this->SetTo["B"] .= chr($i);
	}
}

//________________ Fonction encodage et dessin du code 128 _____________________
function Code128($x, $y, $code, $w, $h) {
	$Aguid = "";                                                                      // Cr�ation des guides de choix ABC
	$Bguid = "";
	$Cguid = "";
	for ($i=0; $i < strlen($code); $i++) {
		$needle = substr($code,$i,1);
		$Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
		$Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
		$Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
	}

	$SminiC = "OOOO";
	$IminiC = 4;

	$crypt = "";
	while ($code > "") {
                                                                                    // BOUCLE PRINCIPALE DE CODAGE
		$i = strpos($Cguid,$SminiC);                                                // for�age du jeu C, si possible
		if ($i!==false) {
			$Aguid [$i] = "N";
			$Bguid [$i] = "N";
		}

		if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
			$crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // d�but Cstart, sinon Cswap
			$made = strpos($Cguid,"N");                                             // �tendu du set C
			if ($made === false) {
				$made = strlen($Cguid);
			}
			if (fmod($made,2)==1) {
				$made--;                                                            // seulement un nombre pair
			}
			for ($i=0; $i < $made; $i += 2) {
				$crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
			}
			$jeu = "C";
		} else {
			$madeA = strpos($Aguid,"N");                                            // �tendu du set A
			if ($madeA === false) {
				$madeA = strlen($Aguid);
			}
			$madeB = strpos($Bguid,"N");                                            // �tendu du set B
			if ($madeB === false) {
				$madeB = strlen($Bguid);
			}
			$made = (($madeA < $madeB) ? $madeB : $madeA );                         // �tendu trait�e
			$jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

			$crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // d�but start, sinon swap

			$crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

		}
		$code = substr($code,$made);                                           // raccourcir l�gende et guides de la zone trait�e
		$Aguid = substr($Aguid,$made);
		$Bguid = substr($Bguid,$made);
		$Cguid = substr($Cguid,$made);
	}                                                                          // FIN BOUCLE PRINCIPALE

	$check = ord($crypt[0]);                                                   // calcul de la somme de contr�le
	for ($i=0; $i<strlen($crypt); $i++) {
		$check += (ord($crypt[$i]) * $i);
	}
	$check %= 103;

	$crypt .= chr($check) . chr(106) . chr(107);                               // Chaine crypt�e compl�te

	$i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
	$modul = $w/$i;

	for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
		$c = $this->T128[ord($crypt[$i])];
		for ($j=0; $j<count($c); $j++) {
			$this->Rect($x,$y,$c[$j]*$modul,$h,"F");
			$x += ($c[$j++]+$c[$j])*$modul;
		}
	}
}

function sp_character($word) {

	$word = str_replace('+', ' ', $word);
	$word = str_replace("%E2%89%A5","%D7",$word); 		/* ≥ */
	$word = str_replace("%E2%89%A4","%A4",$word);		/* ≤ */
	$word = str_replace("%C2%B0","%B0",$word); 			/* degree*/
	$word = str_replace("%C3%A9","%E9",$word);          /* é */
	$word = str_replace("%C3%A8","%E8",$word);          /* è */
	$word = str_replace("%C3%AE","%EE",$word);          /* î */
	$word = str_replace("%26rsquo%3B","%27",$word);     /* ' */
	$word = str_replace("%C3%89","%C9",$word);          /* É */
	$word = str_replace("%C3%8A","%CA",$word);          /* Ê */ 
	$word = str_replace("%C3%8B","%CB",$word);          /* Ë */
	$word = str_replace("%C3%8C","%CC",$word);          /* Ì */
	$word = str_replace("%C3%8D","%CD",$word);          /* Í */
	$word = str_replace("%C3%8E","%CE",$word);          /* Î */
	$word = str_replace("%C3%8F","%CF",$word);          /* Ï */
	$word = str_replace("%C3%90","%D0",$word);          /* Ð */
	$word = str_replace("%C3%91","%D1",$word);          /* Ñ */
	$word = str_replace("%C3%92","%D2",$word);          /* Ò */
	$word = str_replace("%C3%93","%D3",$word);          /* Ó */
	$word = str_replace("%C3%94","%D4",$word);          /* Ô */
	$word = str_replace("%C3%95","%D5",$word);          /* Õ */
	$word = str_replace("%C3%96","%D6",$word);          /* Ö */
	$word = str_replace("%C3%98","%D8",$word);          /* Ø */                 
	$word = str_replace("%C3%99","%D9",$word);          /* Ù */
	$word = str_replace("%C3%9A","%DA",$word);          /* Ú */
	$word = str_replace("%C3%9B","%DB",$word);          /* Û */
	$word = str_replace("%C3%9C","%DC",$word);          /* Ü */
	$word = str_replace("%C3%9D","%DD",$word);          /* Ý */
	$word = str_replace("%C3%9E","%DE",$word);          /* Þ */
	$word = str_replace("%C3%9F","%DF",$word);          /* ß */
	$word = str_replace("%C3%A0","%E0",$word);          /* à */
	$word = str_replace("%C3%A1","%E1",$word);          /* á */
	$word = str_replace("%C3%A2","%E2",$word);          /* â */
	$word = str_replace("%C3%A3","%E3",$word);          /* ã */
	$word = str_replace("%C3%A4","%E4",$word);          /* ä */
	$word = str_replace("%C3%A5","%E5",$word);          /* å */
	$word = str_replace("%C3%A6","%E6",$word);          /* æ */
	$word = str_replace("%C3%A7","%E7",$word);          /* ç */
	$word = str_replace("%C3%AA","%EA",$word);          /* ê */
	$word = str_replace("%C3%AB","%EB",$word);          /* ë */
	$word = str_replace("%C3%AC","%EC",$word);          /* ì */
	$word = str_replace("%C3%AD","%ED",$word);          /* í */
	$word = str_replace("%C3%AF","%EF",$word);          /* ï */
	$word = str_replace("%C3%B0","%F0",$word);          /* ð */
	$word = str_replace("%C3%B1","%F1",$word);          /* ñ */
	$word = str_replace("%C3%B2","%F2",$word);          /* ò */
	$word = str_replace("%C3%B3","%F3",$word);          /* ó */
	$word = str_replace("%C3%B4","%F4",$word);          /* ô */
	$word = str_replace("%C3%B5","%F5",$word);          /* õ */
	$word = str_replace("%C3%B6","%F6",$word);          /* ö */
	$word = str_replace("%C3%B7","%F7",$word);          /* ÷ */
	$word = str_replace("%C3%B8","%F8",$word);          /* ø */
	$word = str_replace("%C3%B9","%F9",$word);          /* ù */
	$word = str_replace("%C3%BA","%FA",$word);          /* ú */
	$word = str_replace("%C3%BB","%FB",$word);          /* û */
	$word = str_replace("%C3%BC","%FC",$word);          /* ü */
	$word = str_replace("%C3%BD","%FD",$word);          /* ý */
	$word = str_replace("%C3%BE","%FE",$word);          /* þ */
	$word = str_replace("%C3%BF","%FF",$word);          /* ÿ */ 
	$word = str_replace("%40","%40",$word);             /* @ */
	$word = str_replace("%60","%60",$word);             /* ` */
	$word = str_replace("%C2%A2","%A2",$word);          /* ¢ */
	$word = str_replace("%C2%A3","%A3",$word);          /* £ */
	$word = str_replace("%C2%A5","%A5",$word);          /* ¥ */
	$word = str_replace("%7C","%A6",$word);             /* | */
	$word = str_replace("%C2%AB","%AB",$word);          /* « */
	$word = str_replace("%C2%AC","%AC",$word);          /* ¬ */
	$word = str_replace("%C2%AF","%AD",$word);          /* ¯ */
	$word = str_replace("%C2%BA","%B0",$word);          /* º */
	$word = str_replace("%C2%B1","%B1",$word);          /* ± */
	$word = str_replace("%C2%AA","%B2",$word);          /* ª */
	$word = str_replace("%C2%B5","%B5",$word);          /* µ */
	$word = str_replace("%C2%BB","%BB",$word);          /* » */
	$word = str_replace("%C2%BC","%BC",$word);          /* ¼ */
	$word = str_replace("%C2%BD","%BD",$word);          /* ½ */
	$word = str_replace("%C2%BF","%BF",$word);          /* ¿ */
	$word = str_replace("%C3%80","%C0",$word);          /* À */
	$word = str_replace("%C3%81","%C1",$word);          /* Á */
	$word = str_replace("%C3%82","%C2",$word);          /* Â */
	$word = str_replace("%C3%83","%C3",$word);          /* Ã */
	$word = str_replace("%C3%84","%C4",$word);          /* Ä */
	$word = str_replace("%C3%85","%C5",$word);          /* Å */
	$word = str_replace("%C3%86","%C6",$word);          /* Æ */
	$word = str_replace("%C3%87","%C7",$word);          /* Ç */
	$word = str_replace("%C3%88","%C8",$word);       
	return $word;
}





}                                                                              // FIN DE CLASSE
?>
