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
 * The maintenance layout.
 *
 * @package   theme_eguru
 * @copyright 2015 LMSACE Dev Team,lmsace.com
 * @author    LMSACE Dev Team
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * eguru_marketingSpot
 *
 * return string $content
 */

defined('MOODLE_INTERNAL') || die();

/**
 * marketingspot
 * @return string
 */
function eguru_marketingspot() {

    global $PAGE;
    global $OUTPUT;

    $nos = theme_eguru_get_setting('numberofslides');
    $i = $p % 3;
    $slideimage = $OUTPUT->image_url('home/slide'. '2', 'image');
    $slideimg = theme_eguru_render_slideimg($s1, 'slide' . '2' . 'image');
    $content = html_writer::start_tag('div', array('class' => 'custom-site-expo'));
    $content .= html_writer::start_tag('div', array('class' => 'container'));
    $content .= html_writer::start_tag('div', array('class' => 'row'));

    (int) $msp = 0;

    for ($i = 1; $i <= 4; $i++) {
        $mspicon = theme_eguru_get_setting('mspot'.$i.'icon');
        $msptitle = theme_eguru_get_setting('mspot'.$i.'title');
        $mspdescription = theme_eguru_get_setting('mspot'.$i.'desc');

        if (!empty($mspicon) || !empty($msptitle) || !empty($mspdescription)) {
            $msp = $msp + 1;
        }
    }

    switch ($msp) {
        case 4:
            $class = 'col-md-3';
            break;
        case 3:
            $class = 'col-md-4';
            break;
        case 2:
            $class = 'col-md-6';
            break;
        case 1:
            $class = 'col-md-12';
            break;
        case 0:
            $class = 'col-md-0';
            break;
        default:
            $class = 'col-md-3';
            break;
    }
        //$content .= html_writer::start_tag('img', array('src' => '//campusbg.bancoguayaquil.com/campusbg/pluginfile.php/1/theme_eguru/slide3image/1532644209/01pensum.png' , 'alt' => 'asd','width' => '138', 'heigth' => '138'));
    for ($i = 1; $i <= 4; $i++) {
        $mspicon = theme_eguru_get_setting('mspot'.$i.'icon');
        $msptitle = theme_eguru_get_setting('mspot'.$i.'title');
        $msptitle = theme_eguru_lang($msptitle);
        $mspdescription = theme_eguru_get_setting('mspot'.$i.'desc');
        $mspdescription = theme_eguru_lang($mspdescription);

        if (!empty($mspicon) || !empty($msptitle) || !empty($mspdescription)) {
            $content .= html_writer::start_tag('div', array('class' => $class));

                $content .= html_writer::start_tag('div', array('class' => 'ebox'));
            if (!empty($mspicon)) {
                $content .= html_writer::start_tag('div', array('class' => 'ebox-head'));

                    $content .= html_writer::start_tag('div', array('class' => 'rcthumb'));
                        //$content .= html_writer::start_tag('i', array('class' => 'fa fa-'.$mspicon));
                        //$content .= html_writer::end_tag('i');
			$j=$i+8;
			$spotimg = theme_eguru_render_slideimg($i, 'spot' . $i . 'marketing');

			//$content .= html_writer::start_tag('a', array('href' => '//campusbg.bancoguayaquil.com/campusbg/?redirect=0'));
			//$content .= html_writer::start_tag('img', array('src' => '//campusbg.bancoguayaquil.com/campusbg/pluginfile.php/1/theme_eguru/slide'.$j.'image/1532644209/'.$i.'.png' , 'alt' => 'asd','width' => '138', 'heigth' => '138', 'href' => 'https://campusbg.bancoguayaquil.com/campusbg/?redirect=0'));
			$content .= html_writer::start_tag('img', array('src' => $spotimg , 'alt' => 'asd','width' => '138', 'heigth' => '138', 'href' => 'https://campusbg.bancoguayaquil.com/campusbg/?redirect=0'));
			//$content .= html_writer::end_tag('a');
                    $content .= html_writer::end_tag('div');
                $content .= html_writer::end_tag('div');
            }
            if (!empty($msptitle) || !empty($mspdescription)) {
                $content .= html_writer::start_tag('div', array('class' => 'ebox-body'));
		    //Links
		    $content .= html_writer::start_tag('a', array('href' => '//campusbg.bancoguayaquil.com/campusbg/?redirect=0', 'class' => 'btn-marketing'));		
                    //$content .= html_writer::start_tag('button', array('class' => 'btn-marketing'));
                    $content .= $msptitle;
                    //$content .= html_writer::end_tag('button');
		    $content .= html_writer::end_tag('a');
                    $content .= html_writer::start_tag('p');
                    $content .= $mspdescription;
                    $content .= html_writer::end_tag('p');

                $content .= html_writer::end_tag('div');
            }
            $content .= html_writer::end_tag('div');
            $content .= html_writer::end_tag('div');
        }
    }
    $content .= html_writer::end_tag('div');
    $content .= html_writer::end_tag('div');
    $content .= html_writer::end_tag('div');
    $content .= 'asdad';

    return $content;
}
echo eguru_marketingspot();