<?php $title = 'Job Application|EgGaming';
$js = array('apply.js','enhancement2.js');
 ?>

<?php include_once('header.inc');?>


<body id="applyForm">
  
  <!--  <nav><a href="./index.php">Home</a>&nbsp; &nbsp;<a href="./jobs.php">Position Description</a>&nbsp; &nbsp;<a href="./apply.php">Job Application</a>&nbsp; &nbsp;<a href="./about.php">About Us</a>&nbsp; &nbsp;<a href="./enhancements2.php">Enhancements2</a></nav>
-->
<?php include_once('menu.inc');?>
    <h1>JOB APPLICATION</h1>
<h3><em>Please fill the following form with exact details.</em></h3>
<form novalidate="novalidate" id="apply" action="./processEOI.php" method="post">
<section><fieldset><legend><strong>Personal Information</strong> *</legend>
<p>First Name <input maxlength="20" id="firstname" name="firstname" pattern="^[a-zA-Z\s]{1,20}" required="required" size="20" type="text" >   &nbsp;   Last Name <input id="lastname" maxlength="20" name="lastname" pattern="^[a-zA-Z ]{1,20}" required="required" size="20" type="text"></p>
<p>Date of Birth&nbsp;<input id="dob" name="dob" pattern="\d{1,2}/\d{1,2}/\d{4}" required="required" size="12" type="text" placeholder="dd/mm/yyyy" ><span id="doberror">*Applicant needs to be between 15 & 80 years old to apply</span></p>
</fieldset><fieldset><legend><strong>Gender</strong> *</legend>
<p><input type="radio" id="male" value="Male" name="male">Male&nbsp;<input name="female" id="female" type="radio" value="Female" >Female&nbsp;<input id="other" name="other" type="radio" value="other" >Other</p>
</fieldset><fieldset><legend><strong> Location</strong> * </legend>
<ul>
<li>Address&nbsp;<input maxlength="40" id="address" name="address" pattern="[A-Za-z0-9\s]{1,40}" required="required" size="40" type="text" ></li>
<li>Suburb/ Town&nbsp;<input maxlength="40" id="suburb" name="town" pattern="^[a-zA-Z]{1,10}" required="required" size="40" type="text" ></li>
<li>State&nbsp;<select id="state" name="state" required="required">
<option value="">Please Select</option> 
<option id="state_sel" value="VIC">VIC</option>
<option id="state_sel" value="NSW">NSW</option>
<option id="state_sel" value="QLD">QLD</option>
<option id="state_sel" value="NT">NT</option>
<option id="state_sel" value="WA">WA</option>
<option id="state_sel" value="SA">SA</option>
<option id="state_sel" value="TAS">TAS</option>
<option id="state_sel" value="ACT">ACT</option>
</select></li>

<li>Postcode&nbsp;<input maxlength="4" id="postcode" name="postcode" pattern="[0-9]{4}" type="tel" required="required" size="4"/><span id="stateerror">*State and postcode must match</span></li>
<li>E-mail
<p><input name="email" id="email" required="required" size="30" type="email" value="" placeholder="ex: myname@example.com" >
</li>
<li>Phone Number&nbsp;<input name="phone" id="phone" pattern="[0-9\s]{8,12}" required="required" size="12" type="tel" />
</ul>
</fieldset><fieldset><legend><strong> Job Details</strong> * </legend>
<p><label for="jobID">Job Reference Number</label><input maxlength="5" id="jobID" name="jobID" pattern="[A-Za-z0-9]{5}" required="required" size="5" type="text" /></p>
<p>Relevant Skill(s)</p>

<p><input name="skill1" type="checkbox" value="Java" id="java">Java  &nbsp; 
	<input id="linux" name="skill2" type="checkbox" value="Linux">Linux &nbsp;
	 <input id="html" name="skill3" type="checkbox" value="HTML">HTML &nbsp;
	  <input id="windows" name="skill4" type="checkbox" value="Windows"> Windows &nbsp;
	   <input id="javascript" name="skill5" type="checkbox" value="JavaScript">JavaScript &nbsp; 
	   <input name="skill6" type="checkbox" id="mac" value="Mac">Mac&nbsp; 
	   <input id="php" name="skill7" type="checkbox" value="PHP">PHP&nbsp; 
	   <input id="c" name="skill8" type="checkbox" value="C++">C++&nbsp; 
	   <input id="css" name="skill9" type="checkbox" value="CSS">CSS
	   <input id="otherskill" name="skill10" type="checkbox" value="other">Other</p>


  <p>Other skills(optional):</p>
<p><textarea id="otherskilltext" cols="30" name="otherskilltext" rows="3" placeholder=""></textarea><span id="othererror">*If select Other, please do not leave blank!</span></p>
</fieldset></section>
<!--<button id="submit">APPLY</button-->



<a><input type="submit" name="submit" value="APPLY" ></a>
</form>








<?php
include_once 'footer.inc';

?>