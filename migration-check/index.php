<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Drupal 7 to 8 Migration" />
<meta name="description" content="Drupal 7 to 8 upgrade is a complex but worthy move. However, we have made it easier for you to understand your needs better and upgrade to Drupal 8." />
<meta name="keywords" content="Drupal 7 to 8 upgrade, upgrade to drupal 8" />
    <link rel="shortcut icon" href="http://opensenselabs.com/core/misc/favicon.ico" type="image/vnd.microsoft.icon" />
    <title>Drupal 7 to 8 Migration</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,700" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4naEx29rUGwTN2n66mQ63thHUmlnpQ7l";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
		<style>
		.hasfile {
			color: #0071a5;
		}
    #banner-inner {
    padding-bottom: 100px;
  }
  #banner-inner .inner_banner h1 {
    font-size: 2rem;
}
.report {
  margin: auto;
}
.drupal-mig-icon {
      margin: 3em 0;
      width: 100%;
}
.button {
  font-size: 20px;
}
.off-canvas-list .right-submenu a {
    font-size: 1rem;
    font-weight: 400;
}
.drupal-mig-icon .column >div {
    text-align: center;
        font-size: 20px;
}
.drupal-mig-icon .column >div img {
  display: block;
        margin: 13px auto;
}
.text-link {
  color: #db8518;
  text-decoration: underline;
}
.step {
  font-size: 40px;
color: #ccc;
border: 2px solid #ccc;
width: 70px;
margin: 46px auto 20px;
height: 70px;
display: flex;
justify-content: center;
align-items: center;
border-radius: 50%;
}
.mig-step p, .migration-page .file-icon {
  font-size: 1.500rem;
  margin-bottom: 0;
}
small {
  display: block;
}
h4 span {
  font-weight: 300;
}
small span {
  color: #777;
font-size: 0.750rem;
}
		</style>
</head>

    <body>
      <div class="off-canvas-wrapper">
        <div class="off-canvas position-right" id="offCanvasRight1" data-off-canvas>
          <ul class="off-canvas-list vertical menu">
      <li class="menu-label"><a>Menu <button class="close-button" aria-label="Close menu" type="button" data-close="">
<span aria-hidden="true">×</span>
</button></a></li>
                  <li>
      <a href="/" data-drupal-link-system-path="<front>" class="is-active">Home</a>
            </li>
              <li>
      <a href="/about" data-drupal-link-system-path="node/1">About Us</a>
            </li>
              <li class="has-submenu">
      <a href="/services" data-drupal-link-system-path="services">Services</a>
                                <ul class="menu right-submenu vertical nested">
                  <li>
      <a href="/services/development" data-drupal-link-system-path="node/2">Development</a>
            </li>
              <li>
      <a href="/services/drupal-staff-augmentation" data-drupal-link-system-path="node/13">Drupal Staff Augmentation</a>
            </li>
              <li>
      <a href="/services/drupal-commerce" data-drupal-link-system-path="node/15">Drupal Commerce</a>
            </li>
              <li>
      <a href="/services/drupal-performance-tuning-optimisation" data-drupal-link-system-path="node/17">Performance Tuning &amp; Optimisation</a>
            </li>
              <li>
      <a href="/services/drupal-personalization-cro" data-drupal-link-system-path="node/18">Personalization &amp; CRO</a>
            </li>
              <li>
      <a href="/services/drupal-support-maintenance" data-drupal-link-system-path="node/18">Support &amp; Maintenance</a>
            </li>
              <li>
      <a href="/services/drupal-8-upgrade-migration" data-drupal-link-system-path="node/21">Drupal 8 Upgrade &amp; Migration</a>
            </li>
      </ul>

            </li>
      </ul>
        </div>
  <div class="off-canvas-content" data-off-canvas-content="">
    <div class="container">

      <section class="se-container">
  <section id="banner-inner" class="se-slope-n  parallax-container banner banner-blog">
    <article class="se-content-n">
      <div class="row">
        <div class="medium-12 column">

          <div class="banner-top">

          <a href="/">  <img class="logo" src="http://opensenselabs.com/themes/opensenselabs/images/logo.png" alt="Opensense labs, Drupal Development company"></a>

            <a data-toggle="offCanvasRight1" href="#"><img class="menu-button" src="images/menu.png" alt="Drupal 8 migration check"/></a>
          </div>
          <div class="medium-12 column">
            <div class="inner_banner text-center">
              <h1 class="text-center">Drupal 7 to Drupal 8 Upgrade compatibility check</h1>
              <p>Migrating from the D7 to the overhauled Drupal 8 is not simply an upgrade</p>

            </div>
          </div>
        </div>
      </div>
    </article>
    <div class="parallax"><img src="images/blogbanner.jpg" alt="migration check blog banner"/></div>
  </section>

