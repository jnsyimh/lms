<?php 
    session_start();
    if (!isset($_SESSION["id"])) {
        ?>
            <script type="text/javascript">
                window.location="index.php";
            </script>
        <?php
    }
    $page = 'profile';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>Bảng điều khiển</span></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="right text-right">
							<a href="dashboard.php"><i class="fas fa-home"></i>Trang chủ</a>
							<span class="disabled">Hồ sơ</span>
						</div>
					</div>
				</div>
				<div class="profile-content">
					<div class="row">
						<div class="col-md-3">
							<div class="photo">
								<?php
                                    $res = mysqli_query($link, "select * from lib_registration where id='".$_SESSION['id']."'");
                                    while ($row = mysqli_fetch_array($res)){
                                        ?><img src="<?php echo $row["photo"]; ?> " height="" width="" alt="something wrong"></a> <?php
                                    }
                                ?>
							</div>
							<div class="uploadPhoto">
								<div class="gap-30"></div>
								<form action="" method="post" enctype="multipart/form-data">
									<input type="file" name="image" class="modal-mt" id="image">
									<div class="gap-30"></div>
									<input type="submit" class="modal-mt btn btn-info" value="Cập nhật ảnh" name="submit">
								</form>
							</div>
                            <?php 
                                if (isset($_POST["submit"])) {
                                    $image_name=$_FILES['image']['name'];
                                    $temp = explode(".", $image_name);
                                    $newfilename = round(microtime(true)) . '.' . end($temp);
                                    $imagepath="upload/".$newfilename;
                                    move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
                                    mysqli_query($link, "update lib_registration set photo='".$imagepath."' where id='".$_SESSION['id']."'");
                                    
                                    ?>
                                        <script type="text/javascript">
                                            window.location="profile.php";
                                        </script>
                                    <?php
                                }
                            ?>
						</div>
						<div class="col-md-7 ml-30">
							<div class="details">
								<?php
                                   $res5 = mysqli_query($link, "select * from lib_registration where id='$_SESSION[id]' ");
                                   $_SESSION['id'];
                                   while($row5 = mysqli_fetch_array($res5)){
                                       $name      = $row5['name'];
                                       $username  = $row5['username'];
                                       $email     = $row5['email'];
                                       $phone     = $row5['phone'];
                                       $address     = $row5['address'];
                                   }
                                   ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label for="name" class="text-right">Tên:</label>
                                        <input type="text" class="form-control custom"  name="name" value="<?php echo $name; ?>" />
                                    </div>
                                    <div class="form-group">
                                         <label for="username">Tài khoản:</label>
                                        <input type="text" class="form-control custom" placeholder="Username" name="username" value="<?php echo $username; ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                         <label for="email">Email:</label>
                                        <input type="text" class="form-control custom"  name="email" value="<?php echo $email; ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                         <label for="phone">Số điện thoại:</label>
                                        <input type="text" class="form-control custom"  name="phone" value="<?php echo $phone; ?>" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="address">Địa chỉ:</label>
                                         <input type="text" class="form-control custom"  name="address" value="<?php echo $address; ?>" />
                                    </div>
                                    <div class="text-right mt-20">
                                        <input type="submit" value="Lưu" class="btn btn-info" name="update">
                                    </div>
                                <?php

                                ?>
                                </form>
			                </div> 
                            <?php
                               if (isset($_POST["update"])){
                                   mysqli_query($link, "update lib_registration set 
                                   name='$_POST[name]',
                                   phone='$_POST[phone]',
                                   address='$_POST[address]' 
                                   where id='$_SESSION[id]'");
                                    ?>
                                        <script type="text/javascript">
                                            alert("Cập nhật thành công");
                                            window.location="profile.php";
                                        </script>
                                    <?php
                              }
                            ?>
		                </div>    
					</div>
				</div>
			</div>					
		</div>
	</div>
	<?php 
		include 'inc/footer.php';
	 ?>