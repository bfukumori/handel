<?php
  function handel_custom_menu($menu_links) {
    $menu_links = array_slice($menu_links, 0, 5, true)
    + ['custom_link' => 'Custom Link']
    + array_slice($menu_links, 5, NULL, true);

    // remove um link do menu
    // unset($menu_links['downloads']);

    return $menu_links;
  }
  add_filter('woocommerce_account_menu_items', 'handel_custom_menu');

  //ATUALIZA OS ENDPOINTS
  // function handel_add_endpoint() {
  //   add_rewrite_endpoint('custom_link', EP_PAGES);
  // }
  // add_action('init', 'handel_add_endpoint');

  function handel_custom_link() {
    echo "<p>Esse é um link customizável.</p>";
  }
  add_action('woocommerce_account_custom_link_endpoint', 'handel_custom_link');
?>