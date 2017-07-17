	<?php 
  
  
  function index(){
		$response = file_get_contents('http://evimturkiye.com/forum/17-3747-1');
		libxml_use_internal_errors(true);
		$dom = new \DOMDocument();
		$dom->loadHTML($response);


		$finder = new \DomXPath($dom);
		$classname="ucoz-forum-post";
		$nodes = $finder->query("//*[contains(@class, '$classname')]");

		echo "<table>";
		foreach ($nodes as $node) {
			preg_match_all('/([0-9]+)\.\s*([[:alpha:]]*)\s*-\s*([[:alpha:]\-\/\s\,\.\–\(\)]*)\s*[^0-9]*/sui', $node->nodeValue, $matches, PREG_SET_ORDER);
//			print_r($matches);
			foreach ($matches as $match) {
				echo "<tr><td>".$match[0]."</td><td>".$match[1]."</td><td>".$match[2]."</td><td>".$match[3]."</td></tr>";

			}

		}
		echo "</table>";
	}
