<div class="hide" id="tpl_single_processing_job">
    {{#each data}}
    <li class="job" data-id="{{this.ID}}">
        Reference no:  {{this.reference_no}}
        <br>
        selected cp levels: {{this.creation_timestamp}}
        <br>
        updated time: {{this.creation_timestamp}}
        <br>
        tools:
        <br>
        record plan:
        <div class="buttons_area">
            <button class="edit_btn icon icon5"></button><button class="remove_btn icon icon17"></button>
        </div>
    </li>
    {{/each}}
    <li class="new job" data-id="">
        <div class="plus_sign"></div>
    </li>
</div>
<div class="hide" id="tpl_single_processing_job_empty">
    <li class="new job" data-id="">
        <div class="plus_sign"></div>
    </li>
</div>