<div class="wrap">
  <img src="https://cdn.howuku.com/images/logo.svg" width="200px">
  <h1>Free heatmap, recording and analytics tool for your WordPress sites.</h1>

  <h2>1. Register an account with Howuku in 1 min</h2>
  <a class="button button-primary" href="https://app.howuku.com/sign-up/basic" target="_blank">
    Get Started For FREE
  </a><br><br>
  <span>No credit card needed</span><br><br>

  <h2>2. Already have a Howuku account?</h2>
  <span>Find your tracking code in <a href="https://app.howuku.com/" target="_blank">Howuku Dashboard</a>, then copy & paste your tracking code below.</span>
  <form action="options.php" method="post">
    <?php
      settings_fields( 'howuku-options' );
      do_settings_sections( 'howuku' );
     ?>
     <table class="form-table">
        <tr valign="top">
        <td style="margin:0;padding:0;">
          <textarea placeholder="Your unique Howuku tracking code goes here!" name="howuku_tracking_script" rows="8" cols="80"><?php echo esc_attr( get_option('howuku_tracking_script') ); ?></textarea>
        </td>
        </tr>
    </table>
     <?php submit_button ( 'Save tracking code' ); ?>
  </form>

  <h2>3. Watch real-time heatmaps & visitor insights!</h2>
  <a class="button button-primary" href="https://app.howuku.com/" target="_blank">
    Go to Howuku Dashboard
  </a>
</div>