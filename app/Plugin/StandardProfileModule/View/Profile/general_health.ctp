<h1>Your General Health &amp; Employment</h1>
<?php 
echo $this->Html->link(
		__d('cake_dev', 'Skip these questions for now >>'),
		array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard'),
		array('class'=>'pull-right')
);
?>
<p class="lead">Please enter some general details about your health and employment below.</p>
<p><strong>All your data will be treated in the strictest confidence and held in a highly secure database. This website allows you modify or remove your profile at a later stage should you wish to do so.</strong></p>
	
<div class="row">
<div class="col-md-6 col-md-offset-3">
<?php echo $this->Form->create('GeneralHealth');

?>
	<fieldset>
		<?php
		echo $this->Form->hidden('id');
		echo $this->Form->input('GeneralHealth.general_health', array(
				'options' => array('5'=>'Excellent','4'=> 'Very good', '3' => 'Good', '2' => 'Fair', '1' => 'Poor'),
	    		'empty' => '(choose one)',
	    		'label' => '1. In general, would you say your health is'
			));
	?>
	<label>2. Over the last 2 weeks, how often have you been bothered by the following problems?</label>
	<table class="table">
	<thead>
	<tr>
	<th>&nbsp;</th>
	<th>Not at all</th>
	<th>Several days</th>
	<th>More than half the days</th>
	<th>Nearly every day</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>
	Feeling nervous, anxious or on edge
	</td>
	<?php
		$attributes = array('legend' => false);
		echo $this->Form->input('GeneralHealth.nervous', array(
			'options'=> array('0'=>'','1'=>'','2'=>'','3'=>''),
			'before' => '<td><span class="input radio">',
			'after' => '</span></td>',
			'separator'=>'</span></td><td><span class="input radio">',
			'type'=>'radio',
			'legend' => false,
			'div' => false,
			'label' => false,
			'wrapInput' => false));
	?>
	</tr>
	<tr>
	<td>
	Not being able to stop or control worrying
	</td>
	<?php
		$attributes = array('legend' => false);
		echo $this->Form->input('GeneralHealth.worrying', array(
			'options'=> array('0'=>'','1'=>'','2'=>'','3'=>''),
			'before' => '<td><span class="input radio">',
			'after' => '</span></td>',
			'separator'=>'</span></td><td><span class="input radio">',
			'type'=>'radio',
			'legend' => false,
			'div' => false,
			'label' => false,
			'wrapInput' => false));
	?>
	</tr>
	<tr>
	<td>
	Little interest or pleasure in doing things
	</td>
	<?php
		$attributes = array('legend' => false);
		echo $this->Form->input('GeneralHealth.little_interest', array(
			'options'=> array('0'=>'','1'=>'','2'=>'','3'=>''),
			'before' => '<td><span class="input radio">',
			'after' => '</span></td>',
			'separator'=>'</span></td><td><span class="input radio">',
			'type'=>'radio',
			'legend' => false,
			'div' => false,
			'label' => false,
			'wrapInput' => false));
	?>
	</tr>
	<tr>
	<td>
	Feeling down, depressed or hopeless
	</td>
	<?php
		$attributes = array('legend' => false);
		echo $this->Form->input('GeneralHealth.feeling_down', array(
			'options'=> array('0'=>'','1'=>'','2'=>'','3'=>''),
			'before' => '<td><span class="input radio">',
			'after' => '</span></td>',
			'separator'=>'</span></td><td><span class="input radio">',
			'type'=>'radio',
			'legend' => false,
			'div' => false,
			'label' => false,
			'wrapInput' => false));
	?>
	</tr>
	</tbody>
	</table>
	
	<?php
		echo $this->Form->input('GeneralHealth.supervisor', array(
			'options' => array('1'=>'Yes','0'=> 'No'),
			'empty' => '(choose one)',
			'label' => '3. Do (did) you supervise any other employees?'
		));
		?>
		
		<div class="input">
		<label>4. Please tick one box/select one option which best describes the sort of work you do.</label>
	<?php
		$options = array(
			'Professional occupation' => '<strong>Professional occupation</strong><br />Teacher, nurse, physiotherapist, social worker, welfare officer, software designer, accountant, solicitor, medical practitioner, scientist',
			'Clerical and intermediate occupation' => '<strong>Clerical and intermediate occupations</strong><br />Secretary, personal assistant, clerical worker, office clerk, call centre agent, nursing auxiliary, nursery nurse',
			'Senior manager or administrator' => '<strong>Senior managers or administrators</strong><br />(usually responsible for planning, organising and coordinating work; and for finance); Finance manager, chief executive',
			'Middle or junior manager' => '<strong>Middle or junior managers</strong><br />Office manager, retail manager, bank manager, restaurant manager, warehouse manager',
			'Technical and craft occupation' => '<strong>Technical and craft occupations</strong><br />Inspector, plumber, printer, electrician, gardener, tool maker',
			'Routine manual and service occupations' => '<strong>Routine manual and service occupations</strong><br />Postal worker, security guard, caretaker, catering assistant, receptionist, sales assistant, HGV/van driver, cleaner, porter, messenger',
			);
		$attributes = array(
			'legend' => false,
			'style'=>'margin-right:1em;margin-bottom:2em;',
			'div'=>false,
			'separator'=>'<br />',
			'type' => 'radio');
		
		echo $this->Form->radio('GeneralHealth.occupation', $options, $attributes);
		?>
		</div>
	<?php 
		echo $this->Form->input('GeneralHealth.sickness_absence', array(
				'label' => '5. In the last 6 months, how many days were you off work for health reasons?',
				'style' => 'width:3em'
		));
		echo $this->Form->input('GeneralHealth.sickness_absence_spells', array(
				'label' => '6. In the last 6 months, how many spells of sickness absence lasting a week or more have you experienced?',
				'style' => 'width:3em'
		));
	?>
	<div class="input">
		<label>7. Generally, over the past 30 days, how would you rate your performance at work?</label>
		<table class="question-range table">
		<tbody>
		<tr>
	<?php
		$attributes = array('legend' => false);
		echo $this->Form->input('GeneralHealth.work_performance', array(
			'options'=> array('0','1','2','3','4','5','6','7','8','9','10'),
			'before' => '<td><span class="input radio">',
			'after' => '</span></td>',
			'separator'=>'</span></td><td><span class="input radio">',
			'type'=>'radio',
			'legend' => false,
			'div' => false,
			'label' => false,
			'wrapInput' => false));
	?>
		</tr>
		</tbody>
		</table>
	</div>
	</fieldset>
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
    </div>
	<?php echo $this->Form->end(); ?>
</div>

</div>
