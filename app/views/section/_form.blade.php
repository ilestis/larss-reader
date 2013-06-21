<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Section <?=!empty($section->id) ? 'Edit' : 'Creation'?></h3>
</div>
<div class="modal-body" id="section-edit-form">
<?php echo Form::open(array('url' => 'section/'.(!empty($$section->id) ? 'edit/'.$$section->id : 'add'))); ?>
	<?php echo Form::text('name', $section->name, array('class' => 'span3')); ?>
	<?php echo Form::token(); ?>
	<?php echo Form::submit('Save', array('class' => 'btn'))?>
<?php echo Form::close(); ?>
</div>