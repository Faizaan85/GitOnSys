<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> <?php echo $title ?></title>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vue.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/master.css">
	</head>
	<body>
		<div id="vue-app">
			<div id="bag" v-bind:class="{burst:ended}"></div>
			<div id="bag-health">
				<div v-bind:style="{width:health+'%'}"></div>
			</div>
			<div id="controls">
				<button v-on:click="punch" v-show="!ended">Punch</button>
				<button v-on:click="restart">Restart</button>
			</div>
		</div>
		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	</body>
</html>
