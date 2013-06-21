<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Feed <?=!empty($feed->id) ? 'Edit' : 'Creation'?></h3>
</div>
<div class="modal-body" id="feed-edit-form">
<?php echo Form::open(array('url' => 'feed/'.(!empty($feed->id) ? 'edit/'.$feed->id : 'add'))); ?>
	Name: <?php echo Form::text('name', $feed->name, array('class' => 'span7')); ?><br />
	Url: <?php echo Form::text('url', $feed->url, array('class' => 'span7')); ?><br />
	Section: <select name="section" class="span7">
		<option value="">Base section</option>
		<?php foreach($sections as $section) { echo "
    	<option value=\"".$section->id."\"".($section->id == $feed->section_id?' selected="selected"':null).">".$section->name."</option>";
		} ?>
	</select><br />
	<?php echo Form::token(); ?>
	<?php echo Form::submit('Save', array('class' => 'btn'))?>
<?php echo Form::close(); ?>
</div>