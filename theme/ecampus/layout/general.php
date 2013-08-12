<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * General layout for the splash theme
 *
 * @package    theme_splash
 * @copyright  2012 Caroline Kennedy - Synergy Learning
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasheading = ($PAGE->heading);
if($home)
{
    $hasnavbar = false;
}
else
{
    $hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
}

$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));


$courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
    $courseheader = $OUTPUT->course_header();
    $coursecontentheader = $OUTPUT->course_content_header();
    if (empty($PAGE->layout_options['nocoursefooter'])) {
        $coursecontentfooter = $OUTPUT->course_content_footer();
        $coursefooter = $OUTPUT->course_footer();
    }
}

$bodyclasses = array();
$bodyclasses[] = 'splash-'.splash_get_colour();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$hidetagline = (!empty($PAGE->theme->settings->hide_tagline) && $PAGE->theme->settings->hide_tagline == 1);

if (!empty($PAGE->theme->settings->tagline)) {
    $tagline = $PAGE->theme->settings->tagline;
} else {
    $tagline = get_string('defaulttagline', 'theme_ecampus');
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/theme/ecampus/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/ecampus/libs/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/theme/ecampus/css/style.min.css">
    <link rel="stylesheet" href="/theme/ecampus/css/moodle.css">
    <script src="/theme/ecampus/js/libs/modernizr-2.6.1.min.js"></script>
    
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <div class="wrapper">
        <!-- end header -->
        <div class="hidden">
            <a href="#main" title="skip to main content">Skip to main content</a>
            <a href="#login" title="skip to login">Skip to login</a>
        </div>
        
        
        <header>
            <hgroup class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="span6 header-logo">
                             <img src="/theme/ecampus/img/layout/header/logo.png" alt="Temple Made: Dental eCampus Logo" title="Temple Made: Dental eCampus Logo" />
                             <h1 class="hide-text">Temple Made: Dental eCampus</h1>
                        </div>
                        <div class="span6 header-login">
                        <?php
                            if (isloggedin()) {
                            
                            echo html_writer::tag('h5', get_string('welcome', 'theme_splash', $USER->firstname));
                            echo html_writer::link(new moodle_url('/user/profile.php', array('id'=>$USER->id)),
                            get_string('myprofile')).' | ';
                            echo html_writer::link(new moodle_url('/login/logout.php', array('sesskey'=>sesskey())),
                            get_string('logout'));
                                
                            } else { ?>

                            <form action="/login/index.php" method="post" class="form-inline" role="input" title="Login" id="login">
                              <input type="text" name="username" size="15" class="input-medium" placeholder="Email" />
                              <input type="password" name="password" size="15" class="input-medium" placeholder="Password" />
                              <input type="submit" name="Submit" class="btn btn-inverse button-blue" value="Sign in" />
                            </form>
                            <?php } ?>      
                        </div>
                    </div>
                </div>
            </hgroup>
    </header>

    <?php 
    if ($hasnavbar) { ?>
    <section id="page-strap">
    <div class="container">
        <div class="row">
            <div class="span7 ">
                <section class="breadcrumbs">
                    <?php echo $OUTPUT->navbar(); ?>
                </section>
            </div>
            <div class="span4 offset1">
                <div class="row">
                    <form id="coursesearch" action="/course/search.php" method="get" class="form-inline" role="input">
                        <label for="shortsearchbox" class="accesshide">Search courses: </label>
                        <div class="sticky-input sticky-input-medium">
                            <input type="submit" class="i-search sticky-icon sticky-icon-right "></div>
                            <input type="text" id="shortsearchbox" name="search" class="input-medium" placeholder="keyword search">
                        </div>
                    </form>
            
                </div>
            </div>
        </div>
    </div>
    </section>
        <?php    } ?>

        <!-- END OF HEADER -->
        <article id="main" role="main" >
    
        <!-- START OF CONTENT -->
        <div id="page-content">
            <div id="region-main-box">
                <div id="region-post-box">
                    <div id="region-main-wrap">
                        <div id="region-main">
                            <div class="region-content">
                                <?php echo $coursecontentheader; ?>
                                <?php echo $OUTPUT->main_content() ?>
                                <?php echo $coursecontentfooter; ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($hassidepre) { ?>
                    <div id="region-pre" class="block-region">
                        <div class="region-content">
                            <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                        </div>
                    </div>
                    <?php
} ?>

                    <?php if ($hassidepost) { ?>
                    <div id="region-post" class="block-region">
                        <div class="region-content">
                            <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                        </div>
                    </div>
                    <?php
} ?>
                </div>
            </div>
        </div>
        <!-- END OF CONTENT -->
        <?php if (!empty($coursefooter)) { ?>
        <div id="course-footer"><?php echo $coursefooter; ?></div>
        <?php } ?>
        <div class="clearfix"></div>
    <!-- END OF #Page -->
    </div>
    <!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    </article>

        <!-- end content -->

        <!-- start footer -->

        <div class="push"></div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="span3 footer-section">
                        <h4>Navigate</h4>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/course/">Continuing Education</a></li>
                            <li><a href="#">Live Webinars</a></li>
                            <li><a href="#">ePortfolios</a></li>
                        </ul>
                    </div>
                    <div class="span2 footer-section">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="span3 footer-section">
                        <h4>Information</h4>
                        <p>3223 N. Broad Street, Room 337<br />
                            Philadelphia, PA  19140<br />
                            (P) 215.707.7677

                        </p>
                    </div>
                    <div class="span4">
                        <h4>Connect with us</h4>
                        <ul class="list-inline footer-social">
                            <li>
                                <a href="#" class="i-social i-social-twitter" title="Twitter account">&nbsp;</a><br />
                                <a href="#" title="Twitter account">Twitter</a>
                            </li>
                            <li>
                                <a href="#" class="i-social i-social-facebook" title="Facebook account">&nbsp;</a><br />
                                <a href="#" title="Facebook account">Facebook</a>

                            <li>
                                <a href="#" class="i-social i-social-youtube" title="Youtube account">&nbsp;</a><br />
                                <a href="#" title="Youtube account">YouTube</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 text-center footer-copyright">
                        <p><img src="/theme/ecampus/img/layout/footer/logo.png" alt="Temple Made Dental eCampus" height="40" align="" /> &nbsp;&nbsp;&nbsp; &copy; Copyright <?php echo date('Y'); ?> Temple University. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/theme/ecampus/js/libs/jquery-1.8.0.min.js"><\/script>')</script>

        <script src="/theme/ecampus/libs/bootstrap/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/theme/ecampus/js/libs/fancybox/jquery.fancybox-1.3.4.css"/>
        <script src="/theme/ecampus/js/libs/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

        <script src="/theme/ecampus/js/plugins.js"></script>
        <script src="/theme/ecampus/js/main.js"></script>

        <script>
            /*var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));*/
        </script>
        <script src="/theme/ecampus/js/libs/respond/respond.min.js"></script>
    <?php
} ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
