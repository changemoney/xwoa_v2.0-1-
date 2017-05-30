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
					
	<?php echo W('PageHeader/simple',array('name'=>'编辑流程：'.$vo['name']));?>
	<form method='post' id="form_data" class="well form-horizontal">
		<input type="hidden" id="id" name="id" value="<?php echo ($vo["id"]); ?>">
		<input type="hidden" id="opmode" name="opmode" value="edit">
		<input type="hidden" id="ajax" name="ajax" value="1">
		<input type="hidden" id="confirm" name="confirm" >
		<input type="hidden" id="confirm_name" name="confirm_name" >
		<input type="hidden" id="consult" name="consult" >
		<input type="hidden" id="consult_name" name="consult_name">
		<input type="hidden" id="refer" name="refer">
		<input type="hidden" id="refer_name" name="refer_name" >
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="name">名称*：</label>
			<div class="col-sm-8">
				<input  value="<?php echo ($vo["name"]); ?>" class="form-control" type="text" id="name" name="name" check="require" msg="请输入姓名">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="short">简称*：</label>
			<div class="col-sm-8">
				<input  value="<?php echo ($vo["short"]); ?>" class="form-control" type="text" id="short" name="short" check="require" msg="请输入简称">
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="doc_no_format">编号规则*：</label>
			<div class="col-sm-8">
				<input value="<?php echo ($vo["doc_no_format"]); ?>" class="form-control" type="text" id="doc_no_format" name="doc_no_format" check="require" msg="请输入编号规则">
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="group">分组：</label>
			<div class="col-sm-8">
				<select class="form-control" name="tag" id="tag">
					<?php echo fill_option($tag_list);?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="type">审批步骤：</label>
			<div class="col-sm-10">
				<div id="confirm_wrap" class="inputbox">
					<a class="pull-right btn btn-link text-center" onclick="popup_flow();"> <i class="fa fa-user"></i> </a>
					<div class="wrap" >
						<span class="address_list"><?php echo ($vo["confirm_name"]); ?></span>
						<span class="text" >
							<input class="letter" type="text"  >
						</span>
					</div>
					<div class="search dropdown ">
						<ul class="dropdown-menu"></ul>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="type">抄送步骤：</label>
			<div class="col-sm-10">
				<div id="consult_wrap" class="inputbox">
					<a class="pull-right btn btn-link text-center" onclick="popup_flow();"> <i class="fa fa-user"></i> </a>
					<div class="wrap" >
						<span class="address_list"><?php echo ($vo["consult_name"]); ?></span>
						<span class="text" >
							<input class="letter" type="text"  >
						</span>
					</div>
					<div class="search dropdown">
						<ul class="dropdown-menu"></ul>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group hidden">
			<label class="col-sm-2 control-label" for="type">抄送：</label>
			<div class="col-sm-10">
				<div id="refer_wrap" class="inputbox">
					<a class="pull-right btn btn-link text-center" onclick="popup_flow();"> <i class="fa fa-user"></i> </a>
					<div class="wrap" >
						<span class="address_list"><?php echo ($vo["refer_name"]); ?></span>
						<span class="text" >
							<input class="letter" type="text"  >
						</span>
					</div>
					<div class="search dropdown ">
						<ul class="dropdown-menu"></ul>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="request_duty">申请权限：</label>
			<div class="col-sm-8">
				<select class="form-control" name="request_duty" id="request_duty">
					<?php echo fill_option($duty_list);?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="report_duty">报告权限：</label>
			<div class="col-sm-8">
				<select class="form-control" name="report_duty" id="report_duty">
					<?php echo fill_option($duty_list);?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="sort">排序：</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="sort" name="sort" value="<?php echo ($vo["sort"]); ?>">
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="is_del">状态：</label>
			<div class="col-sm-8">
				<select class="form-control" name="is_del" id="is_del">
					<option value="0" >启用</option>
					<option value="1">禁用</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="is_lock">流程类型：</label>
			<div class="col-sm-8">
				<select class="form-control" name="is_lock" id="is_lock" type="select-one">
					<option value="0" >自由</option>
					<option value="1">固定</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="is_edit">审批人能否修改：</label>
			<div class="col-sm-8">
				<select class="form-control" name="is_edit" id="is_edit">
					<option value="0">不能修改</option>
					<option value="1">可以修改</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="udf_tpl">自定义模板：</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="udf_tpl" name="udf_tpl" value="<?php echo ($vo["udf_tpl"]); ?>">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="is_show">默认编辑器：</label>
			<div class="col-sm-8">
				<select class="form-control" name="is_show" id="is_show">
					<option value="1">显示</option>	
					<option value="0">不显示</option>					
				</select>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<div class="col-xs-12">
				<textarea  class="editor" id="content" name="content" style="width:100%;height:300px;"><?php echo ($vo["content"]); ?></textarea>
			</div>
		</div>
		<div class="action">
			<input class="btn btn-sm btn-primary" type="button" value="保存" onclick="save();">
			<input  class="btn btn-sm btn-default" type="button" value="取消" onclick="go_return_url();">
		</div>
	</form>

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
		function save() {
			$("#confirm").val("");
			$("#confirm_wrap  span.address_list span").each(function() {
				$("#confirm").val($("#confirm").val() + $(this).attr("data") + '|');
			});

			$("#confirm_name").val("");
			$("#confirm_name").val($("#confirm_wrap span.address_list").html());

			$("#consult").val("");
			$("#consult_wrap span.address_list span").each(function() {
				$("#consult").val($("#consult").val() + $(this).attr("data") + '|');
			});

			$("#consult_name").val("");
			$("#consult_name").val($("#consult_wrap span.address_list").html());

			$("#refer").val("");
			$("#refer_wrap span.address_list span").each(function() {
				$("#refer").val($("#refer").val() + $(this).attr("data") + '|');
			});

			$("#refer_name").val("");
			$("#refer_name").val($("#refer_wrap span.address_list").html());

			sendForm("form_data", "<?php echo U('save');?>", "<?php echo U('index');?>");
		}

		function popup_flow() {
			winopen("<?php echo U('popup/flow');?>", 560, 470);
		}


		$(document).ready(function() {
			$(document).on("dblclick", ".inputbox .address_list b", function() {
				$(this).parent().parent().remove();
			});

			$(document).on("click", ".inputbox .address_list a.del", function() {
				$(this).parent().parent().remove();
			});

			set_val("is_del", "<?php echo ($vo["is_del"]); ?>");
			set_val("is_edit", "<?php echo ($vo["is_edit"]); ?>");
			set_val("is_show", "<?php echo ($vo["is_show"]); ?>");
			set_val("tag", "<?php echo ($vo["tag"]); ?>");
			set_val("request_duty", "<?php echo ($vo["request_duty"]); ?>");
			set_val("report_duty", "<?php echo ($vo["report_duty"]); ?>");
			set_val("is_lock", "<?php echo ($vo["is_lock"]); ?>");
		});
	</script>

	</body>
</html>