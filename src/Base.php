<?php
	namespace ServiceTo;

	class Base {
		private $matrix = array();
		private $base = 0;

		public function __construct() {
			foreach (range(0, 9) as $l) {
				$this->matrix[] = $l;
			}
			foreach (range("a", "z") as $l) {
				$this->matrix[] = $l;
			}
			foreach (range("A", "Z") as $l) {
				$this->matrix[] = $l;
			}
			$this->base = count($this->matrix);
		}

		public function dec2base($decimal) {
			return $this->dec2basework($decimal, $this->base, "");
		}
		private function dec2basework ($a, $b, $n) {
			$r = $a % $b;
			$result = ($a - $r)/$b;
			$n = $this->matrix[$r] . $n;
			if ($result > 0) {
				$n = $this->dec2basework($result, $b, $n);
			}
			return $n;
		}

		public function base2dec ($basenum) {
			$digits = strlen($basenum);
			$number = 0;
			for ($i = 0; $i < $digits; $i++) {
				$basex = substr($basenum, -($i + 1), 1);
				$power = pow($this->base, $i);
				foreach ($this->matrix as $n => $b) {
					if ($b == $basex) {
						$num = $n;
					}
				}
				$number += $power * $num;
			}
			return $number;
		}
	}