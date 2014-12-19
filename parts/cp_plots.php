<div id="myModal" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <h3 id="myModalLabel">Data Estimation Input</h3>
    </div>
    <div class="enhanced modal-body" id="brewcontent_grid">

    </div>
    <div class="enhanced modal-footer btn-group">
        <button class="btn" id="addrow">
            Add Row
        </button>
        <button class="btn" id="removerow">
            Remove
        </button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            Close
        </button>
        <button id="render_routes" data-dismiss="modal" class="btn btn-primary">
            Save and Render New Points
        </button>
    </div>
</div>
<div class="hide">
    <div id="tpl_inputdata">
        <div class="row-fluid indexrow">
            <div class="span6">
                Based on Point A
            </div>
            <div class="span6">
                Based on Point B
            </div>
        </div>
        <div class="row-fluid datarow">
            <div class="span6">
                ({{point_a.x}} , {{point_a.y}} )
            </div>
            <div class="span6">
                ({{point_b.x}} , {{point_b.y}} )
            </div>
        </div>
        <div class="row-fluid indexrow">
            <div class="span1">
                Picker
            </div>
            <div class="span2">
                Point Ref.
            </div>
            <div class="span2">
                Estimate Depth
                <br>
                (M)
            </div>
            <div class="span2">
                Radius From Point A
                <br>
                (M)
            </div>
            <div class="span2">
                Radius From Point B
                <br>
                (M)
            </div>
            <div class="span3">
                Remarks
            </div>
        </div>
        {{#each testing_length}}
        <div class="row-fluid datarow  test_result_{{this.result}}">
            <div class="col1 span1">
                <input type="checkbox" />
            </div>
            <div class="span2 refpoint">
                {{this.ref}}
            </div>
            <div class="span2">
                {{this.est}}
            </div>
            <div class="span2">
                {{this.a}}
            </div>
            <div class="span2">
                {{this.b}}
            </div>
            <div class="span3">
                {{this.result}}
            </div>
        </div>
        {{/each}}
    </div>
</div>
<article id="plots_sketch" class="panel">
    <header class="entry-header">
        <h2> A. Plot the points from the previous measurement</h2>
    </header>
    <!-- data-toggle="buttons-radio" -->
    <div class="btn-block">
        <div class="btn-group">
            <button id="plot_grid" type="button" class="btn " data-toggle="modal"  data-target="#myModal">
                Grid
            </button>
            <button  id="startover" type="button" class="btn ">
                Start Over
            </button>
            <button id="plot_2"  type="button" class="btn ">
                Plot Map
            </button>
        </div>
        <div class="btn-group" data-toggle="buttons-checkbox">
            <button id="plot_0"  type="button" class="btn btn-primary">
                - Canvas
            </button>
            <button id="plot_3"  type="button" class="btn btn-primary">
                - Points
            </button>
            <button id="plot_4"  type="button" class="btn btn-primary">
                - Lines
            </button>
            <button id="p-move"  type="button" class="btn btn-primary">
                move
            </button>
           
        <input type="file" name="file" accept="image/*" capture="camera" />
        </div>
    </div>
    <div class="plot_table" data-role="content">
        <div id="fixed_display_information"></div>
        <canvas id="plotmap"></canvas>
        <script>
			plotting_map.ini();
			$("#main>article>.entry-content").addClass("2d");
        </script>
</article>
