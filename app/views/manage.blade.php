@extends('master')

@section('content')
	<h1>Manage your feeds</h1>
	<a href="#" id="feed_add" class="btn">Add a new feed</a>
	
	<table class="table table-hover">
	<thead>
		<tr>
			<td>Name</td>
			<td>Url</td>
			<td>Section</td>
			<td>Action</td>
		</tr>
	</thead>
	
	<tbody>
	<?php foreach($feeds as $feed): ?>
		<tr>
			<td><?php echo $feed->name; ?></td>
			<td><?php echo $feed->url; ?></td>
			<td><?php echo $feed->getSection(); ?></td>
			<td>
				<a href="<?=url('#feed-edit')?>" onclick="return feedEdit(<?=$feed->id;?>)" class="btn">Edit</a>
				<?=link_to('feed/delete/'.$feed->id, 'Delete', array('class' => 'btn btn-danger'));?>
			</td>
		</tr>
    <?php endforeach; ?>
	</tbody>
	</table>
	
	<h2>Sections</h2>
	<a href="#" id="section_add" class="btn">Add a new section</a>
	
	<table class="table table-hover">
	<thead>
		<tr>
			<td>Name</td>
			<td>Action</td>
		</tr>
	</thead>
	
	<tbody>
	<?php foreach($sections as $section): ?>
		<tr>
			<td><?php echo $section->name; ?></td>
			<td>
				<a href="<?=url('#section-edit')?>" onclick="return sectionEdit(<?=$section->id;?>)" class="btn">Edit</a>
				<?=link_to('section/delete/'.$section->id, 'Delete', array('class' => 'btn btn-danger'));?>
			</td>
		</tr>
    <?php endforeach; ?>
	</tbody>
	</table>
	
	<div id="feed-edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Feed edit" aria-hidden="true">
	</div>
	
	<div id="section-edit" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="Section edit" aria-hidden="true">
		
	</div>
@stop