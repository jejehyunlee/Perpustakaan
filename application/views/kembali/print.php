<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laporan Data Pengmbalian Buku</title>
    <link href="<?php echo base_url(); ?>assets_style/css/print.css" rel="stylesheet" type="text/css" media="print" />
    <style type="text/css">
        <!--
body{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
#customers {
  border-collapse: collapse;
  width: 100%;
  
}

#customers td {
  border: 0px solid $#ddd;
  padding: 8px;
  font-size: 12px;
}
#customers th{
  padding: 8px;
  font-size: 12px;
}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #858796;
  color: white;
}
</style>
</head>
<body>

<p>&nbsp;</p>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<table width="100%">
  <tr>
    <td height="72"><div align="left"><img src="<?php echo base_url();?>assets_style/image/loggo.png" width="100" height="100" /></div></td>
    <td valign="bottom"><div align="left" class="style1">
      <p>PERPUSTAKAAN SMK Muhammadiyah 3 | Cileungsi <br /> 
        <span class="style2">Perum. PTSC, Jl. Anggrek No.86/1, Cileungsi, Kec. Cileungsi, Kabupaten Bogor, Jawa Barat 16820 <br /> (021) 825 2844</span> </p>      
    </div></td>
    <td>&nbsp;</td>
  </tr>  
</table>
<hr />
<h3 class="header smaller lighter blue"><center>Laporan Data Pengembalian Buku</center></h3>
</div>



<table id="customers" width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="5px">
                    
                    <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pinjam</th>
                                <th>ID Anggota</th>
                                <th>Nama</th>
                                <th>Pinjam</th>
                                <th>Balik</th>
                                <th style="width:10%">Status</th>
                                <th>Kembali</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no=1;
                            foreach($pinjam->result_array() as $isi){
                                $anggota_id = $isi['anggota_id'];
                                $ang = $this->db->query("SELECT * FROM tbl_login WHERE anggota_id = '$anggota_id'")->row();

                                $pinjam_id = $isi['pinjam_id'];
                                $denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
                                $total_denda = $denda->row();
                        ?>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?= $isi['pinjam_id'];?></td>
                                <td><?= $isi['anggota_id'];?></td>
                                <td><?= $ang->nama;?></td>
                                <td><?= $isi['tgl_pinjam'];?></td>
                                <td><?= $isi['tgl_balik'];?></td>
                                <td><?= $isi['status'];?></td>
                                <td>
                                    <?php 
                                        if($isi['tgl_kembali'] == '0')
                                        {
                                            echo '<p style="color:red;">belum dikembalikan</p>';
                                        }else{
                                            echo $isi['tgl_kembali'];
                                        }
                                    
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();         
                                        if($denda->num_rows() > 0){
                                            $s = $denda->row();
                                            echo $this->M_Admin->rp($s->denda);
                                        }else{
                                            $date1 = date('Ymd');
                                            $date2 = preg_replace('/[^0-9]/','',$isi['tgl_balik']);
                                            $diff = $date2 - $date1;

                                            if($diff >= 0 )
                                            {
                                                echo '<p style="color:green;">
                                                Tidak Ada Denda</p>';
                                            }else{
                                                $dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda','stat','Aktif'); 
                                                echo '<p style="color:red;font-size:18px;">'.$this->M_Admin->rp($jml*($dd->harga_denda*abs($diff))).' 
                                                </p><small style="color:#333;">* Untuk '.$jml.' Buku</small>';
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php $no++;}?>
                        </tbody>
</table>


<script type="text/javascript">
	window.print();

</script>

</body>
</html>