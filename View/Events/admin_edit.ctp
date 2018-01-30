<div class="events form">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Update Event');?></h2>

<?php echo $this->Form->create('Event');?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date');
		echo $this->Form->input('time');
		echo $this->Form->input('showTime');
		echo $this->Form->input('venue', array('label' => 'Event'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('BCA Online'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__("Cancel Update"), array('action'=>'index')); ?> </li>
	</ul>
</div>