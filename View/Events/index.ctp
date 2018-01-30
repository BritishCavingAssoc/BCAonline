<div class="events index">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('BCA Diary');?></h2>
<h3><?php  echo __('Forthcoming Events');?></h3>
  <table>
    <?php foreach ($events as $event): ?>
      <tr>
      <td><?php echo h($event['Event']['date']); ?> &nbsp;</td>
      <td><?php if($event['Event']['showTime']) {echo h($event['Event']['time']);} ?> &nbsp;</td>
      <td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $event['Event']['venue']); ?> &nbsp;</td>
      <td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $event['Event']['description']); ?> &nbsp;</td>
      </tr>
    <?php endforeach; ?>
    <?php unset($event); ?>
  </table>
<h3><?php  echo __('Past Events');?></h3>
  <table>
    <?php foreach ($past_events as $past_event): ?>
      <tr>
      <td><?php echo h($past_event['Event']['date']); ?> &nbsp;</td>
      <td><?php if($past_event['Event']['showTime']) {echo h($past_event['Event']['time']);} ?> &nbsp;</td>
      <td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $past_event['Event']['venue']); ?> &nbsp;</td>
      <td><?php echo str_replace(array("\r\n", "\n", "\r"), '<br />', $past_event['Event']['description']); ?> &nbsp;</td>
      </tr>
    <?php endforeach; ?>
    <?php unset($past_event); ?>
  </table>
</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__("Members' Area"), array('controller'=>'Users', 'action'=>'members_area')); ?> </li>
    </ul>
</div>
