<div class="wrap">
    <h1>Product Manager</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php
            settings_fields('shipping_plugin_product_settings');
            do_settings_sections('shipping_product');
            submit_button();
        ?>
    </form>
</div>