<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Submenu</title>
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="<?= base_url('assets/')
                                    ?>dist/css/normalize.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/')
                                    ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/')
                                    ?>dist/css/adminlte.min.css">
    <!-- Load paper.css for happy printing -->
    <link href="<?php base_url('assets/') ?>dist/css/googleapis/fontsgoogleapiscom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/paper.css">
    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @media print {
            * {
                margin: 0;
                padding: 0
            }

            @page {
                size: legal;
                margin: 0mm;
            }
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="legal">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <!-- <section class="sheet padding-10mm"> -->
    <section class="sheet padding-10mm">
        <!-- <div class="content-wrapper">
            </div> -->
        <div class="wrapper">
            <section class="content">
                <div class="row border-bottom">
                    <div class="col-sm-6">
                        <h3 class="text-md font-weight-normal">SIAK V. 2.0 PAGUWARMAS</h3>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-md text-right"><?= date("d/m/Y h:i"); ?></h3>
                    </div>
                    <!-- <div class="col-sm-12">
                        <hr class="mt-1">
                    </div> -->
                </div>
                <div class="row mt-4 mx-auto">
                    <div class="col-sm-12">
                        <h3 class="text-md font-weight-bolder text-center">SUBMENU</h3>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-sm text-sm" width="100%">
                            <thead>
                                <tr>
                                    <td class="text-center" width="5%">No</td>
                                    <td class="text-center">Submenu</td>
                                    <td class="text-center">Menu</td>
                                    <td class="text-center" width="15%">url</td>
                                    <td class="text-center" width="15%">icon</td>
                                    <td class="text-center" width="10%">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($submenu) {
                                    foreach ($submenu as $dataSubmenu) :
                                ?>

                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $dataSubmenu['submenu']; ?></td>
                                            <td><?= $dataSubmenu['menu']; ?></td>
                                            <td><?= $dataSubmenu['url']; ?></td>
                                            <td><?= $dataSubmenu['icon']; ?></td>
                                            <td><?= $dataSubmenu['is_active']; ?></td>
                                        </tr>
                                <?php
                                        $no++;
                                    endforeach;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- <script>
        window.print();
    </script> -->
</body>

</html>