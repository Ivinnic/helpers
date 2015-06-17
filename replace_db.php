<?php

function replace(){
		$from ='kypasser.com';
		$to = 'kypasser.ru';
		$data = array(
			'sender_lang'=>array('title', 'text'),
			'about_lang'=>array('title', 'text'),
			'faq_lang'=>array('title', 'text'),
			'languages_lang'=>array('value'),
			'materials'=>array('text'),
			'pages_lang'=>array('title', 'text', 'meta_description'),
		);

		foreach ($data as $tabel => $fields) {
			foreach($fields as $field){
				$this->db->query("UPDATE `$tabel` SET $field = replace($field, '$from', '$to')");
			}
		}
