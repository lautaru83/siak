<table style="border:solid 0.25mm" width="100%">
    <!-- <tr>

        <td><?= $judul; ?></td>
    </tr> -->
    <?php
    if ($institusi) {
        foreach ($institusi as $dataInstitusi) :
    ?>

            <tr>
                <td><?= $dataInstitusi['institusi']; ?></td>
            </tr>
    <?php
        endforeach;
    }
    ?>
</table>