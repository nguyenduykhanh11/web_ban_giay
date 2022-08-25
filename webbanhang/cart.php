<?php 
    $title = 'Trang Giỏ Hàng';
    require_once('layoutss/header.php');

    

 ?>
   

   <!-- product stast -->
   <div style="margin-top: 100px; padding-top: 20px;" >
     <h1 style="text-align: center; color: #46434d;font-family: serif ;">GIỎ HÀNG</h1><hr>
  
    <h3 style=" margin-left: 30PX; font-family:cursive;">Các sản phẩm bạn đã chọn</h3>
   </div>
    
  <div class="container" style="margin-top: 20px; margin-buttom: 20PX;">
    <div class="row" >
        <table class="table table-bordered">
            <tr>
              <th>STT</th>
              
              <th>Thumbnail</th>
              <th>Tiêu đề</th>
              <th>Gía</th>
              <th>size</th>
              <th>Số lượng</th>
              <th>Tổng giá</th>
            </tr>
        
        <?php 
            if(!isset($_SESSION['cart'])){
              $_SESSION['cart']=[];
            }
            
             $index = 0;

            foreach($_SESSION['cart'] as $item){           
              echo '<tr>
                <td>'.(++$index).'</td>
                
                <td><img src="'.$item['thumbnail'].'" style=" height: 40px; width:40px"></td>
                <td>'.$item['title'].'</td>
                <td>'.number_format($item['price']).'VND</td>

                <td>
                  <div style="display: flex">
                    <button class="btn btn-light" style="border:1px solid #dce0e0;" onclick="thaydoi1('.$item['id'].','.$item['idd'].',-1)">-</button>
                    <input type="number" id="size_'.$item['id'].''.$item['idd'].'" value="'.$item['size'].'" class="form-control" style="width:80px; "onchange="loiam('.$item['id'].','.$item['idd'].')"/>
                    <button class="btn btn-light" style="border:1px solid #dce0e0;" onclick="thaydoi1('.$item['id'].','.$item['idd'].',1)">+</button>
                  </div>
                </td>
             

                <td style="display: flex">
                  <button class="btn btn-light" style="border:1px solid #dce0e0;" onclick="thaydoi('.$item['id'].','.$item['idd'].',-1)">-</button>
                  <input type="number" id="num_'.$item['id'].''.$item['idd'].'" value="'.$item['num'].'" class="form-control" style="width:80px; "onchange="loiam('.$item['id'].','.$item['idd'].')"/>
                  <button class="btn btn-light" style="border:1px solid #dce0e0;" onclick="thaydoi('.$item['id'].','.$item['idd'].',1)">+</button>
                  </td>

                  <td>'.number_format($item['price']*$item['num']).'VND</td>
                  <td><button onclick="suagiohang('.$item['id'].','.$item['idd'].',0,0)">Xóa</button></td>
              </tr>';
            }
         ?>
      </table>
      <a href="checkout.php"><button class="btn btn-success ">Đến thanh toán <i class="bi bi-arrow-right-circle-fill"></i></button></a>
    </div>
  </div>
  <script type="text/javascript">
       

      function thaydoi(id,idd,congtru1){
        num = parseInt($('#num_'+ id+idd).val())
        num += congtru1

        $('#num_'+ id+idd).val(num);
        suagiohang(id,idd,parseInt($('#size_'+id+idd).val()) , num)
      }
      function thaydoi1(id,idd,congtru1){
        size = parseInt($('#size_'+id+idd).val())
        size += congtru1
        if (size < 38) size = 38;
        if(size > 43) size = 43;
        $('#size_'+id+idd).val(size);

         suagiohang(id,idd,size, parseInt($('#num_'+id+idd).val()))
      }
      function loiam(id,idd){
        $('#num_'+id+idd).val(Math.abs($('#num_'+id+idd).val()))
        $('#size_'+id+idd).val(Math.abs($('#size_'+id+idd).val()))
        suagiohang(id,idd, $('#size_'+id+idd).val(), $('#num_'+id+idd).val())
      }
      function suagiohang(productId,idd,size, num){
          $.post('cartt/ajax_requestt.php', {
              'action': 'sua_cart',
              'id': productId,
              'idd': idd,
              'size':size,    
              'num': num
          }, function(data){
              location.reload()

          })
      }
      
  </script>
  
  <?php 
    require_once('layoutss/footer.php')
   ?>
	
</body>
</html>