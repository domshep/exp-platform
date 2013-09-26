 <script>
	$(function() {
		$( "#slider-vertical" ).slider({
			orientation: "vertical",
			range: "min",
			min: 0,
			max: 100,
			value: 0,
			slide: function( event, ui ) {
				$( "#HealthScoreScore" ).val( ui.value );
			}
		});
		$( "#HealthScoreScore" ).val( $( "#slider-vertical" ).slider( "value" ) );
	});
</script>
<h1>Rate Your Current Health</h1>
<p class="lead">How good or bad is your health?  Please score this on a scale from 0 to 100. 100 means the best health you can imagine and  0 means the worst health you can imagine.</p>
<p>Please move the slider to a point on the line which best describes your current health.</p>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<?php echo $this->Form->create('HealthScore'); ?>
	<fieldset>
		<div id="slider-vertical" style="height: 200px;float:left;"></div>
		<?php
		echo $this->Form->input('HealthScore.score', array('label' => 'Your health score', 'style' => 'float:left;width:200px;clear:none;', 'div' => array('style' => 'clear:none;margin-left:2em;'
)));
		?>
	</fieldset>
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
    </div>
	<?php echo $this->Form->end(); ?>
</div>

</div>