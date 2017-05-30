<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/Public/Ins/css/animate.css" rel="stylesheet">
		<link href="/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<link href="/Public/Ins/css/plugins/gritter/jquery.gritter.css" />
		<?php if(!empty($plugin["jquery-ui"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" />
	<link rel="stylesheet" href="/Public/Ins/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet"><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/date-time/bootstrap-datetimepicker.css" /><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'><?php endif; ?>


		<link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />
		<link href="/Public/Ins/css/style.css" rel="stylesheet">
		<link href="/Public/Ins/css/xiaowei.css" rel="stylesheet">
		
	</head>
	<script type="text/javascript">
	var upload_url = "<?php echo U('upload');?>";
	var del_url = "<?php echo U('del_file');?>";
	var app_path = "";
	var cookie_prefix = "<?php echo C('COOKIE_PREFIX');?>";
	var link_select = "<?php echo U('Popup/link_select');?>";
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?2a935166b0c9b73fef3c8bae58b95fe4";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})(); 
</script>
	<body class="<?php echo (CONTROLLER_NAME); ?>">
		<div class="shade"></div>
		<div class="form-group hidden" id="img_upload_container">
			<div id="img_upload">上传</div>
		</div>
		<nav class="navbar navbar-default row" role="navigation" id="top_menu">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-6">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-lg"></i>
				</button>
				<div class="hidden-xs">
					&nbsp;
				</div>
				<a href="<?php echo U('index/index');?>" class="navbar-brand"><?php echo get_system_config("system_name");?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-6">
				<ul class="nav navbar-nav navbar-right">
					<?php if(is_array($top_menu)): foreach($top_menu as $key=>$top_menu_vo): ?><a class="nav-app" href="#" url="<?php echo (get_nav_url($top_menu_vo['url'])); ?>" node="<?php echo ($top_menu_vo["id"]); ?>" onclick="click_top_menu(this)" ><i class="<?php echo ($top_menu_vo["icon"]); ?>"></i><?php echo ($top_menu_vo["name"]); ?>
						<?php if(!empty($badge_count[$top_menu_vo['id']])){ $html=''; $html='<span class="label label-danger">'.$badge_count[$top_menu_vo['id']].'</span>'; echo $html; } ?></a><?php endforeach; endif; ?>
					<a class="nav-app btn-danger" href="<?php echo U('public/logout');?>"><i class="fa fa-sign-out"></i>退出</a>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		<div id="wrapper">
			<div class="sidebar navbar-static-side" id="sidebar">
				<div id="user_info" class="text-center hidden-xs"  >
					<span >当前用户：<?php echo (session('user_name')); ?></span>
				</div>
				<div id="nav_head" class="text-center" onclick="toggle_left_menu()">
					<span class="menu-text"><?php echo ($top_menu_name); ?></span>
					<b id="left_menu_icon" class="fa fa-angle-down pull-right"></b>
				</div>
				<?php echo W('Sidebar/left',array('tree'=>$left_menu,'badge_count'=>$badge_count));?>
			</div>
			<div id="page-wrapper" class="gray-bg">
				<div class="row wrapper border-bottom gray-bg">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="fa fa-home home-icon"></i>
								<a href="/">Home</a>
							</li>
							<li>
								<?php echo ($top_menu_name); ?>
							</li>
						</ul><!-- .breadcrumb -->
					</div>
				</div>
				<div class="wrapper wrapper-content">
					
	<?php echo W('PageHeader/adv_search',array('name'=>$folder_name,'search'=>'M'));?>
	<form method="post" name="form_adv_search" id="form_adv_search">
		<div class="adv_search panel panel-default  hidden"  id="adv_search">
			<div class="panel-heading">
				<div class="row">
					<h4 class="col-xs-6">高级搜索</h4>
					<div class="col-xs-6 text-right">
						<a  class="btn btn-sm btn-info" onclick="submit_adv_search();">搜索</a>
						<a  class="btn btn-sm " onclick="close_adv_search();">关闭</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_name">标题：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_name" name="li_name" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="li_content">内容：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="li_content" name="li_content" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="eq_user_name">登录人：</label>
					<div class="col-sm-8">
						<input  class="form-control" type="text" id="eq_user_name" name="eq_user_name" >
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-4 control-label" for="be_create_time">登录时间：</label>
					<div class="col-sm-8">
						<div class="input-daterange input-group" >
							<input type="text" class="input-sm form-control text-center" name="be_create_time" readonly="readonly"/>
							<span class="input-group-addon">-</span>
							<input type="text" class="input-sm form-control text-center" name="en_create_time" readonly="readonly"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="space-8"></div>
	<div class="operate panel panel-default">
		<div class="panel-body">
			<div class="pull-left">
				<ul class="nav nav-pills">
					<li <?php if(($fid) == "all"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=all');?>">所有</a>
					</li>
					<li <?php if(($fid) == "no_finish"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=no_finish');?>">我未完成
						<?php if(!empty($no_finish_task_count)): ?><span class="badge badge-pink"><?php echo ($no_finish_task_count); ?></span><?php endif; ?></a>
					</li>
					<li <?php if(($fid) == "dept"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=dept');?>">部门任务
						<?php if(!empty($dept_task_count)): ?><span class="badge badge-pink"><?php echo ($dept_task_count); ?></span><?php endif; ?></a>
					</li>
					<li <?php if(($fid) == "no_assign"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=no_assign');?>" >不知让谁处理
						<?php if(!empty($no_assign_task_count)): ?><span class="badge badge-pink"><?php echo ($no_assign_task_count); ?></span><?php endif; ?></a>
					</li>					
					<li <?php if(($fid) == "finished"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=finished');?>">我已完成</a>
					</li>
					<li <?php if(($fid) == "my_task"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=my_task');?>">我发布的</a>
					</li>
					<li <?php if(($fid) == "my_assign"): ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('folder','fid=my_assign');?>">我指派的</a>
					</li>				
				</ul>
			</div>
			<?php if($auth['write']): ?><div class="pull-right">
					<a class="btn btn-sm btn-primary" onclick="add()">发布任务</a>
				</div><?php endif; ?>
		</div>
	</div>
	<div class="ul_table ul_table_responsive">
		<ul>
			<li class="thead">
				<div class="pull-left">
					<span class="col-8 ">编号</span>
					<span class="col-8 ">发起人</span>
				</div>
				<div class="pull-right">
					<span class="col-20 autocut">指派给</span>
					<span class="col-12">发起时间</span>
					<span class="col-12">期望完成时间</span>
					<span class="col-6 ">状态</span>
					<span class="col-6 text-center">操作</span>
				</div>
				<div class="auto autocut">
					标题
				</div>
			</li>
			<?php if(empty($list)): ?><li class="no-data">
					没找到数据
				</li>
				<?php else: ?>
				<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li class="tbody">
						<div class="pull-left">
							<span class="col-8 "><?php echo ($vo["task_no"]); ?></span>
							<span class="col-8 "><?php echo ($vo["user_name"]); ?></span>
						</div>
						<div class="pull-right">
							<span class="col-20 autocut">&nbsp;<?php echo (show_contact($vo["executor"])); ?></span>
							<span class="col-12"><?php echo (to_date($vo["create_time"],'Y-m-d H:i')); ?>&nbsp;</span>
							<span class="col-12"><?php echo (substr($vo["expected_time"],0,16)); ?>&nbsp;</span>
							<span class="col-6"><?php echo (task_status($vo["status"])); ?>&nbsp;</span>
							<span class="col-6 text-center">
								<?php if(($vo["status"] < 30) and ($vo["user_id"] == $user_id)): ?><a href="<?php echo U('edit','id='.$vo['id']);?>">修改</a>&nbsp;<a href="<?php echo U('del','id='.$vo['id']);?>">删除</a><?php endif; ?></span>
						</div>
						<div class="auto autocut">
							<a href="<?php echo U('read','id='.$vo['id']);?>"><?php echo ($vo["name"]); ?></a>
						</div>
					</li><?php endforeach; endif; ?>
				<div class="pagination">
					<?php echo ($page); ?>
				</div><?php endif; ?>
		</ul>
	</div>

				</div>
			</div>
		</div>
		<iframe src="<?php echo U('push/client');?>" class="push" id="push"></iframe>
		<script src="/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="/Public/Ins/js/bootstrap-suggest.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="/Public/Ins/js/inspinia.js"></script>
		<script src="/Public/Ins/js/common.js"></script>
		<script src="/Public/Ins/js/plugins/pace/pace.min.js"></script>
		<?php if(!empty($plugin["jquery-ui"])): ?><script src="/Public/Ins/js/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="/Public/Ins/js/plugins/nouslider/jquery.nouislider.min.js"></script><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><script src="/Public/Ins/js/plugins/date-time/moment-with-locales.js"></script>
	<script src="/Public/Ins/js/plugins/date-time/bootstrap-datetimepicker.js"></script><?php endif; ?>

<?php if(!empty($plugin["uploader"])): ?><script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script>
	<script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["editor"])): if(empty($plugin["uploader"])): ?><script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script><?php endif; ?>
	<script type="text/javascript" src="/Public/Ins/js/plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/Public/Ins/js/plugins/tinymce/tinymce.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><script src="/Public/Ins/js/plugins/fullcalendar/moment.min.js"></script>
	<script src="/Public/Ins/js/plugins/fullcalendar/fullcalendar.min.js"></script><?php endif; ?>

<?php if(!empty($plugin["baidu_map"])): ?><script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EE6745c36d96321e90b7015f3de4a4ee"></script><?php endif; ?>

<script src="/Public/Ins/js/plugins/toastr/toastr.min.js"></script>
<script src="/Public/Ins/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="/Public/Ins/js/plugins/bootbox/bootbox.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!empty($plugin["date"])): ?>$('.input-date').datetimepicker({
			format : 'YYYY-MM-DD',
			locale : 'zh-cn',
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$(".input-daterange input").datetimepicker({
			format : "YYYY-MM-DD",
			locale : 'zh-cn',
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$("#start_date").on("dp.change", function(e) {
			if ($("#end_date").length > 0) {
				$('#end_date').data("DateTimePicker").minDate(e.date);
			}
		});

		$("#end_date").on("dp.change", function(e) {
			if ($("#start_date").length > 0) {
				$('#start_date').data("DateTimePicker").maxDate(e.date);
			}
		});

		$(".input-date-time").datetimepicker({
			format : 'YYYY-MM-DD HH:mm',
			locale : 'zh-cn',
			sideBySide : true,
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});<?php endif; ?>
	}); 
</script>
		
	<script type="text/javascript">
		function add() {
			window.open("<?php echo U('add');?>", "_self");
		}

		$(document).ready(function() {
			set_return_url();
		});
	</script>

	</body>
</html>