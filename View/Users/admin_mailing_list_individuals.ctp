<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Mailing List - Newsletter Individuals');?></h2>

<p>This is the list of current CIMs and DIMs who have opted-in to the Newsletter.</p>
<p>Cut and paste into a text file ready to be imported into phpList.</p>
<p>&nbsp;</p>

<?php echo "Number of records = ". count($users); ?>

<textarea readonly rows="30">
email,foreign key,FULLNAME
<?php foreach ($users as $user):

    echo h($user['User']['email']).",".h($user['User']['bca_no']).",".h($user['User']['full_name'])."\n";

endforeach; ?>
</textarea>

</div>

<?php echo $this->element('mailing_list_actions'); ?>
