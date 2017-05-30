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
					
	<?php echo W('PageHeader/simple',array('name'=>'写邮件','search'=>'N'));?>
	<div class="operate panel panel-default">
		<div class="panel-body">
			<div class="left">
				<a class="btn btn-sm btn-primary" onclick="send(true);">发送</a>
				<a class="btn btn-sm btn-default" onclick="send(false);" >存草稿</a>
			</div>
		</div>
	</div>
	<form class="well form-horizontal" method='post' id="form_send" name="form_send" enctype="multipart/form-data">
		<input type="hidden" id="ajax" name="ajax" value="0">
		<input type="hidden" id="to" name="to"/>
		<input type="hidden" id="cc" name="cc"/>
		<input type="hidden" id="bcc" name="bcc"/>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="recever">收件人*：</label>
			<div class="col-sm-10">
				<div id="recever" class="inputbox">
					<a class="pull-right btn btn-link text-center" onclick="popup_contact();"> <i class="fa fa-user"></i> </a>
					<div class="wrap" >
						<span class="address_list"></span>
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
			<div class="col-sm-2 control-label">
				<label for="carbon_copy"> 抄送：</label>
				<a onclick="toggle_bcc();"><i id="toggle_bcc_icon" class="fa fa-chevron-down"></i></a>
			</div>
			<div class="col-sm-10">
				<div id="carbon_copy" class="inputbox">
					<div class="wrap" >
						<span class="address_list"></span>
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

		<div id="bcc_wrap" class="form-group hidden">
			<label class="col-sm-2 control-label" for="blind_carbon_copy"> 密送： </label>
			<div class="col-sm-10">
				<div id="blind_carbon_copy" class="inputbox">
					<div class="wrap" >
						<span class="address_list"></span>
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
			<label class="col-sm-2 control-label" for="mail_title"> 标题*： </label>
			<div class="col-sm-10">
				<input class="form-control"  type="text" name="name" id="mail_title"  check="require" msg="请输入标题">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" > 附件： </label>
			<div class="col-sm-10">
				<?php echo W('FileUpload/add');?>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-xs-12">
				<textarea  class="editor" id="content" name="content" class="col-xs-12"></textarea>
			</div>
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
		$(document).ready(function() {
			/*单击删除已选联系人*/
			$(document).on("click", ".inputbox .address_list a.del", function() {
				$(this).parent().parent().remove();
			});

			/* 查找联系人input 功能*/
			$(document).on("click", ".inputbox .search li", function() {
				name = $(this).text().replace(/<.*>/, '');
				email = $(this).find("a").attr("title");
				html = conv_inputbox_item(name, email);

				inputbox = $(this).parents(".inputbox");
				inputbox.find("span.address_list").append(html);
				inputbox.find("input.letter").val("");
				inputbox.find(".search ul").html("");
				inputbox.find(".search ul").hide();
				inputbox.find(".search").hide();
			});
			
			$(".inputbox .letter").blur(function(e) {
				email = $(this).val();
				if (validate(email, 'email')) {
					name = email;
					html = conv_inputbox_item(name, email);
					$(this).parents(".inputbox").find("span.address_list").append(html);
					$(this).val("");
				} else {
					$(this).val("");
					//ui_error("邮件格式错误");
					return false;
				}
			});
			/* 查找联系人input 功能*/
			$(".inputbox .letter").keyup(function(e) {
				switch(e.keyCode) {
				case 40:
					var $curr = $(this).parents(".inputbox").find(".search li.active").next();
					if ($curr.html() != null) {
						$(this).parents(".inputbox").find(".search li").removeClass("active");
						$curr.addClass("active");
					}
					break;
				case 38:
					var $curr = $(this).parents(".inputbox").find(".search li.active").prev();
					if ($curr.html() != null) {
						$(this).parents(".inputbox").find(".search li").removeClass("active");
						$curr.addClass("active");
					}
					break;
				case 13:
					if ($(this).parents(".inputbox").find(".search ul").html() != "") {
						name = $(".search li.active").text().replace(/<.*>/, '');
						email = $(".search li.active a").attr("title");
						html = conv_inputbox_item(name, email);
						$(this).parents(".inputbox").find("span.address_list").append(html);
						$(this).parents(".inputbox").find(".search ul").html("");
						$(this).val("");
						$(this).parents(".inputbox").find(".search ul").hide();
					} else {
						email = $(this).val();
						if (validate(email, 'email')) {
							name = email;
							html = conv_inputbox_item(name, email);
							$(this).parents(".inputbox").find("span.address_list").append(html);
							$(this).val("");
						} else {
							ui_error("邮件格式错误");
							return false;
						}
					}
					break;
				default:
					var search = $(this).parents(".inputbox").find("div.search ul");
					if ($(this).val().length > 1) {
						$.getJSON("<?php echo U('popup/json','type=all');?>", {
							key : $(this).val()
						}, function(json) {
							if (json != "") {
								if (json.length > 0) {
									search.html("");
									$.each(json, function(i) {
										search.append('<li><a title="' + json[i].email + '">' + json[i].name + '&lt;' + json[i].email + '&gt;</a></li>');
									});
									search.children("li:first").addClass("active");
									search.show();
								}
							} else {
								search.html("");
								search.hide();
							}
						});
					} else {
						search.hide();
					}
				}
			});
		});

		function send(flag) {
			$("#to").val("");
			$("#recever .address_list span").each(function() {
				$("#to").val($("#to").val() + $(this).find("b").text() + '|' + $(this).attr("data") + '|' + $(this).attr("id") + ";");
			});

			$("#cc").val("");
			$("#carbon_copy .address_list span").each(function() {
				$("#cc").val($("#cc").val() + $(this).find("b").text() + '|' + $(this).attr("data") + '|' + $(this).attr("id") + ";");
			});

			$("#bcc").val("");
			$("#blind_carbon_copy .address_list span").each(function() {
				$("#bcc").val($("#bcc").val() + $(this).find("b").text() + '|' + $(this).attr("data") + '|' + $(this).attr("id") + ";");
			});

			if (($("#to").val().indexOf("@") < 1) && ($("#to").val().indexOf("dept_") < 1)) {
				ui_error("请选择收件人");
				$("#recever .letter").focus();
				return false;
			}
			if (flag) {
				sendForm("form_send", "<?php echo U('send');?>");

					// var vars=$("#form_send").serialize();
			// sendAjax("<?php echo U('send');?>",vars,function(data){
				// if(data.status){
					// ui_alert(data.info,function() {
						// location.href="<?php echo U('index');?>";
						// }
						// );
				// }else{
					// ui_error(data.info);
				// }		
			// })
			} else {
				sendForm("form_send", "<?php echo U('save_darft');?>");
					// var vars=$("#form_send").serialize();
			// sendAjax("<?php echo U('save_darft');?>",vars,function(data){
				// if(data.status){
					// ui_alert(data.info,function() {
						// location.href="<?php echo U('index');?>";
						// }
						// );
				// }else{
					// ui_error(data.info);
				// }		
			// })
				
			}
		}

		function toggle_bcc() {
			if ($("#bcc_wrap").attr("class").indexOf("hidden") < 0) {
				$("#bcc_wrap").addClass("hidden");
				$("#toggle_bcc_icon").addClass("fa-chevron-down");
				$("#toggle_bcc_icon").removeClass("fa-chevron-up");
			} else {
				$("#bcc_wrap").removeClass("hidden");
				$("#toggle_bcc_icon").addClass("fa-chevron-up");
				$("#toggle_bcc_icon").removeClass("fa-chevron-down");
			}
		}

		function popup_contact() {
			winopen("<?php echo U('popup/contact');?>",560, 470);
		}
	</script>

	</body>
</html>