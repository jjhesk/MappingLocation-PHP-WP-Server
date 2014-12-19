<!-- Modal -->
<div id="offerjobCP" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="offerlabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <h3 id="offerlabel">Job Offer to CP id#4982974</h3>
    </div>
    <div class="modal-body">
        <p>
            Please complete to below survey
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            Cancel
        </button>
        <button class="btn btn-primary">
            Commit this Offer
        </button>
    </div>
</div>
<div id="cpProfile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cpprofilelabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <h3 id="cpprofilelabel">CP Profile</h3>
    </div>
    <div class="modal-body">
        <p>
            This is the detail of the CP profile.
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            Close
        </button>
    </div>
</div>
<!-- set up the modal to start hidden and fade in and out -->
<div id="ocdialogs" class="modal hide fade">
    <!-- dialog contents -->
    <div class="modal-body">
        {{data dialog}}
    </div>
    <!-- dialog buttons -->
    <div class="modal-footer">
        <a href="#" class="btn primary">confirm</a>
    </div>
</div>
<!-- install and setup the  dialogs for the new project-->
<div id="ocdnewproject" class="modal hide fade">
    <!-- dialog contents -->
    <div class="modal-body">
        <span>Please enter your new project ID</span>
        <input id="project_id_input" name="project_id" type="text"/>
    </div>
    <!-- dialog buttons -->
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            Cancel
        </button>
        <button class="btn primary" data-dismiss="modal" aria-hidden="true" id="creat_new_project_btn">
            Create and Select Project
        </button>
    </div>
</div>
<div id="oc_search_projects_result" class="modal hide fade">
    <!-- dialog contents -->
    <div class="modal-body">
        <span>Please enter your new project ID</span>
        <input id="project_id_input" name="project_id" type="text"/>
    </div>
    <!-- dialog buttons -->
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            Cancel
        </button>
        <button class="btn primary" data-dismiss="modal" aria-hidden="true" id="creat_new_project_btn">
            Create and Select Project
        </button>
    </div>
</div>