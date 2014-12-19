<?php

function get_stars($stars) {
    $star_c = 0;
    $out = "";
    while ($star_c < $stars) {
        $star_c++;
        $out .= '<img alt="" src="' . HKM_IMG_PATH . 'star.png" width="45px" height="45px" />';
    }
    return $out;
}

global $current_user;
get_currentuserinfo();
?>
<article id="post-0" class="panel">
    <header class="entry-header">
        <h1 class="entry-title">Welcome CP: <?php echo $current_user -> user_login; ?></h1>
        <h2>You login time is ~timestamp~</h2>
    </header>
</article>
<article class="row-fluid">
    <div class="span4">
        <div class="well thumbnail">
            <img class="media-object" alt="" src="<?php echo HKM_IMG_PATH . "demo/profileface.jpeg"; ?>" />
        </div>
    </div>
    <div class="span8">
        <div class="well">
            Welcome, <strong>
                <?php echo $current_user -> user_firstname . " " . $current_user -> user_lastname; ?>
            </strong>
            <br>
            CP#: <strong>1Call1234567</strong>
            <br>
            (expire: <strong>01/12/2016</strong>)
            <br>
            Star rating: <?php echo get_stars(5); ?>
            <br>
            Total number of Jobs done:<strong> 50</strong>
            <br>
            <span style="font-size: 1rem;">For a promotion in star level:</span>
            You will need to complete <strong>30</strong> more jobs
            And get an <strong>Interview by Panel of HKIUS</strong>
        </div>
    </div>
</article>
<article class="row-fluid">
        <div class="span12">
        <div class="well">
            <table class="commontable" border="1px">
                <thead> <tr class="indexrow">
            <th>Project ID</th>
            <th>Job ID</th>
            <th>Client</th>
            <th>Date</th>
            <th>Location</th>
            <th>Status</th>
        </tr></thead>
    <tbody>
        <tr>
            <th>   Y12-OC-S-011-001</th>
            <th>1C-PO-2012-0005</th>
            <th>Hsing Chong - Yau Lee Joint Venture</th>
            <th>20-01-2013</th>
            <th>Wong Tai Sin</th>
            <th>Incomplete</th>
        </tr>
        <tr>
            <th>Y12-OC-S-011-002</th>
            <th>1C-PO-2012-0004</th>
            <th>Mei Shing Engineering Co Ltd</th>
            <th>19-01-2013</th>
            <th>Sha Tin</th>
            <th>Incomplete</th>
        </tr>
        </tbody></table>
        <div class="pagination">
  <ul>
    <li><a href="#">Prev</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</div>
        </div>
        
        
        </div>
</article>