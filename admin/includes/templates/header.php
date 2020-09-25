<!DOCTYPE Html>
<Html>

<Head>
  <meta charset="UTF-8" />
  <title><?php PageTitle(); ?></title>
  <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo $css; ?>Admin.Css" />
</Head>

<body <?php if (isset($BodyAtt)) {echo $BodyAtt;} ?>>