@extends('master')

@section('content')
	<h1><?php echo $parent->name; ?></h1>
	
	
	<?php foreach($entries as $entry): ?>
	<div class="entry-container" id="entry-<?php echo $entry->id; ?>">
		<div class="entry-main <?php if($entry->status == '1'): ?> read <?php endif; ?>">
			<div class="entry-date"><?php echo $entry->elapsed(); ?></div>
			<h2 class="entry-title"><a href="<?php echo $entry->link; ?>" target="_blank"><?php echo $entry->title; ?></a></h2>
			<div class="entry-body"><?php echo $entry->content; ?></div>
		</div>
	</div>
    <?php endforeach; ?>
    <?php if(count($entries) == 0): ?>
    <p class="muted">Currently no new entries to read.</p>
    <?php endif; ?>

@stop