<section class="migration-page top-40 bottom-120">
  <div class="row row-custom">
    <p class="text-left">With the improved performance,
      security, and mobile-dedication of Drupal 8, shift happens to be a bold move towards reinforced functionality.
    While the content, users, and other elements are easier to move over systematically, many other crucial actions that
    need to be taken are:</p>
    <div class="row small-up-1 medium-up-3 large-up-3 drupal-mig-icon">

      <div class="column">
          <div class="recreate">
            <img src="images/theme.png" alt="Drupal 8 migration check"/>
            Re-create the themes
          </div>
      </div>
      <div class="column">
          <div class="modules"><img src="images/module.png" alt="Drupal 8 migration check"/>Port/Rewrite modules</div>
      </div>
      <div class="column">
          <div class="views"><img src="images/reconfig.png" alt="migration check reconfiguration"/>Reconfigure views, and much more.</div>
      </div>
  </div>
  <p>The complexity of an upgrade depends on the complexity – and quality – of your existing Drupal 7 instance.
    We designed an estimation tool to help you understand your wants better. Drupal 8 upgrade estimation tool reduces manual
    audit effort to a huge extent and gives you a deep insight of a Drupal project with a key focus on providing a
    High-level man-hours estimation with a detailed break up of various steps of any Drupal 7 to Drupal 8 Upgrade.
  <br/><br/>You can have a peek into <a class="report text-link" href="/migration-report/techtud" target="_blank">our sample report</a> and see what the results will look like.</p>

    </div>
    <div class="line text-center">
        <img src="images/line.png" alt="Line">
    </div>
    <div class="row row-custom align-center mig-step">
      <div class="medium-6 columns text-center">
        <h4><span>Get Drupal 8 Upgrade report in</span><br>5 Minute</h4>
        <h5 class="step">1</h5>
        <p>Install Our Drupal 8 Upgrade <a href="https://www.drupal.org/project/d8_migration_check" target="_blank" class="text-link">Module</a></p>
        <small>Install Drupal 7 module on your website and visit <br><span>admin/config/d8_migration</span></small>
        <h5 class="step">2</h5>
        <p>Export JSON</p>
        <small>Export JSON file and save on your computer</small>
        <h5 class="step">3</h5>
      </div>
    </div>
      <div class="row row-custom json-up-form align-center">
    <div class="medium-5 columns text-center ">


      <section class="content">
        <form action="report.php" method="post" enctype="multipart/form-data">
        <div class="upload-json">
          <label for="fileToUpload" class="file-icon"><span>Upload</span> JSON </label>
          <small>Upload the JSON file exported in previous step</small>
          <input type="file" name="fileToUpload" id="fileToUpload" class="show-for-sr" required>
          <div class="filename"></div>
        </div>
				<span class="input input--akira">
          <input class="input__field input__field--akira" type="text" name="admin" required>
					<label class="input__label input__label--akira">
						<span class="input__label-content input__label-content--akira">Your Name</span>
					</label>
				</span>
				<span class="input input--akira">
          <input class="input__field input__field--akira" type="text" name="websitename" required>
					<label class="input__label input__label--akira" for="input-23">
						<span class="input__label-content input__label-content--akira">Website Name</span>
					</label>
				</span>
				<span class="input input--akira">

          <input class="input__field input__field--akira" type="url" name="url" required>
					<label class="input__label input__label--akira">
						<span class="input__label-content input__label-content--akira">URL of Drupal Website</span>
					</label>
				</span>
        <span class="input input--akira">
          <input class="input__field input__field--akira" type="email" name="email" required>
					<label class="input__label input__label--akira">
						<span class="input__label-content input__label-content--akira">Email ID</span>
					</label>
				</span>
        <span class="input input--akira">
					<input class="input__field input__field--akira" type="text">
          <input class="input__field input__field--akira" type="number" name="mobile">
					<label class="input__label input__label--akira">
						<span class="input__label-content input__label-content--akira">Phone</span>
					</label>
				</span>
        <div class="upload-btn top-40">
        <input type="hidden" name="priceph" value="35">
        <input class="button orange" type="submit" value="GET YOUR REPORT" name="submit">
      </div>

    </form>
			</section>
      </div>

    </div>

