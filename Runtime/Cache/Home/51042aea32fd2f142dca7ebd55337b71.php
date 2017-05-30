<?php if (!defined('THINK_PATH')) exit(); if(($readonly) == "true"): ?><div class="form-inline form-control-static">
		<?php if(is_array($data)): foreach($data as $key=>$udf_control_vo): ?><label>
				<input name="udf_field_<?php echo ($id); ?>" class="hidden ace" type="radio" value="<?php echo ($key); ?>" <?php if(in_array(($key), is_array($val)?$val:explode(',',$val))): ?>checked<?php endif; ?>>
				<input disabled="disabled" name="disabled_udf_field_<?php echo ($id); ?>" class="ace" type="radio" value="<?php echo ($key); ?>" <?php if(in_array(($key), is_array($val)?$val:explode(',',$val))): ?>checked<?php endif; ?>>
				<span class="lbl">&nbsp;<?php echo ($udf_control_vo); ?></span></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
	</div>
	<?php else: ?>
	<div class="form-inline form-control-static">
		<?php if(is_array($data)): foreach($data as $key=>$udf_control_vo): ?><label>
				<input name="udf_field_<?php echo ($id); ?>" class="ace" type="radio" value="<?php echo ($key); ?>" <?php if(in_array(($key), is_array($val)?$val:explode(',',$val))): ?>checked<?php endif; ?>>
				<span class="lbl">&nbsp;<?php echo ($udf_control_vo); ?></span> </label>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
	</div><?php endif; ?>