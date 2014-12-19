<?php
function produce_report($page_settings = array())
{
    $p = 0;
    foreach ($page_settings['pages'] as $page => $pagecb) {
        if ($p === 0) {
            printpage_cover($page_settings['fields']);
        } else {
            printpage_single_normal($p, $page_settings['fields']);
        }
        $p++;
    }
}

function printpage_cover($data)
{
    ?>
    <div class="page">
        <div class="subpage coverpage">
            <section class="printable">
                <div class="center"><img src="{{cover.img}}"/></div>
                <div class="center">
                    <p><strong>{{report_title}}</strong></p>

                    <p>Cable Detection</p>

                    <p>At</p>

                    <p>({{jobID}})</p>
                    <span>{{project_no}}</span><br>
                    <span>{{siteno}}</span><br>
                    <span>({{revision}})</span><br>
                    <span>{{month_year}}</span>
                </div>
                <div class="alignleft"><img src="{{cover.footer}}"/></div>
            </section>
        </div>
    </div><?php
}

function printpage_single_normal($current_page, $data)
{
    ?>
    <div class="page">
    <div class="subpage">
        <?php do_action('report-header', $current_page, $data); ?>
        <section class="printable">
            <?php do_action('report-header', $current_page, $data); ?>
            <?php do_action('report-header', $current_page, $data); ?>
        </section>
        <?php do_action('report-footer', $current_page, $data); ?>
    </div>
    </div><?php
}

?>