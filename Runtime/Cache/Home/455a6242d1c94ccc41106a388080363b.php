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
					
	<?php echo W('PageHeader/search',array('name'=>'站内消息','search'=>'M'));?>
	<div class="space-8"></div>
	<div class="operate panel panel-default">
		<div class="panel-body">
			<div class="pull-left">

			</div>
			<div class="pull-right">
				<a class="btn btn-sm btn-primary" onclick="add()">发送消息</a>
			</div>
		</div>
	</div>

	<div class="ul_table">
		<hr>
		<?php if(empty($list)): ?>没找到数据
			<?php else: ?>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="row">
					<div class="col-xs-1">
						<div class="user">
							<?php if(($vo["sender_id"]) == $owner_id): ?><img class="img-thumbnail" src="/<?php echo (get_emp_pic($vo["receiver_id"])); ?>"  onerror="javascript:this.src='/Uploads/emp_pic/no_avatar.jpg'"/>
								<?php else: ?>
								<img class="img-thumbnail" src="/<?php echo (get_emp_pic($vo["sender_id"])); ?>"  onerror="javascript:this.src='/Uploads/emp_pic/no_avatar.jpg'"/><?php endif; ?>
						</div>
					</div>
					<div class="col-xs-11">
						<div class="<?php if(($vo["unread"]) > "0"): ?>bold<?php endif; ?>">
							<?php if(($vo["sender_id"]) == $owner_id): ?>发给 <?php echo ($vo["receiver_name"]); ?>：<span><?php echo (to_date($vo["create_time"],'Y-m-d H:i')); ?></span>								
								<?php else: ?>
								<?php echo ($vo["sender_name"]); ?>：<span><?php echo (to_date($vo["create_time"],'Y-m-d')); ?></span><?php endif; ?>
						</div>
						<div class="<?php if(($vo["unread"]) > "0"): ?>bold<?php endif; ?>">
							<?php echo ($vo["content"]); ?>
						</div>
						<p>							
							<span class="pull-right">
								<?php if(($vo["sender_id"]) == $owner_id): ?><a href="<?php echo U('read','reply_id='.$vo['receiver_id']);?>">共<?php echo ($vo["count"]); ?>条对话</a>
									<a onclick="reply_message(<?php echo ($vo["receiver_id"]); ?>)">回复</a>
									<a onclick="del_message(<?php echo ($vo["receiver_id"]); ?>)">删除</a>
								<?php else: ?>
									<a href="<?php echo U('read','reply_id='.$vo['sender_id']);?>">共<?php echo ($vo["count"]); ?>条对话</a>
									<a onclick="reply_message(<?php echo ($vo["sender_id"]); ?>)">回复</a>
									<a onclick="del_message(<?php echo ($vo["sender_id"]); ?>)">删除</a><?php endif; ?>
							</span>
						</p>
					</div>
				</div>
				<hr><?php endforeach; endif; ?>
			<div class="pagination">
				<?php echo ($page); ?>
			</div><?php endif; ?>
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
		function del_message($reply_id) {
			ui_confirm('确定要删除吗?', function() {
				sendAjax("<?php echo U('del','type=dialogue');?>", 'reply_id=' + $reply_id, function(data) {
					if (data.status) {
						ui_alert(data.info, function() {
							location.reload(true);
						});
					}
				});
			});
		}

		function reply_message($reply_id) {
			winopen(fix_url("<?php echo U('reply');?>?reply_id=" + $reply_id), 700, 430);
		}

		function add() {
			window.open("<?php echo U('add','fid='.$folder='');?>", "_self");
		}

		$(document).ready(function() {
			set_return_url();
		});
	</script>

	</body>
</html>