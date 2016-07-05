<?php

namespace Dev;

class Task {
	public static function serve($event) {
		$port = 8000;
		echo exec('php -S localhost:'.$port.' -t public');
	}
}
