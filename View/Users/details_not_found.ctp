<div class="users form">

<h2><?php echo __('Details Not Found');?></h2>


<p>Sorry, your email address was not found.</p>
<p>There are several possible reasons for this:</p>
<ul>
    <li>We do not have your email address. When you renewed either directly with BCA or via your club did you provide an email address?</li>
    <li>Joint members may be recorded with their partner's email address.</li>
    <li>You have supplied more than one email address to BCA/BCRA.</li>
    <li>Your club has not passed your email address on.</li>
    <li>Your email address has changed.</li>
    <li>There has been a typing error somewhere along the line.</li>
</ul>
<p>&nbsp;</p>
<h3>What To Do</h3>
<ol>
    <li>If you are a member of BCA via your club (CIM), please check that they have your correct email address and that they have passed it on to the BCA.</li>
    <li>If you are a joint member, try your partner's email address.</li>
    <li>Try all the email addresses you might have given BCA/BCRA one at a time.</li>
    <li><p>Otherwise, or in addition, you can send an email to the <?php echo $this->Html->link('BCA Online Administrator', 'http://british-caving.org.uk/wiki3/doku.php?id=about:contact_bca'); ?> giving your:</p>
    <ul>
        <li>Email address.</li>
        <li>Full name.</li>
        <li>BCA membership number (found on your membership card).</li>
        <li>Full address.</li>
    </ul>
    </li>
</ol>
<p>&nbsp;</p>
<p><strong>Please note your request will be dealt with by an unpaid volunteer, so don't expect an instant response.</strong></p>  
    
</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Continue'), array('action' => 'login')); ?> </li>
    </ul>
</div>