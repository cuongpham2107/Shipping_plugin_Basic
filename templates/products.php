<div class="wrap">
    <h1>Product Manager</h1>
    <?php settings_errors(); ?>
    
    <ul class="nav nav-tabs font-semibold text-base">
        <li class="active">
            <a class="" href="#tab-1">Your Custom Post Types</a>
        </li>
        <li>
            <a href="#tab-2">Add Custom Post Type</a>
        </li>
        <li>
            <a href="#tab-3">Export</a>
        </li>
    </ul>
    <div class="tab-content ">
        <div id="tab-1" class="tab-pane active !px-8 !py-2">
            <h3>Manage Your Custom Post Types</h3>
        </div>
        <div id="tab-2" class="tab-pane !px-8 !py-2">
            <h3 class="text-3xl text-center my-4">Create a new Custom Post Type</h3>
            <form action="options.php" method="post">
                <?php
                    settings_fields('shipping_plugin_product_settings');
                    do_settings_sections('shipping_product');
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-3" class="tab-pane !px-8 !py-2">
            <h3>Export our Custom Post Types</h3>
        </div>
    </div>
</div>