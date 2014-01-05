<?php
class Benchmark {
	protected $benchmarks = array();
	protected $currentIteration = 0;

	public function _construct() {

	}

	public function newBenchmark($benchmark) {
		$this->benchmarks[$benchmark] = array('start' => microtime(true), 'iterations' => array(), 'end' => 0);
	}

	public function startIteration($benchmark) {
		if(isset($this->benchmarks[$benchmark])) {
			$this->benchmarks[$benchmark]['iterations'][] = array('start' => microtime(true), 'end' => 0);
			$this->currentIteration = count($this->benchmarks[$benchmark]['iterations']) - 1;
		}
	}

	public function endIteration($benchmark) {
		if(isset($this->benchmarks[$benchmark])) {
			$this->benchmarks[$benchmark]['iterations'][$this->currentIteration]['end'] = microtime(true);
		}
	}

	public function results($benchmark) {
		if(isset($this->benchmarks[$benchmark])) {
			$times = array();
			foreach($this->benchmarks[$benchmark]['iterations'] as $mark) {
				$times[] = $mark['end'] - $mark['start'];
			}
			rsort($times);
			$total = array_sum($times);
			$count = count($times);
			$high = $times[0];
			$low = $times[count($times) - 1];
			return array('average' => $total / $count, 'high' => $high, 'low' => $low, 'total' => $total, 'iterations' => $count);
		}
	}
}
