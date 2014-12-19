<?php


/**
 * HKM development All Rights Reserved
 * Template Name: PRINTING SINGLE REPORT FORM B
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
//upload_image_and_print::graphic_print();

get_header('report');

?>

<div class="content">
    <span class="big-title">CABLE DETECION REPORT (Form B)</span>
    <table dir="ltr" border="0" cellpadding="0" cellspacing="0" class="tblGenFixed" id="tblMain">
        <tbody>
        <tr class="rShim">
            <td class="rShim" style="width:0;"></td>
            <td class="rShim" style="width:120px;"></td>
            <td class="rShim" style="width:120px;"></td>
            <td class="rShim" style="width:120px;"></td>
            <td class="rShim" style="width:120px;"></td>
            <td class="rShim" style="width:120px;"></td>
            <td class="rShim" style="width:465px;"></td>
            <td class="rShim" style="width:35px;"></td>
        </tr>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td rowspan="2" dir="ltr" class="s0">Point ref.</td>
            <td rowspan="2" dir="ltr" class="s1">Width(mm)</td>
            <td rowspan="2" dir="ltr" class="s1">Estimated Depth</td>
            <td colspan="2" dir="ltr" class="s1">Distance between Point A &amp; B: 17.1m</td>
            <td style="display:none;"></td>
            <td colspan="2" rowspan="2" dir="ltr" class="s1">Remarks</td>
            <td style="display:none;"></td>
        </tr>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td dir="ltr" class="s2">From Point A (m)</td>
            <td dir="ltr" class="s2">From Point B (m)</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
        </tr>
       <!-- <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td dir="ltr" class="s3">P1</td>
            <td></td>
            <td class="s4">0.8</td>
            <td class="s4">0.6</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td dir="ltr" class="s3">P2</td>
            <td></td>
            <td class="s4">0.8</td>
            <td class="s4">1.3</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>-->
        <?php

        ?>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td dir="ltr" class="s3">legend:</td>
            <td colspan="6" dir="ltr" class="s2">Legend A: i</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
        </tr>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td colspan="7" dir="ltr" class="s3 notesize">Remarks:<br>Under no circumstances should this report be
                regarded as a formal “Competent Person Written Report” unless Active Cable Detection was carried out.
                All the alignment records presented in this report are based on the result of Passive Cable Detection
                only. (Please refer Code of Practice on Working near Electricity Supply Lines)
            </td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
        </tr>
        <tr dir="ltr">
            <td class="hd"><p style="height:16px;">.</p></td>
            <td colspan="5" dir="ltr" class="s3 notesize">Note Remarks<br>i. 50Hz Frequency adopted for Live Cable and
                depth located by utilizing Receiver. 1 - No record plan provided<br>ii. Limit of detection is 3 meters
                in depth. 2 - On site, not in record plan<br>iii. All information provided is to the best recordable by
                the competent person. 3 - In record plan, not on site<br>iv. Accuracy need to be re-verified during
                excavation. 4 - Both on site &amp; in Record Plan<br>v. Care must be taken while excavating. *- The
                “Estimated Depth” is for reference only unless is detected by active detection mode.<br>vi. Use hand
                tools at all times for trial pits.<br>vii. Unknown voltage cable shall be treated as high voltage cable
                and extra care must be taken.<br>viii. For enquiry or further work, please call 1Call Power Service
                (6888 6600)
            </td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td colspan="2" dir="ltr" class="s2 notesize">Remarks<br>i. 50Hz Frequency adopted for Live Cable and depth
                located by utilizing Receiver. 1 - No record plan provided<br>ii. Limit of detection is 3 meters in
                depth. 2 - On site, not in record plan<br>iii. All information provided is to the best recordable by the
                competent
                person. 3 - In record plan, not on site<br>iv. Accuracy need to be re-verified during excavation. 4 -
                Both on site &amp; in Record Plan<br>v. Care must be taken while excavating. *- The “Estimated Depth” is
                for reference only unless is detected by active detection mode.
            </td>
            <td style="display:none;"></td>
        </tr>
        </tbody>
    </table>
</div>
<?php
get_footer('report');
?>
