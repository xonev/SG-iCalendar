<?php // BUILD: Remove line

/**
 * A class to store Frequency-rules in. Will allow a easy way to find the 
 * last and next occurrence of the rule.
 *
 * No - this is so not pretty. But.. ehh.. You do it better, and I will 
 * gladly accept patches.
 *
 * Created by trail-and-error on the examples given in the RFC.
 *
 * TODO: Update to a better way of doing calculating the different options.
 * Instead of only keeping track of the best of the current dates found
 * it should instead keep a array of all the calculated dates within the
 * period. 
 * This should fix the issues with multi-rule + multi-rule interference, 
 * and make it possible to implement the SETPOS rule.
 * By pushing the next period onto the stack as the last option will 
 * (hopefully) remove the need for the awful simpleMode
 *
 * @package SG_iCalReader
 * @author Morten Fangel (C) 2008
 * @license http://creativecommons.org/licenses/by-sa/2.5/dk/deed.en_GB CC-BY-SA-DK
 */
class SG_iCal_Freq {
	private $weekdays = array('MO'=>'monday', 'TU'=>'tuesday', 'WE'=>'wednesday', 'TH'=>'thursday', 'FR'=>'friday', 'SA'=>'saturday', 'SU'=>'sunday');
	private $byRuleParts = array('bymonth', 'byweekno', 'byday', 'bymonthday', 'byyearday', 'byhour', 'byminute', 'bysetpos', 'byminute', 'bysecond');
	private $ruleModifiers = array('wkst');
	
	private $recurrence;
	private $start = 0;
	private $freq = '';

	/**
	 * The name of the method for calculating the next event in the series of events.
	 * @var string
	 */
	protected $action;

	/**
	 * Constructs a new Freqency-rule
	 * @param string $recurrence the recurrence rule string
	 * @param int $start Unix-timestamp (important!) the start date-time of the
	 * event for which the frequency is to be calculated
	 */
	public function __construct( $recurrence, $start ) {
		$this->recurrence = new SG_iCal_Recurrence($recurrence);
		$this->start = $start;
	}

	/**
	 *
	 * @param int $offset the timestamp of the offset to find the next occurrence of the rule from
	 */
	public function findNext( $offset = 0 ) {
		$start = $offset > $this->start ? $offset : $this->start;
		if ( !isset($this->action) ) {
			$frequency = ucfirst(strtolower($this->recurrence->getFreq()));
			$this->action = 'calculateNext'.$frequency;
		}
		return $this->{$this->action}();
	}

	public function calculateNextDaily() {
		if ($this->recurrence->getCount()) {
			
		}
		if ($this->recurrence->getByMonth()) {

		}
	}
}
