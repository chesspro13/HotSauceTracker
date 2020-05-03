<?php
	$headerOutput = '
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<div class="banner_container">
			<img src="/images/banner.jpg" alt="Not sauce" style="width:100%">
			<div class="header_text" id="site_name">
				"The Mauldin Hot.net"
			</div>
		</div>
		<div class="tab">
			<form action="/index.php" method="POST">
				<input class="tablinks" type="submit" name = "View" value="View">
				<input class="tablinks" type="submit" name = "Add" value="Add">
				<input class="tablinks" type="submit" name = "Share" value="Share">
				<input class="tablinks" type="submit" name = "Other" value="Other">
			</form>
		</div>';
	echo $headerOutput;
?>
