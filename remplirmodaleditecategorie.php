<?php
$categorieid=$_POST['categorieid'];
include_once 'trait.php';
$curs=Tvg::getCategorieById($categorieid);
while($row=$curs->fetch()){
    ?>
    <form>
    <div class="input-container ic1">     
        <input id="cne" class="input" type="text" name="vd" value="<?=$row[1];?>" required  />
      </div>
      <div class="input-container ic2">
      <textarea id="cde" placeholder="Category Description" style="height:200px" class="input">
      <?=$row[2];?>
</textarea>
      </div>
      <div style="height:150px"></div>
    <div id="remarqueeditetourcategorie"></div>
</form>
<br>
<br>
    <?php
}
?>