<?php if (!defined('THINK_PATH')) exit();?><div class="page-header clearfix">
	<h1 class="col-sm-8"><?php echo ($name); ?></h1>
	<div class="col-sm-4 search_box">
		<form name="form_search" id="form_search" method="post" class="pull-right">
			<div class="input-group col-20">
				<input  class="form-control" type="text" name="keyword" id="keyword"/>
				<div class="input-group-btn">
					<a class="btn btn-sm btn-info" onclick="submit_search();"><i class="fa fa-search" ></i></a>
					<a class="btn btn-sm btn-success" onclick="toggle_adv_search();"><i id="toggle_adv_search_icon" class="fa fa-chevron-down bigger-125"></i></a>
				</div>
			</div>
		</form>
	</div>
</div>