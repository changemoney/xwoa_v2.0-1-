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
					
	<div id="cal">
		<div id="top" class="operate panel panel-default">
			<div class="panel-body">
				<div class="pull-left">
					<a id="panel" class="btn btn-sm btn-primary"></a>
					<a onclick="pushBtm('MU');" class="btn btn-sm btn-primary"><i class="fa fa-chevron-left"></i></a>
					<a onclick="pushBtm('MD');" class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></a>
					<a onclick="pushBtm('');" class="btn btn-sm btn-primary">今天</a>
					<input type="text" name="start_date" id="start_date" style="display:none">
					<input type="text" name="end_date" id="end_date" style="display:none">
				</div>
				<div class="pull-right">
					<a onclick="day_view();" class="btn btn-sm btn-primary">日视图</a>
					<a onclick="add();" class="btn btn-sm btn-primary">新建</a>
				</div>
			</div>
		</div>
		<form method="post" action="" name="CLD">
			<div style="display:none">
				<font>公历
					<select id="year" onchange=changeCld() name=SY>
						<script language=JavaScript>
							for ( i = 1900; i < 2050; i++)
								document.write('<option>' + i)
						</script>
					</select>年
					<select id="month" onchange=changeCld() name=SM>
						<script language=JavaScript>
							for ( i = 1; i < 13; i++)
								document.write('<option>' + i)
						</script>
					</select>月</font><font id="GZ"></font>
			</div>
			<div style="height:760px;">
				<div class="mv-container">
					<table class="mv-daynames-table" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<th title="周日" class="mv-dayname">周日</th>
								<th title="周一" class="mv-dayname">周一</th>
								<th title="周二" class="mv-dayname">周二</th>
								<th title="周三" class="mv-dayname">周三</th>
								<th title="周四" class="mv-dayname">周四</th>
								<th title="周五" class="mv-dayname">周五</th>
								<th title="周六" class="mv-dayname">周六</th>
							</tr>
						</tbody>
					</table>
					<div class="mv-event-container" id="mvEventContainer">
						<div class="month-row" style="top: 0%; height: 17.66%;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle   "><span class="left" id="SD0"></span><span class="pull-right hidden-xs" id="LD0"></span></td>
										<td class="st-dtitle  "><span class="left" id="SD1"></span><span class="pull-right hidden-xs" id="LD1"></span></td>
										<td class="st-dtitle  "><span class="left" id="SD2"></span><span class="pull-right hidden-xs" id="LD2"></span></td>
										<td class="st-dtitle  "><span class="left" id="SD3"></span><span class="pull-right hidden-xs" id="LD3"></span></td>
										<td class="st-dtitle "><span class="left" id="SD4"></span><span class="pull-right hidden-xs" id="LD4"></span></td>
										<td class="st-dtitle "><span class="left" id="SD5"></span><span class="pull-right hidden-xs" id="LD5"></span></td>
										<td class="st-dtitle "><span class="left" id="SD6"></span><span class="pull-right hidden-xs" id="LD6"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL0"></ul></td>
										<td class="st-c "><ul id="UL1"></ul></td>
										<td class="st-c "><ul id="UL2"></ul></td>
										<td class="st-c "><ul id="UL3"></ul></td>
										<td class="st-c "><ul id="UL4"></ul></td>
										<td class="st-c "><ul id="UL5"></ul></td>
										<td class="st-c "><ul id="UL6"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top: 16.6%; height: 17.66%;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD7"></span><span class="pull-right hidden-xs" id="LD7"></span></td>
										<td class="st-dtitle"><span class="left" id="SD8"></span><span class="pull-right hidden-xs" id="LD8"></span></td>
										<td class="st-dtitle"><span class="left" id="SD9"></span><span class="pull-right hidden-xs" id="LD9"></span></td>
										<td class="st-dtitle"><span class="left" id="SD10"></span><span class="pull-right hidden-xs" id="LD10"></span></td>
										<td class="st-dtitle"><span class="left" id="SD11"></span><span class="pull-right hidden-xs" id="LD11"></span></td>
										<td class="st-dtitle"><span class="left" id="SD12"></span><span class="pull-right hidden-xs" id="LD12"></span></td>
										<td class="st-dtitle"><span class="left" id="SD13"></span><span class="pull-right hidden-xs" id="LD13"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL7"></ul></td>
										<td class="st-c "><ul id="UL8"></ul></td>
										<td class="st-c "><ul id="UL9"></ul></td>
										<td class="st-c "><ul id="UL10"></ul></td>
										<td class="st-c "><ul id="UL11"></ul></td>
										<td class="st-c "><ul id="UL12"></ul></td>
										<td class="st-c "><ul id="UL13"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top: 33.33%; height: 17.66%;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD14"></span><span class="pull-right hidden-xs" id="LD14"></span></td>
										<td class="st-dtitle"><span class="left" id="SD15"></span><span class="pull-right hidden-xs" id="LD15"></span></td>
										<td class="st-dtitle"><span class="left" id="SD16"></span><span class="pull-right hidden-xs" id="LD16"></span></td>
										<td class="st-dtitle"><span class="left" id="SD17"></span><span class="pull-right hidden-xs" id="LD17"></span></td>
										<td class="st-dtitle"><span class="left" id="SD18"></span><span class="pull-right hidden-xs" id="LD18"></span></td>
										<td class="st-dtitle"><span class="left" id="SD19"></span><span class="pull-right hidden-xs" id="LD19"></span></td>
										<td class="st-dtitle"><span class="left" id="SD20"></span><span class="pull-right hidden-xs" id="LD20"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL14"></ul></td>
										<td class="st-c "><ul id="UL15"></ul></td>
										<td class="st-c "><ul id="UL16"></ul></td>
										<td class="st-c "><ul id="UL17"></ul></td>
										<td class="st-c "><ul id="UL18"></ul></td>
										<td class="st-c "><ul id="UL19"></ul></td>
										<td class="st-c "><ul id="UL20"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top: 50%; height: 17.66%;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD21"></span><span class="pull-right hidden-xs" id="LD21"></span></td>
										<td class="st-dtitle"><span class="left" id="SD22"></span><span class="pull-right hidden-xs" id="LD22"></span></td>
										<td class="st-dtitle"><span class="left" id="SD23"></span><span class="pull-right hidden-xs" id="LD23"></span></td>
										<td class="st-dtitle"><span class="left" id="SD24"></span><span class="pull-right hidden-xs" id="LD24"></span></td>
										<td class="st-dtitle"><span class="left" id="SD25"></span><span class="pull-right hidden-xs" id="LD25"></span></td>
										<td class="st-dtitle"><span class="left" id="SD26"></span><span class="pull-right hidden-xs" id="LD26"></span></td>
										<td class="st-dtitle"><span class="left" id="SD27"></span><span class="pull-right hidden-xs" id="LD27"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL21"></ul></td>
										<td class="st-c "><ul id="UL22"></ul></td>
										<td class="st-c "><ul id="UL23"></ul></td>
										<td class="st-c "><ul id="UL24"></ul></td>
										<td class="st-c "><ul id="UL25"></ul></td>
										<td class="st-c "><ul id="UL26"></ul></td>
										<td class="st-c "><ul id="UL27"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top: 66.66%;height:17.66%;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD28"></span><span class="pull-right hidden-xs" id="LD28"></span></td>
										<td class="st-dtitle"><span class="left" id="SD29"></span><span class="pull-right hidden-xs" id="LD29"></span></td>
										<td class="st-dtitle"><span class="left" id="SD30"></span><span class="pull-right hidden-xs" id="LD30"></span></td>
										<td class="st-dtitle"><span class="left" id="SD31"></span><span class="pull-right hidden-xs" id="LD31"></span></td>
										<td class="st-dtitle"><span class="left" id="SD32"></span><span class="pull-right hidden-xs" id="LD32"></span></td>
										<td class="st-dtitle"><span class="left" id="SD33"></span><span class="pull-right hidden-xs" id="LD33"></span></td>
										<td class="st-dtitle"><span class="left" id="SD34"></span><span class="pull-right hidden-xs" id="LD34"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL28"></ul></td>
										<td class="st-c "><ul id="UL29"></ul></td>
										<td class="st-c "><ul id="UL30"></ul></td>
										<td class="st-c "><ul id="UL31"></ul></td>
										<td class="st-c "><ul id="UL32"></ul></td>
										<td class="st-c "><ul id="UL33"></ul></td>
										<td class="st-c "><ul id="UL34"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="month-row" style="top: 83.33%; bottom: 0px;">
							<table class="st-bg-table" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-bg ">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
										<td class="st-bg">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table class="st-grid" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td class="st-dtitle "><span class="left" id="SD35"></span><span class="pull-right hidden-xs" id="LD35"></span></td>
										<td class="st-dtitle"><span class="left" id="SD36"></span><span class="pull-right hidden-xs" id="LD36"></span></td>
										<td class="st-dtitle"><span class="left" id="SD37"></span><span class="pull-right hidden-xs" id="LD37"></span></td>
										<td class="st-dtitle"><span class="left" id="SD38"></span><span class="pull-right hidden-xs" id="LD38"></span></td>
										<td class="st-dtitle"><span class="left" id="SD39"></span><span class="pull-right hidden-xs" id="LD39"></span></td>
										<td class="st-dtitle"><span class="left" id="SD40"></span><span class="pull-right hidden-xs" id="LD40"></span></td>
										<td class="st-dtitle"><span class="left" id="SD41"></span><span class="pull-right hidden-xs" id="LD41"></span></td>
									</tr>
									<tr>
										<td class="st-c "><ul id="UL35"></ul></td>
										<td class="st-c "><ul id="UL36"></ul></td>
										<td class="st-c "><ul id="UL37"></ul></td>
										<td class="st-c "><ul id="UL38"></ul></td>
										<td class="st-c "><ul id="UL39"></ul></td>
										<td class="st-c "><ul id="UL40"></ul></td>
										<td class="st-c "><ul id="UL41"></ul></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div><div id="dialog2"></div>

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
		
	<script type="text/javascript" src="/Public/Ins/js/plugins/calendar/calendar.js"></script>
	<script type="text/javascript">
		function showdata() {
			y = $("#year").val();
			m = $("#month").val();
			$("#panel").html(y + "年" + m + "月");
			start_date1 = $("#UL0").attr("class").substr(4);
			end_date1 = $("#UL41").attr("class").substr(4);
			$.getJSON("<?php echo U('json');?>", {
				start_date : start_date1,
				end_date : end_date1
			}, function(data) {
				count = 0;
				prev_date = '';
				$(".mv-container ul").html("");
				if (data != null) {
					$.each(data, function(i) {
						html = '<li id=li_' + data[i].id + ' style=background-color:' + schedule_bg(data[i].priority) + ">";
						html += '<a id=' + data[i].id + ' class="event_msg" title="' + data[i].name + '">';
						html += data[i].name;
						html += ' </a>';
						html += "</li>";
						if (prev_date == data[i].start_time.substr(0, 10)) {
							count++;
							if (count == 4) {
								$("ul.div_" + data[i].start_time.substr(0, 10)).append('<li class=\"all\">显示全部...</li>');
							}
						}
						prev_date = data[i].start_time;
						$("ul.div_" + data[i].start_time.substr(0, 10)).append(html);
					});
				}
			});
		}


		$(document).ready(function() {
			initial();
			set_return_url();

			$(document).on("click", "a.event_msg", (function() {
				var msg_list = "";
				current = $(this).attr('id');
				$("a#" + current).parent().parent().find('a.event_msg').each(function() {
					msg_list += $(this).attr("id") + "|";
				});
				winopen("<?php echo U('read');?>?id=" + $(this).attr('id') + "&list=" + msg_list, 560, 470);
			}));
			$("#dialog2").mouseleave(function() {
				$("#dialog2").hide();
			});
			$(document).on("click", "li.all", function() {
				//$("li.all").on("click",function(){
				$(this).parent().find("li.all").hide();
				html = $(this).parent().html();
				$(this).parent().find("li.all").show();
				html = $("<ol></ol>").html(html);
				$("#dialog2").html(html);
				$("#dialog2").show();

				$("#dialog2").css("left", $(this).parents("ul").offset().left - $(".Schedule").offset().left - 8);
				$("#dialog2").css("top", $(this).parents("ul").offset().top - $(".Schedule").offset().top - 8);
			});
		});
		function add() {
			window.open("<?php echo U('add');?>", "_self");
		}

		function month_view() {
			window.open('<?php echo U('index');?>', "_self");
		}

		function day_view() {
			window.open("<?php echo U('day_view');?>", "_self");
		}
	</script>

	</body>
</html>