<!DOCTYPE Html>
<Html>

<Head>
  <meta charset="UTF-8" />
  <title><?php pageTitle(); ?></title>
  <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo $css; ?>template.css" />
</Head>

<body <?php if (isset($bodyAtt)) {echo $bodyAtt;} ?>>