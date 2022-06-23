<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/favicon.svg" color="#000000">
        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://use.typekit.net/cfr1lst.css">
    </head>
    <body <?php body_class(); ?> >
        <?php bb_inject_inertia(); ?>

        <?php wp_footer(); ?>
    </body>
</html>