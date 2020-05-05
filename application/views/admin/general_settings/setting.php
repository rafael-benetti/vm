<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default color-palette-bo">
            <div class="card-header">
              <div class="d-inline-block">
                  <h3 class="card-title"> <i class="fa fa-plus"></i>
                  General Settings </h3>
              </div>
            </div>
            <div class="card-body">   
                 <!-- For Messages -->
                <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open_multipart(base_url('admin/general_settings/add')); ?>	
                <!-- Nav tabs -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#main" role="tab" aria-controls="main" aria-selected="true">General Setting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#email" role="tab" aria-controls="email" aria-selected="false">Email Setting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#reCAPTCHA" role="tab" aria-controls="reCAPTCHA" aria-selected="false">Google reCAPTCHA</a>
                  </li>
                </ul>

                 <!-- Tab panes -->
                <div class="tab-content">

                    <!-- General Setting -->
                    <div role="tabpanel" class="tab-pane active" id="main">
                        <div class="form-group">
                            <label class="control-label">Favicon (25*25)</label><br/>
                            <?php if(!empty($general_settings['favicon'])): ?>
                               <p><img src="<?= base_url($general_settings['favicon']); ?>" class="favicon"></p>
                           <?php endif; ?>
                           <input type="file" name="favicon" accept=".png, .jpg, .jpeg, .gif, .svg">
                           <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                           <input type="hidden" name="old_favicon" value="<?php echo html_escape($general_settings['favicon']); ?>">
                       </div>
                       <div class="form-group">
                           <label class="control-label">Logo</label><br/>
                           <?php if(!empty($general_settings['logo'])): ?>
                               <p><img src="<?= base_url($general_settings['logo']); ?>" class="logo" width="150"></p>
                           <?php endif; ?>
                           <input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif, .svg">
                           <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                           <input type="hidden" name="old_logo" value="<?php echo html_escape($general_settings['logo']); ?>">
                       </div>
                        <div class="form-group">
                            <label class="control-label">Application Name</label>
                            <input type="text" class="form-control" name="application_name" placeholder="application name" value="<?php echo html_escape($general_settings['application_name']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Timezone</label>
                            <input type="text" class="form-control" name="timezone" placeholder="timezone"
                            value="<?php echo html_escape($general_settings['timezone']); ?>">
                            <a href="http://php.net/manual/en/timezones.php" target="_blank">Timeszones</a>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Currency</label>
                            <input type="text" class="form-control" name="currency" placeholder="currency"
                            value="<?php echo html_escape($general_settings['currency']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Copyright</label>
                            <input type="text" class="form-control" name="copyright"
                            placeholder="Copyright"
                            value="<?php echo html_escape($general_settings['copyright']); ?>">
                        </div>
                    </div>

                    <!-- Email Setting -->
                    <div role="tabpanel" class="tab-pane" id="email">
                        <div class="form-group">
                            <label class="control-label">Email From/ Reply to</label>
                            <input type="text" class="form-control" name="email_from" placeholder= "no-reply@domain.com" value="<?php echo html_escape($general_settings['email_from']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">SMTP Host</label>
                            <input type="text" class="form-control" name="smtp_host" placeholder="SMTP Host" value="<?php echo html_escape($general_settings['smtp_host']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">SMTP Port</label>
                            <input type="text" class="form-control" name="smtp_port" placeholder="SMTP Port" value="<?php echo html_escape($general_settings['smtp_port']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">SMTP User</label>
                            <input type="text" class="form-control" name="smtp_user" placeholder="SMTP Email" value="<?php echo html_escape($general_settings['smtp_user']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">SMTP Password</label>
                            <input type="password" class="form-control" name="smtp_pass" placeholder="SMTP Password" value="<?php echo html_escape($general_settings['smtp_pass']); ?>">
                        </div>
                    </div>

                    <!-- Social Media Setting -->
                    <div role="tabpanel" class="tab-pane" id="social">
                        <div class="form-group">
                            <label class="control-label">Facebook</label>
                            <input type="text" class="form-control" name="facebook_link" placeholder="" value="<?php echo html_escape($general_settings['facebook_link']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Twitter</label>
                            <input type="text" class="form-control" name="twitter_link" placeholder="" value="<?php echo html_escape($general_settings['twitter_link']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Google Plus</label>
                            <input type="text" class="form-control" name="google_link" placeholder="" value="<?php echo html_escape($general_settings['google_link']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Youtube</label>
                            <input type="text" class="form-control" name="youtube_link" placeholder="" value="<?php echo html_escape($general_settings['youtube_link']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">LinkedIn</label>
                            <input type="text" class="form-control" name="linkedin_link" placeholder="" value="<?php echo html_escape($general_settings['linkedin_link']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram_link" placeholder="" value="<?php echo html_escape($general_settings['instagram_link']); ?>">
                        </div>
                    </div>

                    <!-- Google reCAPTCHA Setting-->
                    <div role="tabpanel" class="tab-pane" id="reCAPTCHA">
                        <div class="form-group">
                            <label class="control-label">Site Key</label>
                            <input type="text" class="form-control" name="recaptcha_site_key" placeholder="Site Key" value="<?php echo ($general_settings['recaptcha_site_key']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Secret Key</label>
                            <input type="text" class="form-control" name="recaptcha_secret_key" placeholder="Secret Key" value="<?php echo ($general_settings['recaptcha_secret_key']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Language</label>
                            <input type="text" class="form-control" name="recaptcha_lang" placeholder="Language code" value="<?php echo ($general_settings['recaptcha_lang']); ?>">
                            <a href="https://developers.google.com/recaptcha/docs/language" target="_blank">https://developers.google.com/recaptcha/docs/language</a>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <input type="submit" name="submit" value="Save Changes" class="btn btn-primary pull-right">
                </div>	
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>

<script>
    $("#setting").addClass('active');
    $('#myTabs a').click(function (e) {
     e.preventDefault()
     $(this).tab('show')
 })
</script>
