<?php
  function handel_add_email_meta($order) {
    $gift = get_post_meta($order->get_id(), '_billing_gift', true);
    echo '<h2 style="margin: -20px 10px 10px 0px">Detalhes</h2>
    <p style="font-size: 16px; border: 1px solid #e5e5e5; padding: 10px;"><strong>Presente: </strong>' . $gift . '</p>
    ';
  }
  add_action('woocommerce_email_order_meta', 'handel_add_email_meta');
?>