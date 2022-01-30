<?php
  /* CRIAR CAMPO PERSONALIZADO
  function handel_custom_checkout_field() {
    woocommerce_form_field('custom_message', [
      'type' => 'textarea',
      'class' => ['form-row-wide custom-message'],
      'label' => 'Mensagem personalizada',
      'placeholder' => 'Escreva uma mensagem para a pessoa que você está presenteando.',
      'required' => true
    ], $checkout->get_value('custom_message'));
  }
  add_action('woocommerce_after_order_notes', 'handel_custom_checkout_field');*/

  //PERSONALIZAR O CHECKOUT
  function handel_custom_checkout($fields) {
    $fields['billing']['billing_gift'] = [
      'label' => 'Embrulhar para presente?',
      'required' => false,
      'class' => ['form-row-wide'],
      'clear' => true,
      'type' => 'select',
      'options' => [
        'não' => 'Não',
        'sim' => 'Sim'
      ]
    ];
    //RETIRA UM CAMPO
    // unset(['billing']['billing_phone']);

    return $fields;
  }
  add_filter('woocommerce_checkout_fields', 'handel_custom_checkout');

  //ADICIONAR OS VALORES DO CAMPO PERSONALIZADO NA PÁGINA DO ADMIN
  function handel_show_admin_custom_checkout_gift($order) {
    $gift = get_post_meta($order->get_id(), '_billing_gift', true);
    echo '<p><strong>Presente:</strong> ' . $gift . '</p>';

  }
  add_action('woocommerce_admin_order_data_after_shipping_address', 'handel_show_admin_custom_checkout_gift');

  /* VALIDAR CAMPO PERSONALIZADO
  function handel_custom_checkout_field_process() {
    if(!$_POST['custom_message']) {
      wc_add_notice('Por favor, escreva algo nesse campo.' 'error');
    }
  }
  add_action('woocommerce_checkout_process', 'handel_custom_checkout_field_process');*/

  /*ATUALIZAR NO BANCO DE DADOS
  function handel_custom_checkout_field_update($order_id) {
    if(!empty($_POST['custom_message'])) {
      update_post_meta($order_id, 'custom_message', sanitize_text_field($_POST['custom_message']));
    }
  }
  add_action('woocommerce_checkout_update_order_meta', 'handel_custom_checkout_field_update');*/
?>