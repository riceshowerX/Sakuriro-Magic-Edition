<?php 
/**
 * Template Name: 登录页面模版
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php if(!is_user_logged_in()){ ?>
      <div class="ex-login">
        <div class="ex-login-title">
          <p><img src="<?php echo iro_opt('unlisted_avatar'); ?>"></p>
        </div>

        <form id="login-form" method="post">
          <?php wp_nonce_field( 'ajax-login-nonce', 'login-nonce' ); ?>
          <p><input type="text" name="log" id="log" value="<?php echo esc_attr($_POST['log'] ?? null); ?>" size="25" placeholder="<?php _e('Name', 'sakurairo'); ?>" required /></p>
          <p><input type="password" name="pwd" id="pwd" value="<?php echo esc_attr($_POST['pwd'] ?? null); ?>" size="25" placeholder="<?php _e('Password', 'sakurairo'); ?>" required /></p>
          <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember Me', 'sakurairo' ); ?></label></p>
          <input type="hidden" name="redirect_to" value="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" />
          <button type="submit" class="button login-button"><?php _e('Login', 'sakurairo'); ?></button>
        </form>

        <div class="ex-new-account" style="padding: 0;">
          <p><?php _e('Please register first! Register first, plz!', 'sakurairo'); ?></p>
          <p>
            <a href="<?php echo iro_opt('exregister_url') ?? bloginfo('url'); ?>" target="_blank"><?php _e('Register', 'sakurairo'); ?></a> |
            <a href="<?php echo site_url(); ?>/wp-login.php?action=lostpassword" target="_blank"><?php _e('Lost your password?', 'sakurairo'); ?></a>
          </p>
        </div>

        <div id="login-message"></div>
      </div>

      <?php if (iro_opt('captcha_select') === 'iro_captcha') {?>
        <script>
          if(!'get_captcha' in window){
          var get_captcha = ele=>fetch("<?php echo rest_url('sakura/v1/captcha/create')?>")
                              .then(async res=>{
                                if (res.ok){
                                  const json = await res.json();
                                  ele.src = json['data'];
                                  document.querySelector("input[name='timestamp']").value = json["time"];
                                  document.querySelector("input[name='id']").value = json["id"];
                                }else{
                                  //TODO: 错误处理
                                }
                              });			
          const captcha = document.getElementById("captchaimg");
          if(captcha){
            captcha.addEventListener("click",e=>get_captcha(e.target));
            get_captcha(captcha);
          }
          }
        </script>
      <?php } ?>

      <script>
        jQuery(document).ready(function($) {
          $('#login-form').on('submit', function(event) {
            event.preventDefault(); // 阻止默认表单提交

            var form = $(this);
            var formData = form.serialize();
            var nonce = $('input[name="login-nonce"]').val();

            $.ajax({
              url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
              type: 'POST',
              data: {
                action: 'ajax_login',
                nonce: nonce,
                formData: formData
              },
              beforeSend: function() {
                // 显示加载动画或进度条
                $('#login-message').html('<p>正在登录...</p>');
              },
              success: function(response) {
                if (response.success) {
                  // 登录成功，跳转到指定页面
                  window.location.href = '<?php echo esc_url( home_url() ); ?>';
                } else {
                  // 登录失败，显示错误信息
                  $('#login-message').html('<div class="error">' + response.data + '</div>');
                }
              },
              error: function() {
                // 处理错误
                $('#login-message').html('<div class="error">登录失败，请稍后再试。</div>');
              }
            });
          });
        });
      </script>

    <?php } else {
      echo Exuser_center();
    } ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();