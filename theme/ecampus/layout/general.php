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
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

splash_check_colourswitch();
splash_initialise_colourswitcher($PAGE);

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
    $tagline = get_string('defaulttagline', 'theme_splash');
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/css/style.min.css">
    <script src="/js/libs/modernizr-2.6.1.min.js"></script>
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
                             <img src="/img/layout/header/logo.png" alt="Temple Made: Dental eCampus Logo" title="Temple Made: Dental eCampus Logo" />
                             <h1 class="hide-text">Temple Made: Dental eCampus</h1>
                        </div>
                        <div class="span6 header-login">
                        <?php
                            if (isloggedin()) {
                                
                            } else { ?>

                            <form class="form-inline" role="input" title="Login" id="login">
                                    <input type="text" class="input-medium" placeholder="Email">
                                    <input type="password" class="input-medium" placeholder="Password">
                                    <button type="submit" class="btn btn-inverse button-blue">Sign in</button>
                                </form>


                               
                            <?php } ?>
                                
                        </div>
                    </div>
                </div>
            </hgroup>
        
        
    </header>
    <!-- END CUSTOMMENU -->
    <?php if (!empty($courseheader)) { ?>
    <div id="course-header"><?php echo $courseheader; ?></div>
    <?php } ?>
    <div class="navbar">
    <div class="wrapper clearfix">
    <div class="breadcrumb">
    <?php
    if ($hasnavbar) {
        echo $OUTPUT->navbar();
    } ?>
    </div>
    <div class="navbutton"> <?php echo $PAGE->button; ?></div>
    </div>
    </div>
    </div>

        <!-- END OF HEADER -->
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
    <div id="page-footer">
    <div id="footer-wrapper">
        <?php
    if ($hasfootnote) { ?>
            <div id="footnote"><?php echo $PAGE->theme->settings->footnote; ?></div>
            <?php
    } ?>
            <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
            <?php
            echo $OUTPUT->login_info();
            echo $OUTPUT->home_link();
            echo $OUTPUT->standard_footer_html();
            ?>
        </div>
    </div>
    <?php
} ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
