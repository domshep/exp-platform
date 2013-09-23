<?php
App::import('View/Helper', 'BoostCake.BoostCakeFormHelper');

class BootstrapFormHelper extends BoostCakeFormHelper {

	/** This function intercepts the input calls and adds a variety of Bootstrap options to the call.
	 */
	public function input($fieldName, $options = array()) {
		$bootstrapOptions = array(
				'class' => 'form-control',
				'div' => 'form-group',
				'errorClass' => 'has-error error'
				);
				
		$options = array_merge($options, $bootstrapOptions);
		
		return parent::input($fieldName, $options);
	}
	
	/** This function intercepts the input calls and adds a variety of Bootstrap options to the call.
	 */
	public function textarea($fieldName, $options = array()) {
		$bootstrapOptions = array(
				'class' => 'form-control',
				'errorClass' => 'has-error error'
		);
	
		$options = array_merge($options, $bootstrapOptions);
	
		return parent::textarea($fieldName, $options);
	}
}
?>