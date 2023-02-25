

<?php
spl_autoload_register(function($className){
  include_once "../../classes/".$className.".php";

});
$report = new report();
$a1=$a2=$a3=$a4=$a5=$a6=$a7="0";
$w1=$w2=$w3=$w4="0";
$get_sale_7day = $report->get_sale_day();
$get_sale_4week = $report->get_sale_month();
foreach($get_sale_7day as $key=>$value){
  if($value!=null){
    switch($key){
      case 0:
        $a1 = $value;
        break;
      case 1:
        $a2 = $value;
        break;
      case 2:
        $a3 = $value;
        break;
      case 3:
        $a4 = $value;
        break;
      case 4:
        $a5 = $value;
        break;
      case 5:
        $a6 = $value;
        break;
      case 6:
        $a7 = $value;
        break;
    }
  }
}
foreach($get_sale_4week as $key=>$value){
  if($value!=null){
    switch($key){
      case 0:
        $w1 = $value;
        break;
      case 1:
        $w2 = $value;
        break;
      case 2:
        $w3 = $value;
        break;
      case 3:
        $w4 = $value;
        break;
  }
}
}
?>
<script>
Morris.Bar({
  element: 'bar-lastweek',
  data: [
    { y: '<?php echo date('D d.m',strtotime("-6 days")); ?>', a: <?php echo $a1; ?>},
    { y: '<?php echo date('D d.m',strtotime("-5 days")); ?>', a: <?php echo $a2; ?>},
    { y: '<?php echo date('D d.m',strtotime("-4 days")); ?>', a: <?php echo $a3; ?>},
    { y: '<?php echo date('D d.m',strtotime("-3 days")); ?>', a: <?php echo $a4; ?>},
    { y: '<?php echo date('D d.m',strtotime("-2 days")); ?>', a: <?php echo $a5; ?>},
    { y: '<?php echo date('D d.m',strtotime("-1 days")); ?>', a: <?php echo $a6; ?>},
    { y: '<?php echo date('D d.m',strtotime("-0 days")); ?>', a: <?php echo $a7; ?>}
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Doanh thu']
  
});
</script>
<script>
Morris.Bar({
  element: 'bar-lastmonth',
  data: [
    { y: 'Từ <?php echo date('D d.m',strtotime("-7 days")); ?>', a: <?php echo $w1; ?>},
    { y: 'Từ <?php echo date('D d.m',strtotime("-14 days")); ?>', a: <?php echo $w2; ?>},
    { y: 'Từ <?php echo date('D d.m',strtotime("-21 days")); ?>', a: <?php echo $w3; ?>},
    { y: 'Từ <?php echo date('D d.m',strtotime("-28 days")); ?>', a: <?php echo $w4; ?>},

  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Doanh thu'],
  
});
</script>



