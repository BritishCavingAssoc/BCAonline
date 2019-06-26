<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Mailing Lists');?></h2>

<p>Please select your mailing list from the menu.</p> 

</div>

<?php echo $this->element('mailing_list_actions'); ?>
