<div class="events index">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Diary Admin');?></h2>
	<table>
		<?php foreach ($events as $event): ?>
			<tr>
			<td><?php echo h($event['Event']['date']); ?> &nbsp;</td>
			<td><?php if($event['Event']['showTime']) {echo h($event['Event']['time']);} ?> &nbsp;</td>
			<td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $event['Event']['venue']); ?> &nbsp;</td>
			<td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $event['Event']['description']); ?> &nbsp;</td>
			<td class="actions">
				<?php echo $this->Form->postLink(__('Copy'), array('action' => 'copy', $event['Event']['id']), null, __('Are you sure you want to copy this event?')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete this event?')); ?>
			</td>
			</tr>
		<?php endforeach; ?>
		<?php unset($event); ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('BCA Online'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__("Add Event"), array('action'=>'add')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__("Admin Dashboard"), array('controller'=>'Users', 'action'=>'dashboard', 'admin' => true)); ?> </li> -->
		<li><?php echo $this->Html->link(__("Members Area"), array('controller'=>'Users', 'action'=>'members_area', 'admin' => false)); ?> </li>
	</ul>
</div>
