<?php


	/**
	 * Automatic quotes for the language of your choice
	 * 
	 * Usage:   div.foo q { quotes:language[-country][-alt]; }
	 * Example: div.foo[lang=de-de] q { quotes:german-alt; }
	 * Example: div.foo[lang=en-us] q q { quotes:english-us; }
	 * Status:  Stable
	 * Version: 1.0
	 * 
	 * @param mixed &$parsed
	 * @return void
	 */
	function quotes(&$parsed){
		// List of quotes (Source: http://de.wikipedia.org/wiki/Anf%C3%BChrungszeichen#Kodierung)
		$quotes = array(
			'german' => array('201E', '201C', '201A', '2018'),
			'german-alt' => array('00BB', '00AB', '203A', '2039'),
			'swiss' => array('00AB', '00BB', '2039', '203A'),
			'english-uk' => array('2018', '2019', '201C', '201D'),
			'english-us' => array('201C', '201D', '2018', '2019')
		);
		// Main loop
		foreach($parsed as $block => $css){
			foreach($parsed[$block] as $selector => $styles){
				// Apply quotes
				if(isset($parsed[$block][$selector]['quotes'])){
					$value = $parsed[$block][$selector]['quotes'];
					if(isset($quotes[$value])){
						$parsed[$block][$selector]['quotes'] = '"\\'.$quotes[$value][0].'" "\\'.$quotes[$value][1].'" "\\'.$quotes[$value][2].'" "\\'.$quotes[$value][3].'"';
					}
				}
			}
		}
	}


	/**
	 * Register the plugin
	 */
	$cssp->register_plugin('before_compile', 0, 'quotes');


?>