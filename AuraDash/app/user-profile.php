<?php
    include '../inc/header.php';
?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <div class="card car-transparent">
                <div class="card-body p-0">
                    <div class="profile-image position-relative">
                    <img src="../assets/images/page-img/profile.png" class="img-fluid rounded w-100" alt="profile-image">
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row m-sm-0 px-3">            
        <div class="col-lg-12 card-profile">
            <div class="card card-block card-stretch card-height">
                <?php
                    $id = Session::get('idAdmin');
                    $get_admin = $admin->show_admin($id);
                    if($get_admin){
                        while($result = $get_admin->fetch_assoc()){
                ?>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                    <div class="profile-img position-relative">
                        <?php
                            if($result['Avatar'] != NULL){
                        ?>
                        <img src="../assets/images/user/<?php echo $result['Avatar']?>" class="img-fluid rounded avatar-110" alt="profile-image">
                        <?php
                            }else{
                                echo '<img src="../assets/images/user/12.jpg" class="img-fluid rounded avatar-110" alt="profile-image">';
                            }
                        ?>
                    </div>
                    <div class="ml-3">
                        <h4 class="mb-1"><?php echo $result['AdminName']?> (<?php echo $result['AdminUser']?>)</h4>
                        <p class="mb-2"><?php echo $result['Position']?></p>
                        <div class="bg-primary-light pl-3 pr-3 pt-2 pb-2 rounded" style="max-width:87px; cursor:default; user-select:none;">Liên Hệ</div>
                    </div>
                    </div>
                    <!-- <p>
                    I’m a Ux/UI designer. I spend my whole day, 
                    practically every day, experimenting with new 
                    designs, making illustartion, and animation.
                    </p> -->
                    <ul class="list-inline p-0 m-0">
                    <li class="mb-2">
                        <div class="d-flex align-items-center">
                            <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="mb-0"><?php echo $result['Address']?></p>   
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="d-flex align-items-center">
                            <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="mb-0"><?php echo $result['Position']?></p>   
                        </div>
                    </li>
                    <!-- <li class="mb-2">
                        <div class="d-flex align-items-center">
                            <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                            </svg>
                            <p class="mb-0">March 25</p>   
                        </div>
                    </li> -->
                    <li class="mb-2">
                        <div class="d-flex align-items-center">
                            <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <p class="mb-0"><?php echo $result['NumberPhone']?></p>   
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="mb-0"><?php echo $result['Email']?></p>   
                        </div>
                    </li>
                    </ul>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer.php';
?>