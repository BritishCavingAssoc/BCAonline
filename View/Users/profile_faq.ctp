<div class="users view">
<?php echo $this->Session->flash('auth'); ?>
<h2><?php  echo __('Profile Frequently Asked Questions (FAQ)');?></h2>

<h1>Q: The profiles don't look right. Who should I contact?</h1>
<p>A: If you feel there has been an error please contact the <a href='mailto:<?php echo "${membership_admin_email}?subject=A BCA Online question. (Ref: ${bca_no})"; ?>'>Membership Administrator</a>.</p>

<h1>Q: Why might I seeing more than one profile?</h1>
<p>A: There are several possible reasons:
<ul>
<li>The profile for your primary club, the club that paid your BCA membership, will have an insurance status of C/NC/STU or U18</li>
<li>The profiles for any other clubs you might belong to will have an insurance status of AN, indicating the club didn't pay for your BCA membership because it was paid for by another route, i.e. your primary club.</li>
<li>The profiles from previous years of clubs you didn't re-join. These will have an expiry date in the past.</li>
</ul>
</p>

<h1>Q: I have more than one current profile with insurance status that isn't AN. Is that OK?</h1>
<li>A: If you have more than one primary profile, i.e. with an insurance status of C/NC/STU or U18, which hasn't expired it indicates that you have paid by more than one route. Each payment route will create a profile. You should only pay once. If you think you have paid more than once, make sure the club(s) shown in your secondary profile(s) know that you have paid by another route and that they shouldn't pay again.</br>If you think you are owed any money please contact the <a href='mailto:<?php echo "${membership_admin_email}?subject=A BCA Online question. (Ref: ${bca_no})"; ?>'>Membership Administrator</a>. NB you must claim any overpayment, BCA is not able to spot and refund overpayments automatically.</li>
<li>Check the current profiles didn't expire last year and haven't been updated to lapsed yet. Profiles aren't lapsed until March.</li>
</ul>
</p>

<h1>Q: What do the Insurance Status Codes mean?</h1>
<p>A: The code will be one of the following:
<ul>
  <li>C - Caver. You contributed to the insurance scheme at the caver rate.</li>
  <li>NC - Non-Caver. You contributed to the insurance scheme at the non-caver rate.</li>
  <li>STU - Full time student. You contributed to the insurance scheme at the student rate.</li>
  <li>U18 - Under 18 years old. You contributed to the insurance scheme at the under 18 rate.</li>
  <li>AN - Another route. You contributed to the insurance scheme via another route.</li>
</ul>
</p>

<h1>Q: What do the Class Codes mean?</h1>
<p>A: There are many codes, please consult the table below. For example a DIM_BK_SD is a student direct individual member who also is a member of BCRA and receives a printed copy of Cave & Karst Science.</p>
<table>
<tr><th>First Part</th><th>Optionally Add</th></tr>
<tr>
  <td><ul>
    <li>CIM - Club Individual Member.</li>
  </ul></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><ul>
    <li>CIMP - CIM Plus Member (No longer offered).</li>
    <li>DIM - Direct Individual Member.</li>
    <li>DIMJ or DIM2 - Joint DIM Member.</li>
    <li>DIMH - Honorary DIM Member.</li>
    <li>DIMU18 - Under 18 DIM Member.</li>
  </ul></td>
  <td><ul>
    <li>B - BCRA Member</li>
    <li>K - Printed C&KS</li>
    <li>T - Non-caver</li>
    <li>SD - Student</li>
  </ul></td>
</tr>
<tr>
  <td><ul>
    <li>GRP - Group Member aka Club Member</li>
    <li>CCB - Constituent Caving Body</li>
    <li>RCC - Regional Caving Council</li>
    <li>ACB - Access Controlling Body</li>
    <li>ASM - Associate Member</li>
  </ul></td>
  <td><ul>
    <li>B - BCRA Member</li>
    <li>K - Printed C&KS</li>
    <li>S - Speleology opt-out</li>
    <li>A - Access Provider</li>
    <li>H - Hut Provider</li>
    <li>G10 - 4 to 10 members</li>
    <li>G20 - up to 20 members</li>
    <li>G30 - up to 30 members</li>
    <li>G40 - up to 40 members</li>
    <li>GL -  greater than 40 members</li>
  </ul></td>
</tr>
</table>

</div>
<div class="actions">
    <h3><?php echo __('BCA Online'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__("Return"), array('action'=>'view')); ?> </li>
    </ul>
</div>
