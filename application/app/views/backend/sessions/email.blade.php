<html>
<head>
<style type='text/css'>
	h3 { font-size: 15px; color: #333; margin-top: 30px; }
	h4 { color: #333; margin-top: 30px; }
</style>
</head>
<body>
	<table style='width:100%;border-collapse:collapse'><tbody><tr><td style='font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5'>
	        	<div style='border:1px solid #cccccc;border-radius:5px;padding:20px'>
	        	<img src="{{ URL::to('/frontend/img/logo.png') }}">
		<h3 style='margin-bottom:0;margin-top:0'>     
			Hello {{ $username }} , 
		</h3>
	           <p>You have request  a new password for your Account. </p>
	           <p> New password: <b>{{ $password }}</b></p>
	           <p> Please login with your new password using the following link.</p>
	           {{ $link }}
	           <p>With Regards,<br>
		Administrator.</p>
	        	</div>
	</table>	                  
</body>
</html>