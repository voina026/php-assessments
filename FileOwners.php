<?php 
class FileOwners
{
	public function groupByOwners($files)
	{
		if(is_array($files))
		{
			$array = array();
			foreach ($files as $key => $value)
			{
				if(array_key_exists($value, $array))
					$array[$value][] = $key;
					else
						$array[$value][] = $key;
			}
		}
		return $array;
	}
}
class Palindrome
{
	public function isPalindrome($word)
	{
		$word = strtolower($word);
		if($word == strrev($word))
			return "True";

			return "False";
	}
}
class thesaurus
{
	public function getSynonyms($word)
	{
		$synonyms =	array("buy" => array("purchase"), "big" => array("great", "large"));
		 
		$array['word'] 		= $word;
		$array['synonyms'] 	= (array_key_exists($word, $synonyms) ? $synonyms[$word] : array() );
		echo json_encode($array);

	}
}
class Path
{
	public $currentPath;

	function __construct($path)
	{
		$this->currentPath = $path;
	}

	public function cd($newPath)
	{
		$dir = explode('/', $this->currentPath);
		$cd  = explode('/', $newPath);
		 
		$parentDir = 0;
		foreach($cd as $key => $value)
		{
			if($value == "..")
			{
				$parentDir++;
				unset($cd[$key]);
			}
			if(!preg_match("/^[a-zA-Z]+$/", $value))
			{
				unset($cd[$key]);
			}
		}

		krsort($dir);
		$i = 0;
		foreach ($dir as $key => $value)
		{
			if($i < $parentDir || (!preg_match("/^[a-zA-Z]+$/", $value) && $value != ""  ))
			{
				unset($dir[$key]);
			}
			$i++;
		}
		ksort($dir);
		$this->currentPath = implode("/", $dir)."/".implode("/", $cd);

		// add dir_exists for validation of dir
	}
}

$path = new Path('/a/b/c/d');
$thesaurus = new thesaurus();
$palindrome = new Palindrome;
$fileOwners = new FileOwners;
?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$title;?></title>
	
	<style>
		html, body, .innerDiv
		{
			height:				100%;
			width:				100%;
			margin:				0;
			padding:			0;
		}
		body
		{
			font-family: 		Helvetica;
		}
		ul
		{
			margin:				0;
			padding:			0;
		}
		li
		{
			list-style: 		none;
			padding:			20px;
		}
		li:nth-child(4n), li:nth-child(4n-1) 
		{
    		background-color:	#303030;
    		color:				white
		}
		li:nth-child(4n-2), li:nth-child(4n-3) 
		{
			background-color:	#c0c0c0
		}
		li:nth-child(4n+1)
		{
			border-bottom:		1px solid #303030;
		}
		li:nth-child(4n+3)
		{
			border-bottom:		1px solid #c0c0c0;
		}
		.wrapper
		{
			height: 			100%; 
			width: 				100%; 
			max-width: 			800px; 
			margin: 			auto auto;
		}
		.header
		{
			text-align: 		center;
			background-color: 	#303030;
			color: 				#FFF;
			min-height:			80px;
		}
		.header h1
		{
			display: 			inline-block;
		}
		
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<h1>PHP Assessments</h1>
		</div>
		<ul>
			<li>
				<p>
				<b>## 1. File Owners</b><br/>
				<br/>
				Implement a groupByOwners function that:<br/>
				Accepts an associative array containing the file owner name for each file name.<br/>
				Returns an associative array containing an array of file names for each owner name, in any order.<br/>
				<br/>
				For example, for associative array ["Input.txt" => "Randy", "Code.py" => "Stan", "Output.txt" => "Randy"]<br/>
				the groupByOwners function should return ["Randy" => ["Input.txt", "Output.txt"], "Stan" => ["Code.py"]].
				</p>
			</li>
			<li>
			<?php 
			$files = array
			(
					"Input.txt" => "Randy",
					"Code.py" => "Stan",
					"Output.txt" => "Randy"
			);
			?>
			Input:<br/>
			$files = array
			(
					"Input.txt" => "Randy",
					"Code.py" => "Stan",
					"Output.txt" => "Randy"
			);
			<br/>
			<br/>
			Answer:
			<br/>
			<?php 
			echo '<pre>'; print_r($fileOwners->groupByOwners($files)); echo '</pre>';
			?>
			</li>
			<li> 
				<p>
				<b>## 2. Palindrome</b><br/>
				<br/>
				A palindrome is a word that reads the same backward or forward.<br/>
				Write a function that checks if a given word is a palindrome. Character case should be ignored.<br/>
				For example, isPalindrome("Deleveled") should return true as character case should be ignored, resulting in "deleveled", which is a palindrome since it reads the same backward and forward.<br/>
				</p>
			</li>
			<li>
			Is "Deleveled" a palindrome?
			<br/>
			<br/>
			Answer:
			<br/>
			<?php 
			echo $palindrome->isPalindrome('Deleveled');
			?>
			</li>
			<li> 
				<p>
				<b>## 3. Thesaurus</b><br/>
				<br/>
				A thesaurus contains words and synonyms for each word. Below is an example of a data structure that defines a thesaurus:<br/>
				`array("buy" => array("purchase"), "big" => array("great", "large"))`<br/>
				<br/>
				Implement the function getSynonyms, which accepts a word as a string and returns all synonyms for that word in JSON format, as in the example below.<br/>
				For example, the call $thesaurus->getSynonyms("big") should return:<br/>
				<br/>
				`{"word":"big","synonyms":["great", "large"]}`<br/>
				<br/>
				while a call with a word that doesn't have synonyms, like $thesaurus->getSynonyms("agelast") should return:<br/>
				<br/>
				`{"word":"agelast","synonyms":[]}`
				</p>
			</li>
			<li>
			Thesaurus for "big" are:
			<br/>
			<br/>
			Answer:
			<br/>
			<?php 
			$thesaurus->getSynonyms("big");
			?>
			</li>
			<li>
				<p>
				<b>## 4. Path</b><br/>
				<br/>
				Write a function that provides change directory (cd) function for an abstract file system.<br/>
				<br/>
				Notes:<br/>
				* Root path is '/'.<br/>
				* Path separator is '/'.<br/>
				* Parent directory is addressable as '..'.<br/>
				* Directory names consist only of English alphabet letters (A-Z and a-z).<br/>
				* The function should support both relative and absolute paths.<br/>
				* The function will not be passed any invalid paths.<br/>
				* Do not use built-in path-related functions.<br/>
				<br/>
				For example:<br/>
				<br/>
				$path = new Path('/a/b/c/d');<br/>
				$path->cd('../x')<br/>
				echo $path->currentPath;<br/>
				<br/>
				should display '/a/b/c/x'.<br/>
				</p>
			</li>
			<li>
			<?php 
			$input = $path->cd('../x/3/y');
			?>
			Input:<br/>
			$path->cd('../x/3/y');
			<br/>
			<br/>
			Answer:
			<br/>
			<?php 
			echo $path->currentPath;
			?>
			</li>
		</ul>
	</div>
</body>
</html>

<?php

/*
# PHP Assessments

## How to file your assignement
Please fork this repository on your github account when you are ready to start on your assignement. Create a folder with your github accountname like I did and create your answers in there. When you are finished please submit a pullrequest.

Please submit unit tests with your assignments to prove they are doing what they should do.
*/
?>