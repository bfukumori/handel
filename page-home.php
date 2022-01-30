<?php 
// Template name: Home
get_header(); 

function get_product_category_data($category) {
  $cat = get_term_by('slug', $category, 'product_cat');
  $cat_id = $cat->term_id;
  $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
  return [
    'name' => $cat->name,
    'id' => $cat_id,
    'link' => get_term_link($cat_id, 'product_cat'),
    'img' => wp_get_attachment_image_src($img_id, 'slide')[0]
  ];
} 
$products_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide'],
  'stock_status' => 'instock'
]);
$products_new = wc_get_products([
  'limit' => 9,
  'orderby' => 'date',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);
$products_sales = wc_get_products([
  'limit' => 9,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);
$home_id = get_the_ID();
$categoria_esquerda = get_post_meta($home_id, 'categoria_esquerda', true);
$categoria_direita = get_post_meta($home_id, 'categoria_direita', true);

$data = [];
$data['slide'] = format_products($products_slide, 'slide');
$data['new'] = format_products($products_new, 'medium');
$data['sales'] = format_products($products_sales, 'medium');
$data['categories'][$categoria_esquerda] = get_product_category_data($categoria_esquerda);
$data['categories'][$categoria_direita] = get_product_category_data($categoria_direita);
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<ul class="perks">
  <li>Frete Grátis</li>
  <li>Troca Fácil</li>
  <li>Até 12x</li>
</ul>

<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($data['slide'] as $product) { ?>
      <li class="slide-item">
      <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
        <div class="slide-info">
          <span class="slide-price"><?= $product['price'] ?></span>
          <h2 class="slide-name"><?= $product['name'] ?></h2>
          <a class="btn-link" href="<?= $product['link'] ?>">Ver produto</a>
        </div> 
      </li>
    <?php } ?>
  </ul>
</section>

<section class="container">
  <h1 class="subtitle">Lançamentos</h1>
  <?php handel_product_list($data['new']); ?>
</section>

<section class="categories">
  <?php foreach($data['categories'] as $category) { ?>
    <a href="<?= $category['link'] ?>">
      <img src="<?= $category['img'] ?>" alt="<?= $category['name'] ?>">
      <span class="btn-link"><?= $category['name'] ?></span>
    </a>
  <?php } ?>
</section>

<section class="container">
  <h1 class="subtitle">Mais Vendidos</h1>
  <?php handel_product_list($data['sales']); ?>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
