<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<p><strong>Total days within sensible drinking limits:</strong> <?php echo $achievements['DrinkingAchievement']['total_sensible_days']; ?></p>
<p><strong>Total days exceeding sensible drinking limits:</strong> 
	<?php echo $achievements['DrinkingAchievement']['total_excess_days']; ?></p>
<p><strong>Total days exceeding binge drinking levels:</strong>  
<?php echo $achievements['DrinkingAchievement']['total_binge_days'];?></p>
<?php }?>