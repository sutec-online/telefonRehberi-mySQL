<?php
$kisiler = $db->query("SELECT * FROM kisiler ORDER BY id DESC");
if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            $id = $_GET['id'];
            $kisi = $db->query("SELECT * FROM kisiler WHERE id = ".$id)->fetch(PDO::FETCH_OBJ);

            if($kisi)
                $db->exec("DELETE FROM kisiler WHERE id = ".$kisi->id);
            break;

        case "search":
            $id = $_GET['id'];
            $name = $_GET['name'];
            $address = $_GET['address'];
            $phone = $_GET['phone'];

            $queryText = "SELECT * FROM kisiler WHERE id > 0 ";
            if(isset($id) && !empty($id)){
                $queryText .= "AND id = '".$id."' ";
            }
            if(isset($name) && !empty($name)){
                $queryText .= "AND name LIKE '%".$name."%' "; // LIKE benzer anlamına gelip aramada kullanılır. % işareti herhangi bir şey/ler demek.
            }
            if(isset($address) && !empty($address)){
                $queryText .= "AND address LIKE '%".$address."%' ";
            }
            if(isset($phone) && !empty($phone)){
                $queryText .= "AND phone LIKE '%".$phone."%' ";
            }
            $queryText .= " ORDER BY id DESC";
            $kisiler = $db->query($queryText);
            break;
    }
}
?>
<div class="row">
    <div class="col-md-12 text-right">
        <a href="index.php?do=ekle" class="btn btn-success">Yeni Kayıt Ekle</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Rehberde Ara</h3>
            </div>
            <div class="panel-body">
                <form action="index.php" method="get" class="form-inline">
                    <input type="hidden" name="action" value="search" /> <!-- Gizli form öğesi, $_GET['action'] değerinin "search" olması için -->
                    <div class="form-group">
                        <label for="id">Kayıt No</label>
                        <input type="number" name="id" value="<?php if(isset($_GET['action']) && $_GET['action'] == "search" && isset($_GET['id'])){ echo $_GET['id']; } ?>" id="id" class="form-control" min="0">
                    </div>
                    <div class="form-group">
                        <label for="name">Ad Soyad</label>
                        <input type="text" name="name" id="name" value="<?php if(isset($_GET['name'])){ echo $_GET['name']; } ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input type="text" name="address" id="address" value="<?php if(isset($_GET['address'])){ echo $_GET['address']; } ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" name="phone" id="phone" value="<?php if(isset($_GET['phone'])){ echo $_GET['phone']; } ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Ara</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Telefon Rehberi Listesi</h3>
            </div>
            <div class="panel-body" style="padding: 0;">
                <table class="table table-striped table-hover table-bordered" style="margin: 0;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Soyad</th>
                        <th>Adres</th>
                        <th>Telefon</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($kisiler->fetchAll(PDO::FETCH_OBJ) as $kisi):
                    ?>
                    <tr>
                        <td><?php echo $kisi->id; ?></td>
                        <td><?php echo $kisi->name; ?></td>
                        <td><?php echo $kisi->address; ?></td>
                        <td><span class="label label-success"><?php echo $kisi->phone; ?></span></td>
                        <td>
                            <a href="index.php?do=ekle&id=<?php echo $kisi->id; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                            <a href="index.php?action=delete&id=<?php echo $kisi->id; ?>" class="btn btn-sm btn-danger">Sil</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>