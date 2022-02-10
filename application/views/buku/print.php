<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laporan Data Buku</title>
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
    -->
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
<h3 class="header smaller lighter blue"><center>Laporan Data Buku</center></h3>
</div>



<table id="customers" width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="5px">
                    
                    <thead>
							<tr>
                                <th>No</th>
                                <th>Sampul</th>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                                <th>Tahun Buku</th>
                                <th>Stok Buku</th>
                                <th>Dipinjam</th>
                                <th>Tanggal Masuk</th>
                            </tr>
                            </thead>

                <tbody>
                        <?php $no=1;foreach($buku->result_array() as $isi){?>
                            <tr>
                                <td><?= $no;?></td>
                                <td>
                                    <center>
                                        <?php if(!empty($isi['sampul'] !== "0")){?>
                                        <img src="<?php echo base_url();?>assets_style/image/buku/<?php echo $isi['sampul'];?>" alt="#" 
                                        class="img-responsive" style="height:auto;width:100px;"/>
                                        <?php }else{?>
                                            <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
											<i class="fa fa-book fa-3x" style="color:#333;"></i> <br/><br/>
											Tidak Ada Sampul
                                        <?php }?>
                                    </center>
                                </td>
                                <td><?= $isi['isbn'];?></td>
                                <td><?= $isi['title'];?></td>
                                <td><?= $isi['penerbit'];?></td>
                                <td><?= $isi['thn_buku'];?></td>
                                <td class="text-center"><?= $isi['jml'];?></td>
								<td>
									<?php
										$id = $isi['buku_id'];
										$dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id= '$id' AND status = 'Dipinjam'");
										if($dd->num_rows() > 0 )
										{
											echo $dd->num_rows();
										}else{
											echo '0';
										}
									?>
								</td>
                                <td><?= $isi['tgl_masuk'];?></td>
									<?php $no++;}?>		
                </tbody>
</table>


<script type="text/javascript">
	window.print();

</script>

</body>
</html>