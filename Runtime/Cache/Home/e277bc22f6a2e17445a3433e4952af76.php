<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		<script src="/Public/Ins/js/plugins/socket.io/socket.io.js"></script>
		<script src="/Public/Ins/js/jquery-2.1.1.js"></script>

		<script type="text/javascript">
			function get_push() {
				$.getJSON("<?php echo U('push/server');?>", function(result) {
					if (result.status) {
						$content = eval('(' + result.data.data + ')');
						window.parent.push_info($content);
					}
					if (result.status > 0) {
						get_push();
					}
				});
			}

			$(document).ready(function() {
				get_push();
				// 连接服务端
				var socket = io('http://' + document.domain + ':2120');
				// 连接后登录
				socket.on('connect', function() {
					socket.emit('login', '<?php echo get_user_id();?>');
				});
				// 后端推送来消息时
				socket.on('new_msg', function(msg) {
					get_push();
				});
			});
		</script>
	</head>
	<body></body>
</html>