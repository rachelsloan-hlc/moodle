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
 * @package    theme_ecampus_custom
 * @copyright 2013 - Healthcare Learning Company
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasheading = ($PAGE->heading);
if($PAGE->bodyid == "page-site-index")
{
    $hasnavbar = false;
    $ishome = true;
}
else
{
    $hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
    $ishome = false;
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
    $tagline = get_string('defaulttagline', 'theme_ecampus_custom');
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<?php echo $OUTPUT->standard_head_html() ?>

<link rel="stylesheet" href="/theme/ecampus_custom/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/ecampus_custom/libs/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/theme/ecampus_custom/css/style.min.css">
    <link rel="stylesheet" href="/theme/ecampus_custom/css/moodle.css">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
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
                         <img src="/theme/ecampus_custom/img/layout/header/logo.png" alt="Temple Made: Dental eCampus Logo" title="Temple Made: Dental eCampus Logo" />
                         <h1 class="hide-text">Temple Made: Dental eCampus</h1>
                    </div>
                    <div class="span6 header-login">
                    <?php
                        if (isloggedin()) {
                        
                        echo html_writer::tag('h5', get_string('welcome', 'theme_ecampus_custom', $USER->firstname));
                        echo html_writer::link(new moodle_url('/user/profile.php', array('id'=>$USER->id)),
                        get_string('myprofile')).' | ';
                        echo html_writer::link(new moodle_url('/login/logout.php', array('sesskey'=>sesskey())),
                        get_string('logout'));
                        if(is_siteadmin()) {
                        echo " | <a href='/admin/'>".get_string('adminsection')."</a>";
                            }
                            
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
    <?php 
    if ($ishome) { ?>

        <hgroup class="header-banner">
            <div class="header-banner-image">
                <div class="header-welcome">
                        <p>Welcome to Temple’s Dental eCampus which provides you with access to courses, webinars, certificate, and ePorftolios.<br />For details, select any of the areas shown</p>

                      
                </div>
                <div class="clear"></div>
            </div>
        </hgroup>
    </header>
    
    <?php } else { ?>    
    </header>    
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
                    <form id="course_search" action="/course/search.php" method="get" class="form-inline" role="input">
                        <label for="shortsearchbox" class="accesshide">Search courses: </label>
                        <div class="sticky-input sticky-input-medium">
                            <input type="submit" class="i-search sticky-icon sticky-icon-right ">
                            <input type="text" id="shortsearchbox" name="search" class="input-medium" placeholder="keyword search">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    </section>
       
        <!-- END OF HEADER -->
    <article id="main" role="main" >
   <?php } if($ishome) { ?>    
    <div class="container">
     <div class="row">
        <div class="span4">
            <section class="homepage-block sticky">
                <div class="image"><img src="/theme/ecampus_custom/img/module/homepage-block/home-block-1.png" width="351" height="161" alt="Post-doctoral Certificates" /></div>
                <div class="title"><h3>Continuing Education</h3></div>
                <div class="text bg-green">
                    <p>To make learning more accessible, Temple offers a growing list of online certificates supported by online lectures, directed reading, case-presentations, and online assessments.</p>
                </div>
                <div class="more-info">
                    <a href="/course/" class="i-align-left i-arrow-right" title="More information about Post-doctoral Certificates">More info</a>
                </div>
            </section>
        </div>
        <div class="span4">
            <section class="homepage-block sticky">
                <div class="image"><img src="/theme/ecampus_custom/img/module/homepage-block/home-block-2.png" width="351" height="161" alt="Continuing Education" /></div>
                <div class="title"><h3>Live Webinars</h3></div>
                <div class="text bg-blue">
                    <p>Our live webinars give you access to leading speakers from around the world so that you can directly ask them questions about technologies or treatments.  If you miss one, don’t worry, we record them as well so you can watch later as well.  If you would like to speak at one of our webinars, please <a href="mailto:kimberlee@dental.temple.edu">email us</a>.  </p>
                </div>
                <div class="more-info">
                    <a href="/course/category.php?id=999" class="i-align-left i-arrow-right" title="Live Webinars">More info</a>
                </div>
            </section>
        </div>
        <div class="span4">
            <section class="homepage-block sticky">
                <div class="image"><img src="/theme/ecampus_custom/img/module/homepage-block/home-block-3.png" width="351" height="161" alt="ePortfolios" /></div>
                <div class="title"><h3>ePortfolios</h3></div>
                <div class="text bg-orange">
                    <p>To better support dental students and faculty, Temple provides a growing number of eportfolios. These can also be licensed by other schools to improve monitoring of student achievements, guide reflective thinking, and to record assessments.  The Temple Dental eCampus provides other schools with an opportunity to create their own ePortfolios at a relatively low cost.</p>
                </div>
                <div class="more-info">
                    <a href="#" class="i-align-left i-arrow-right" title="ePortfolios">More info</a>
                </div>
            </section>
        </div>
        <div class="clearfix"></div>
    </div>
  </div>  

<div style="display: none"><?php echo $OUTPUT->main_content() ?></div>
       <?php } else { ?>     
    
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

        <?php } ?>
        <!-- END OF CONTENT -->
        <?php if (!empty($coursefooter)) { ?>
        <div id="course-footer"><?php echo $coursefooter; ?></div>
        <?php } ?>
        <div class="clearfix"></div>
    <!-- END OF #Page -->
    
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
                            <li><a href="/course/category.php?id=999">Live Webinars</a></li>
                            <li><a href="#">ePortfolios</a></li>
                        </ul>
                    </div>
                    <div class="span2 footer-section">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="/site/terms.php">Terms of use</a></li>
                            <li><a href="/site/contact.php">Contact us</a></li>
                            <li><a href="/site/privacy.php">Privacy policy</a></li>
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
                                <a href="https://twitter.com/TempleUniv" class="i-social i-social-twitter" title="Twitter account">&nbsp;</a><br />
                                <a href="https://twitter.com/TempleUniv" title="Twitter account">Twitter</a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/templeu" class="i-social i-social-facebook" title="Facebook account">&nbsp;</a><br />
                                <a href="https://www.facebook.com/templeu" title="Facebook account">Facebook</a>

                            <li>
                                <a href="http://www.youtube.com/user/TempleUniversity" class="i-social i-social-youtube" title="Youtube account">&nbsp;</a><br />
                                <a href="http://www.youtube.com/user/TempleUniversity" title="Youtube account">YouTube</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 text-center footer-copyright">
                        <p><img src="/theme/ecampus_custom/img/layout/footer/logo.png" alt="Temple Made Dental eCampus" height="40" align="" /> &nbsp;&nbsp;&nbsp; &copy; Copyright <?php echo date('Y'); ?> Temple University. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <link rel="stylesheet" type="text/css" href="/theme/ecampus_custom/javascript/fancybox/jquery.fancybox-1.3.4.css"/>
        <script src="/theme/ecampus_custom/javascript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <?php
} ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
