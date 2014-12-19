<script id="tpl_toolings_options" type="text/x-handlebars-template">
    <div class="row-fluid indexrow">
        <div class="span1">
            C/O
        </div>
        <div class="span3">
            Tool Brand + Model
        </div>
        <div class="span3">
            S/N
        </div>
        <div class="span2">
            Calibration Date
        </div>
        <div class="span3 pull-right">
            Available for bookings
        </div>
    </div>
    {{#each this}}
    <div class="row-fluid datarow">
        <div class="span1 checkbox {{tool_set_selection_bool_active}}" data-tool-id="{{this.tool_id}}">
            <div class="image"></div>
        </div>
        <div class="span3 toolcode">
            {{this.brand}} - {{this.model}}
        </div>
        <div class="span3 sn">
            {{this.serialno}}
        </div>
        <div class="span2 caltime">
            {{this.caldate}}
        </div>
        <div class="span3 available pull-right">
            {{this.available}}
        </div>
    </div>
    {{/each}}
</script>
<script id="tpl_images_selected_record_plan" type="text/x-handlebars-template">
    <div class="row-fluid datarow">
        <span class="span12"><img class="recordplan thumbnail" src="{{this.url}}"/></span>
    </div>
</script>