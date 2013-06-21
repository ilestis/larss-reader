<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Larss - a Laravel RSS Reader</title>
	<link rel="stylesheet" href="/packages/bootstrap/css/bootstrap.css" type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/assets/css/larss.css" type='text/css'>
	<script type="text/javascript" src="/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/assets/js/larss.js"></script>
	<script type="text/javascript" src="/packages/bootstrap/js/bootstrap.js"></script>
	<?php foreach($js as $script): ?>
	<script type="text/javascript" src="/assets/js/<?php echo $script; ?>.js"></script>
	<?php endforeach; ?>
</head>

<body>
	<header class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
			</div>
			<div class="span10">
				<div class="navbar">
		          <div class="navbar-inner">
		            <div class="container">
		             
		          
						<ul class="nav">
			                
			                <?php if($show_mark && count($entries) > 0) { ?><li><a href="#" id="markAsRead" onclick="return markAsRead('<?=$parent->type()?>', <?=$parent->id?>);">Mark as read</a></li><?php } ?>
			                <li> <span class="navbar-text" id="updating"></span></li>
			                <li>
						</ul>
					</div>
		          </div>
		        </div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
			
				
				<nav class="navigation">
					<h3 class="muted"><a href="/" class="brand">Larss</a></h3>
				
					<p><a href="#" id="refresh-btn" class="btn"><i class="icon-refresh"></i> Refresh</a></p>
					<ul class="nav nav-list">
						<li><?php echo link_to('/', 'Home')?></li>
						<li><a href="<?=url('all')?>">All unread items (<span id="nav-all-count"><?=$unread_items?></span>)</a></li>
					<?php 
					foreach($navmenu as $section_id => $data) { 
						if(!empty($section_id)) { ?>
							<li>
								<a href="<?=url('all/section/'.$section_id)?>" class="section <?=$data['section']->navClass()?>" id="nav-section-link-<?=$section_id?>"><i class="icon-folder-open">
									</i> <?=$data['section']->name?> (<span id="nav-section-count-<?=$section_id?>"><?=$data['section']->unreadCount()?></span>)
								</a> 
								<ul class="nav nav-list">
						<?php }
						foreach($data['feeds'] as $feed) {?>
							<li><a href="<?=url('all/feed/'.$feed->id)?>" class="<?=$feed->navClass()?>" id="nav-feed-link-<?=$feed->id?>">
								<?=$feed->name?> (<span id="nav-feed-count-<?=$feed->id?>"><?=$feed->unreadCount()?></span>)
							</a></li>
						<?php } ?>
						<?php if(!empty($section_id)) { ?></ul></li><?php } ?>
					<?php } ?>
					</ul>
					
					<p><?php echo link_to('manage', 'Manage feeds')?></p>
				</nav>
			</div>
			<section class="span10">
				@yield('content')
			</section>
		</div>
		<div class="row-fluid">
			<div class="span2"><br /></div>
			<footer class="span10">
				&copy 2013 - <a href="https://github.com/ilestis/Larss-reader" target="_blank">Larss</a>
			</footer>
		</div>
	</div>
	
	
</body>

</html>