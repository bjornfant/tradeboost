<?php
class Translation {
	public function translate($text, $to_lang, $from_lang) {

		require_once(DIR_SYSTEM . 'translate.php');

		$translator = new ChatGPTTranslator(); //key comes from secrets.php

		$result = $translator->translate($text, $to_lang, $from_lang);
		return $result; 
	}

}
?>