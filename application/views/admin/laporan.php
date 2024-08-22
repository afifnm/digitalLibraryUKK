<table border="1">
    <thead>
        <tr class="text-nowrap">
            <th>#</th>
            <th>Judul</th>
            <th>Peminjam</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($buku as $row){ ?>
        <tr>
            <th scope="row"><?= $no; ?></th>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['namaLengkap']; ?></td>
            <td><?= $row['tanggalPeminjaman']; ?></td>
            <td><?= $row['tanggalPengembalian']; ?></td>
            <td>
                <?php if($row['statusPeminjaman']=='Proses'){
                echo "Menunggu persetujuan";   
                } else { echo $row['statusPeminjaman']; } ?>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
<script>
    window.print();
</script>