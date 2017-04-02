<div class="row">
    <div class="col-md-12">
        <?php

        if(isset($_GET['id'])){
            // Kişinin bilgilerini veritabanından al
            $id = $_GET['id'];
            $kisi = $db->query("SELECT * FROM kisiler WHERE id = ".$id)->fetch(PDO::FETCH_OBJ);
        }

        if(isset($_POST['send'])){
            $name    = $_POST['name'];
            $phone   = $_POST['phone'];
            $address = $_POST['address'];

            if(empty($name)){
                hataGoster("İsim alanını doldurmayı unutmayınız!");
            } elseif(empty($phone)){
                hataGoster("Telefon alanını doldurmayı unutmayınız!");
            } elseif(empty($address)){
                hataGoster("Adres alanını doldurmayı unutmayınız!");
            } else {
                // Bilgiler doğru veriabanına kayıt edebilirsin.
                if(isset($kisi)){
                    $db->exec("UPDATE kisiler SET name = '".$name."', address = '".$address."', phone = '".$phone."' WHERE id = ".$kisi->id);
                } else {
                    $db->exec("INSERT INTO kisiler(name, address, phone) VALUES('".$name."', '".$address."', '".$phone."')");
                }
                yonlendir("index.php");
            }
        }
        ?>
        <form action="index.php?do=ekle<?php if(isset($kisi)){ echo "&id=".$kisi->id; } ?>" method="post">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php if(isset($kisi)): ?>
                            Rehber Kişisini Düzenle: '<?php echo $kisi->name; ?>'
                        <?php else: ?>
                            Rehbere Kişi Ekle
                        <?php endif; ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">Ad Soyad</label>
                        <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } elseif(isset($kisi)){ echo $kisi->name; } ?>" placeholder="Kayıt edeceğiniz kişinin ad soyad bilgisini giriniz..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" name="phone" id="phone" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } elseif(isset($kisi)){ echo $kisi->phone; } ?>" placeholder="Kayıt edeceğiniz kişinin telefon bilgisini giriniz..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Kayıt edeceğiniz kişinin adres bilgisini giriniz..." rows="3"><?php if(isset($_POST['address'])){ echo $_POST['address'];} elseif(isset($kisi)){ echo $kisi->address; } ?></textarea>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success" name="send">
                        <?php if(isset($kisi)): ?>
                            Kaydı Düzenle
                        <?php else: ?>
                            Yeni Kayıt Ekle
                        <?php endif; ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>