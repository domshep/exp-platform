<?php
class ModuleHelperFunctions {
	/**
	 * Returns the week beginning date for the given date (starting on a Monday).
	 *
	 * @param string $date
	 */
	public function _getWeekBeginningDate($date) {
		$dateTime = strtotime($date);
		if(date('w',$dateTime) == '1') {
			// It's Monday, so return the same date
			return $dateTime;
		} else {
			// return last Monday's date
			return strtotime('this week last monday', $dateTime);
		}
	}
}
?>