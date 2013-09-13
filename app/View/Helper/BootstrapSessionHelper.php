<?php
App::uses('SessionHelper', 'View/Helper');

class BootstrapSessionHelper extends SessionHelper {

	/** This function converts the 'message' class to the 'alert' class (and its sub-classes) to allow
	 *  the bootstrap alert functionality to take precedence over the CakePHP message function.
	 * @param string $key
	 * @param unknown $attrs
	 */
	public function flash($key = 'flash', $attrs = array()) {
		
		$out = false;
		$class = 'alert alert-danger';
		
		if (CakeSession::check('Message.' . $key)) {
			$flash = CakeSession::read('Message.' . $key);
			$message = $flash['message'];
			unset($flash['message']);
		
			if (!empty($attrs)) {
				$flash = array_merge($flash, $attrs);
			}
			
			if ($flash['element'] == 'default') {
				if (!empty($flash['params']['class'])) {
					$class = $flash['params']['class'];
				}
				
				$out = '<div id="' . $key . 'Message" class="' . $class . ' fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $message . '</div>';
				
				// Call the parent anyway, just in case...
				parent::flash($key, array('params' => array('class' => $class)));
			} else {
				$out = parent::flash($key, array('params' => array('class' => $class)));
			}
		}

		return $out;
	}
}
?>