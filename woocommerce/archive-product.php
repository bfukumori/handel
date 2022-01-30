<?php get_header(); ?>
<?php 
  $products= [];
  if(have_posts()) : while(have_posts()) : the_post();
    $products[] = wc_get_product(get_the_ID());
  endwhile; endif;

  $data = [];
  $data['products'] = format_products($products);
?>
<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>
<article class="container products-archive">
  <nav class="filters">
    <div class="filter">
      <h3 class="filter-title">Categorias</h3>
      <?php 
        wp_nav_menu([
        'menu' => 'internal-categories',
        'menu_class' => 'filter-cat',
        'container' => false
        ])
      ?>
    </div>
    <div class="filter">
     <?php
      $attribute_taxonomies = wc_get_attribute_taxonomies();
      foreach($attribute_taxonomies as $attribute) {
        the_widget('WC_Widget_Layered_Nav', [
          'title' => $attribute->attribute_label,
          'attribute' => $attribute->attribute_name
        ]);
      }
     ?>
    </div>
    <div class="filter">
      <h3 class="filter-title">Filtrar por preço</h3>
      <form class="filter-price">
        <div>
          <label for="min_price">De R$</label>
          <input type="number" name="min_price" value="<?= $_GET['min_price']; ?>" required>
        </div>
        <div>
          <label for="max_price">Até R$</label>
          <input type="number" name="max_price" value="<?= $_GET['max_price']; ?>" required>
        </div>
        <button type="submit">Filtrar</button>
      </form>
    </div>
  </nav>
  <main>
    <?php if($data['products'][0]) {
      woocommerce_catalog_ordering();
      handel_product_list($data['products']);
      echo get_the_posts_pagination();
    } else { ?>
    <p>Nenhum resultado para a sua busca.</p>
    <?php } ?>
  </main>
</article>
<?php get_footer(); ?>