</section>







<footer id="footer" class="se-slope-n">
    <article class="se-content-n">
        <div class="row">
            <div class="medium-12 column">
                <div class="footer">

                    <div class="row small-up-1 medium-up-3 large-up-3">
                        <div class="column">
                            <h6>OUR SERVICES</h6>
                            <ul class="menu vertical">
                              <li><a href="/services/development">Development</a></li>
                              <li><a href="/services/drupal-staff-augmentation">Drupal Staff Augmentation</a></li>
                              <li><a href="/services/drupal-commerce">Drupal Commerce</a></li>
                              <li><a href="/services/drupal-performance-tuning-optimisation">Performance Tuning & Optimisation</a></li>
                              <li><a href="/services/drupal-personalization-cro">Personalization & CRO</a></li>
                              <li><a href="/services/drupal-support-maintenance">Support & Maintenance</a></li>
                              <li><a href="/services/drupal-8-upgrade-migration">Drupal 8 Upgrade & Migration</a></li>
                            </ul>
                        </div>

                        <div class="column">

                          <a href="https://www.drupal.org/opensense-labs" target="_blank"><img src="/themes/opensenselabs/images/drupal-member.svg" alt="Top Drupal member company"/></a>
                        </div>

                        <div class="column">
                            <h6>REGISTERED OFFICE</h6>
                            <ul class="menu vertical">
                                <li>
                                    <div class="address column">

                                        <p>OPENSENSE LABS<br/>M161 / 1B Gautam Nagar<br/>Green Park, New Delhi</p>
                                        <a href="mailto:hello@opensenselabs.com">hello@opensenselabs.com</a>
                                    </div>
                                </li>
                                <li class="column">
                                    <div class="icons">
                                        <a href="https://www.drupal.org/opensense-labs" target="_blank"><img src="/themes/opensenselabs/images/drupal icon.png" alt="Drupal.org profile"/></a>
                                        <a href="https://www.linkedin.com/company-beta/13234997/" target="_blank"><img src="/themes/opensenselabs/images/icon.png" alt="Linkdin connect"/></a>
                                        <a href="#" target="_blank"><img src="/themes/opensenselabs/images/wi-fi icon.png" alt="RSS feed"/></a>
                                      </div>
                                      <div class="icon">

                                        <a href="https://www.facebook.com/opensenselabs/" target="_blank"><img src="/themes/opensenselabs/images/facebook.png" alt="Facebook connect"/></a>
                                        <a href="https://twitter.com/opensenselabs" target="_blank"><img src="/themes/opensenselabs/images/twitter.png" alt="Twitter connect"/></a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="line text-center ">
            <img src="/themes/opensenselabs/images/line.png" alt="Line"/>
            <h6>OPENSENSE LABS - ALL RIGHTS RESERVED</h6>
            <h6>MADE WITH <span>♥</span> ON DRUPAL 8</h6>
            <p>Drupal is a registerd trademark of Dries Buytaert</p>
        </div>
    </article>
</footer>


    </section></div>
  <div class="js-off-canvas-exit"></div></div>
</div>
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
<script src="js/classie.js"></script>
<script>
  (function() {
    // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();
  $("#fileToUpload").change(function() {
  var filename = $('#fileToUpload').val().replace(/C:\\fakepath\\/i, '');
  $('.filename').append(filename);
	$('.file-icon').addClass('hasfile');
});
</script>
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-87116324-1', 'auto');
 ga('send', 'pageview');

</script>
  </body>
</html>
