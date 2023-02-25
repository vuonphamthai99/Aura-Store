<?php
    include '../inc/header.php';
?>

<?php
    $id = Session::get('idAdmin');
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveprofile'])){
        $UpdateAdmin = $admin->update_admin($_POST, $_FILES, $id);
    }
?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="iq-edit-list usr-edit">
                    <ul class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-12 p-0">
                            <a class="nav-link active" data-toggle="pill" href="#personal-information">
                            Chỉnh Sửa Hồ Sơ
                            </a>
                        </li>
                        <!-- <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#emailandsms">
                            Email and SMS
                            </a>
                        </li>
                        <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#manage-contact">
                            Manage Contact
                            </a>
                        </li> -->
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                    <?php
                        if(isset($UpdateAdmin)){
                            echo $UpdateAdmin;
                        }
                    ?>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Chỉnh Sửa Hồ Sơ</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="form-profile-edit" enctype="multipart/form-data">
                                <?php
                                    $get_admin = $admin->show_admin($id);
                                    if($get_admin){
                                        while($result = $get_admin->fetch_assoc()){
                                ?>
                                <div class="form-group row align-items-center">
                                <div class="col-md-12">
                                    <div class="profile-img-edit">
                                        <div class="crm-profile-img-edit">
                                            <?php
                                                if($result['Avatar'] != NULL){
                                            ?>
                                            <img class="crm-profile-pic rounded-circle avatar-100" src="../assets/images/user/<?php echo $result['Avatar']?>" alt="profile-pic">
                                            <?php
                                                }else{
                                                    echo '<img class="crm-profile-pic rounded-circle avatar-100" src="../assets/images/user/12.jpg" alt="profile-pic">';
                                                }
                                            ?>
                                            <div class="crm-p-image bg-primary">
                                            <i class="las la-pen upload-button"></i>
                                            <input class="file-upload" name="Avatar" type="file" accept="image/*">
                                            </div>
                                        </div>                                          
                                    </div>
                                </div>
                                </div>
                                <div class=" row align-items-center">
                                <div class="form-group col-sm-6">
                                    <label for="fname">Họ Và Tên:</label>
                                    <input type="text" name="AdminName" class="form-control" id="fname" value="<?php echo $result['AdminName']?>">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="nmphone">Số Điện Thoại:</label>
                                    <input type="text" name="NumberPhone" class="form-control" id="nmphone" value="<?php echo $result['NumberPhone']?>">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editmail">Email:</label>
                                    <input type="email" name="Email" class="form-control" id="editmail" value="<?php echo $result['Email']?>">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="address">Địa Chỉ:</label>
                                    <input type="text" name="Address" class="form-control" id="address" value="<?php echo $result['Address']?>">
                                    <span class="text-danger"></span>
                                </div>
                                <!-- <div class="form-group col-sm-6">
                                    <label class="d-block">Gender:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio6" name="customRadio1" class="custom-control-input" checked="">
                                        <label class="custom-control-label" for="customRadio6"> Male </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio7"> Female </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="dob">Date Of Birth:</label>
                                    <input  class="form-control" id="dob" value="1984-01-24">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Marital Status:</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option selected="">Single</option>
                                        <option>Married</option>
                                        <option>Widowed</option>
                                        <option>Divorced</option>
                                        <option>Separated </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Age:</label>
                                    <select class="form-control" id="exampleFormControlSelect2">
                                        <option>12-18</option>
                                        <option>19-32</option>
                                        <option selected="">33-45</option>
                                        <option>46-62</option>
                                        <option>63 > </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Country:</label>
                                    <select class="form-control" id="exampleFormControlSelect3">
                                        <option>Caneda</option>
                                        <option>Noida</option>
                                        <option selected="">USA</option>
                                        <option>India</option>
                                        <option>Africa</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>State:</label>
                                    <select class="form-control" id="exampleFormControlSelect4">
                                        <option>California</option>
                                        <option>Florida</option>
                                        <option selected="">Georgia</option>
                                        <option>Connecticut</option>
                                        <option>Louisiana</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group col-sm-12">
                                    <label>Địa Chỉ:</label>
                                    <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">
                                        Đường 30/4,
                                        Xuân Khánh,
                                        Ninh Kiều,
                                        Cần Thơ
                                    </textarea>
                                </div> -->
                                </div>
                                <input type="submit" name="saveprofile" class="btn btn-primary mr-2" value="Lưu"/>
                                <?php
                                        }
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Email and SMS</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="emailnotification">Email Notification:</label>
                                    <div class="col-md-9 custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="emailnotification" checked="">
                                        <label class="custom-control-label" for="emailnotification"></label>
                                    </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="smsnotification">SMS Notification:</label>
                                    <div class="col-md-9 custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="smsnotification" checked="">
                                        <label class="custom-control-label" for="smsnotification"></label>
                                    </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="npass">When To Email</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email01">
                                            <label class="custom-control-label" for="email01">You have new notifications.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email02">
                                            <label class="custom-control-label" for="email02">You're sent a direct message</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email03" checked="">
                                            <label class="custom-control-label" for="email03">Someone adds you as a connection</label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="npass">When To Escalate Emails</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email04">
                                            <label class="custom-control-label" for="email04"> Upon new order.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email05">
                                            <label class="custom-control-label" for="email05"> New membership approval</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="email06" checked="">
                                            <label class="custom-control-label" for="email06"> Member registration</label>
                                        </div>
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Manage Contact</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                    <label for="cno">Contact Number:</label>
                                    <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                                    </div>
                                    <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" value="Barryjone@demo.com">
                                    </div>
                                    <div class="form-group">
                                    <label for="url">Url:</label>
                                    <input type="text" class="form-control" id="url" value="https://getbootstrap.com">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                        </div>
                </div> -->
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer2.php';
?>

    <script>
        Validator({
            form: "#form-profile-edit",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#fname"),
            Validator.isRequired("#nmphone"),
            Validator.isRequired("#editmail"),  
            Validator.isRequired("#address"),
            Validator.isEmail("#editmail"),
            Validator.isPhone("#nmphone")
            ]
        })
    </script>

</body>
</html>