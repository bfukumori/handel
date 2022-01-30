<?php 
//Template name: Exclusive
get_header(); ?>

<?php
  $user = wp_get_current_user();
  $hasBought = wc_customer_bought_product($user->user_email, $user->ID, 86)
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <h1 class="title"><?php the_title(); ?></h1>
  <?php if($hasBought) { ?>
    <main class="container container-index"><?php the_content() ?></main>
  <?php } else { ?>
    <p class="container">Essa página só pode ser vista por clientes que compraram o produto digital.</p>
  <?php } ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
