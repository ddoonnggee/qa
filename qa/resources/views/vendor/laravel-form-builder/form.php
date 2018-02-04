<?php if ($showStart): ?>
    <?= Form::open($formOptions) ?>
<?php endif; ?>

<?php if ($showFields): ?>
    <?php foreach ($fields as $field): ?>
    	<?php if( ! in_array($field->getName(), $exclude) ) { ?>
        	<?= $field->render() ?>
		<?php } ?>
    <?php endforeach; ?>
<?php endif; ?>
<?= Form::submit('',['class'=>'hide','id'=>'submitButton']); ?>
<?php if ($showEnd): ?>
    <?= Form::close() ?>
<?php endif; ?>
