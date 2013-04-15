<?php
	if($medal != "") {
		?>
		<div class="news">
			<h3>
			<?php 
				echo $this->Html->link(__('News and Updates'), '/news/index', array('target' => '_self')); 
			?></h3>
		<h4><strong>Congratulations, You have earned your <?php echo $medal; ?> medal!</strong></h4>
		<?php
		echo $this->Html->image(
				'Medal-'. $medal .'-icon.png',
				array('alt' => $medal . ' Medal', 'align' => 'left')
		);

		if($medal == 'Bronze') {
		?>
			<p>Congratulations &ndash; you have achieved the bronze medal for maintaining your weight within the recommended healthy range over the last <?php echo $consecutive_weeks; ?> weeks.</p>
		<?php 
		} elseif ($medal == 'Silver') {
		?>
			<p>Congratulations and well done. You have achieved the silver medal for maintaining your weight within the recommended healthy range over the last <?php echo $consecutive_weeks; ?> weeks.</p>
			<p>How are you feeling now? You should be feeling better and starting to notice some differences in your body and health!</p>
			
		<?php 
		} elseif ($medal == 'Gold') {
		?>
			<p>Congratulations, you are a Healthy Weight champion and have achieved the gold medal which is fantastic. You have successfully maintained your weight within the healthy range over the last <?php echo $consecutive_weeks; ?> weeks.</p>
			<p>This shows you have made a great effort to build some changes into your lifestyle. If you can maintain these changes, why not add another health module to your dashboard and make more positive changes?</p>
			
		<?php 
		}
		?>
		</div>
		<?php
	}
?>