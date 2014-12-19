<div id="view" data-role="view" data-title="Page" data-layout="default">
    <ul id="load-more"></ul>
    <script type="text/x-kendo-tmpl" id="load-more-template">
    <div class="product">
        <img src="#=thumbnail_images.medium.url#" alt="#-title#" class="pullImage"/>
        <h3>#=title#</h3>
    </div>
    </script>
</div>

<div data-role="layout" data-id="default">
    <div data-role="header">
        <div data-role="navbar">
            <span data-role="view-title"></span>
        </div>
    </div>
    <div data-role="footer">
        <div data-role="navbar">
            <span>Bottom Bar</span>
        </div>
    </div>
</div>