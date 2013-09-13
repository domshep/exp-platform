<?php
App::uses('FormHelper', 'View/Helper');

class BootstrapFormHelper extends FormHelper {

	/** This function intercepts the input calls and adds a variety of Bootstrap options to the call.
	 */
	public function input($fieldName, $options = array()) {
		$bootstrapOptions = array(
				'class' => 'form-control',
				'div' => 'form-group'
				);
				
		$options = array_merge($options, $bootstrapOptions);
		
		return parent::input($fieldName, $options);
	}
}
?>