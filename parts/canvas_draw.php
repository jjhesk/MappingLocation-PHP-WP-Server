<style type="text/css"><!--
            #canvas1{ border: solid 1px greenyellow;cursor: crosshair;float: left;}
            #colors{margin:0;padding:0;float: left; display: block;}
            #colors li{ height: 20px; width: 20px; display: block; cursor: pointer; }
            #colors li.selected{ border: solid 1px #eee; }
            #color li{width:50px;height:50px;float:left;}
            #canvas label{float: left;}
--></style>
<div class="hide">
<div id="the_draw_board"><canvas id="canvas1" width="400" height="400"></canvas>
<ul id="colors">
    <li style="background-color: black;"></li>
    <li style="background-color: white;"></li>
    <li style="background-color: red;"></li>
    <li style="background-color: green;"></li>
    <li style="background-color: orange;"></li>
    <li style="background-color: brown;"></li>
    <li style="background-color: #d2232a;"></li>
    <li style="background-color: #fcb017;"></li>
    <li style="background-color: #fff460;"></li>
    <li style="background-color: #9ecc3b;"></li>
    <li style="background-color: #fcb017;"></li>
    <li style="background-color: #fff460;"></li>
    <li style="background-color: #f43059;"></li>
    <li style="background-color: #82b82c;"></li>
    <li style="background-color: #0099ff;"></li>
    <li style="background-color: #ff00ff;"></li>
</ul>
<br style="clear: both;" />
<label for="brush">Brush Size:</label><input id="brush_size" type="range" max="100" min="0" name="brush" value="5" />
<br style="clear: both;" />
<button id="undo" disabled="disabled">Undo</button>
<button id="clear">Reset</button>
<button id="export">Export as Image</button>
</div>
</div>