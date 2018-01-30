<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php echo __('Password Set / Reset Failed'); ?></h2>

<p>Your password update failed.</p>
<ul>
  <li>It is possible that the link in the email you were sent has expired. The link lasts for 1 hour. 
  If you think yours has expired please <?php echo $this->Html->link('Request Another', array('action' => 'request_login_details'));?>.</li>
  <li>Another possibility is that the link was split over two lines in your email and you are missing the second line. 
  Try to create a single link by copying both lines to your browser's address bar.</li> 
</ul>
<p>&nbsp;</p>
<p>If you are continuing to have problems please contact the Members' Area Administrator.</p>  

</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Return'), array('action' => 'index'));?></li>
    </ul>
</div>
