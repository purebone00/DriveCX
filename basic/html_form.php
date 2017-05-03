<?php function html_form_code() { ?>  <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post">
    <p>
      First Name (required) <br/>
      <input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value=" <?php ( isset( $_POST["cf-fname"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) ?>" size="40" />
    </p>
    <p>
      Last Name (required) <br/>
      <input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="<?php ( isset( $_POST["cf-lname"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) ?>" size="40" />
    </p>
    <p>
      Your Email (required) <br/>
      <input type="email" name="cf-email" value="<?php ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) ?>" size="40" />
    </p>
    <p>
      Subject (required) <br/>
      <input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="<?php ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) ?>" size="40" />
    </p>
    <p>
      Your Message (required) <br/>
      <textarea rows="10" cols="35" name="cf-message"><?php ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) ?></textarea>
    </p>
    <p><input type="submit" name="cf-submitted" value="Send"></p>
  </form>  <?php } ?>