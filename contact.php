<?php 
print'
<h1>Kontakt</h1>
<div id="contact">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44364.93374853171!2d16.318190319416537!3d45.97508705209179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4766129fa65dd24b%3A0x673d979f1a26cba7!2sVinkovec!5e0!3m2!1sen!2shr!4v1606166611125!5m2!1sen!2shr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <form action="http://work2.eburza.hr/pwa/responzive-page/send-contact.php" id="contact_form" name="contact_form" method="POST">
        <label for="fname">Ime *</label>
        <input type="text" id="fname" name="firstname" placeholder="Vaše ime.." required>

        <label for="lname">Prezime *</label>
        <input type="text" id="lname" name="lastname" placeholder="Vaše prezime.." required>
        
        <label for="lname">Vaš e-mail *</label>
        <input type="email" id="email" name="email" placeholder="Vaš e-mail.." required>

        <label for="country">Država</label>
        <select id="country" name="country">
          <option value="">Odaberi</option>
          <option value="BE">Belgija</option>
          <option value="HR" selected>Hrvatska</option>
          <option value="LU">Luksemburg</option>
          <option value="HU">Mađarska</option>
        </select>

        <label for="subject">Tema</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

        <input type="submit" value="Submit">
    </form>
</div>';
?>