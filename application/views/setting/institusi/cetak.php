<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Institusi</title>
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- Load paper.css for happy printing -->
    <link href="<?= base_url('assets/') ?>dist/css/googleapis/fontsgoogleapiscom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/normalize.min.css">
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
                size: A4;
                margin: 0mm;
            }

            /* table,
            th, */
            /* td {
                border: 1px solid black;
            } */

            /* html, */
            /* body {
                height: 100%;
            }

            html {
                background-color: red
            }

            body {
                background-color: green
            } */
            /* table td {
                border-bottom: 1px solid #000;
            } */
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

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
                        <h3 class="text-md font-weight-bolder text-center">Master Data Institusi</h3>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-sm text-sm">
                            <thead>
                                <tr>
                                    <td class="text-center" width="5%">No</td>
                                    <td class="text-center" width="25%">Institusi</td>
                                    <td class="text-center">Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($institusi) {
                                    foreach ($institusi as $dataInstitusi) :
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td width="25%"><?= $dataInstitusi['institusi']; ?></td>
                                            <td><?= $dataInstitusi['keterangan']; ?></td>
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
    <script>
        window.print();
    </script>
</body>

</html>