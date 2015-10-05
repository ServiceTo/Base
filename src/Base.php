<?php
	namespace ServiceTo;

	class Base {
		/**
		 * Setup array for matrix conversion and the default for base
		 *
		 * @var array matrix
		 * @var int base
		 */
		private $matrix = array();
		private $base = 0;

		/**
		 * When Base is called, build the matrix and store it's size.
		 *
		 * @return void
		 */
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

		/**
		 * Convert int to base
		 *
		 * @param  int    integer
		 * @return string base-62 conversion of int
		 */
		public function int2base($decimal) {
			return $this->int2basework($decimal, $this->base, "");
		}

		/**
		 * Legacy function name for int2base
		 *
		 * @param  int    integer
		 * @return string base-62 conversion of int
		 */
		public function dec2base($decimal) {
			return $this->int2base($decimal);
		}

		/**
		 * Worker function for conversion
		 *
		 * @param  int    integer
		 * @param  int    number of characters in base matrix (62)
		 * @param  string rolling string
		 * @return string base-62 conversion of int
		 */
		private function int2basework ($a, $b, $n) {
			$r = $a % $b;
			$result = ($a - $r)/$b;
			$n = $this->matrix[$r] . $n;
			if ($result > 0) {
				$n = $this->int2basework($result, $b, $n);
			}
			return $n;
		}

		/**
		 * Convert base-62 string to integer
		 *
		 * @param  string base-62 string
		 * @return int    integer conversion from base-62 string
		 */
		public function base2int ($basenum) {
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

		/**
		 * Legacy function name for base2int
		 *
		 * @param  string base-62 string
		 * @return int    integer conversion from base-62 string
		 */
		public function base2dec($basenum) {
			return base2int($basenum);
		}
	}