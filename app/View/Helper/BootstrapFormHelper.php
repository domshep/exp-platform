<?php
App::import('View/Helper', 'BoostCake.BoostCakeFormHelper');

class BootstrapFormHelper extends BoostCakeFormHelper {

	/** This function intercepts the input calls and adds a variety of Bootstrap options to the call.
	 */
	public function input($fieldName, $options = array()) {
		$bootstrapOptions = array(
				'errorClass' => 'has-error error'
				);
				
		$options = array_merge($options, $bootstrapOptions);
		
		if (isset($options['class'])) {
			$options['class'] = $options['class'] . " form-control";
		} else {
			$options['class'] = "form-control";
		}
		
		if (isset($options['div']['class'])) {
			$options['div']['class'] = $options['div']['class'] . " form-group";
		} else {
			$options['div']['class'] = "form-group";
		}
		
		/* If the option 'horiz' is true, then this is a horizonal form, so should have the additional options
		 * set for it.
		 */
		if (isset($options['horiz'])) {
			if($options['horiz']) {
				$options['after'] = "</div>";
				$options['between'] = "<div class='col-md-4'>";
				$options['label']['class'] = "col-md-3";
			}
			unset($options['horiz']);
		}
		
		return parent::input($fieldName, $options);
	}
	
	/** This function intercepts the input calls and adds a variety of Bootstrap options to the call.
	 */
	public function textarea($fieldName, $options = array()) {
		$bootstrapOptions = array(
				'class' => 'form-control'
		);
	
		$options = array_merge($options, $bootstrapOptions);
	
		return parent::textarea($fieldName, $options);
	}
}
?>