<?php
$idtravel=$_POST['travelid'];
include_once 'trait.php';
$curs=Tvg::getTravelById($idtravel);
while($row=$curs->fetch()){
  ?>
  <form>
      <div class="input-container ic1">     
        <input id="vde" class="input" type="text" name="vd" value="<?=$row[1];?>" placeholder="Ville depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="vae" class="input" type="text" name="vr" value="<?=$row[2];?>" placeholder="Ville arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="dde" class="input" type="text" name="dd" value="<?=$row[3];?>" placeholder="Date depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="dae" class="input" type="text" name="dr" value="<?=$row[4];?>" placeholder="Date arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="hde" class="input" type="text" name="hd" value="<?=$row[5];?>" placeholder="Heure depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="hae" class="input" type="text" name="hr" value="<?=$row[6];?>" placeholder="Heure arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="ce" class="input" type="number" name="cp" value="<?=$row[7];?>" placeholder="Capacite" required  />
      </div>
      <div class="input-container ic2">
        <input id="oe" class="input" type="text" name="ot" value="<?=$row[8];?>" placeholder="Outile" required  />
      </div>
      <div class="input-container ic2">
        <input id="pe" class="input" type="number" name="pr" value="<?=$row[9];?>" placeholder="Prix"  required />
      </div>
<div id="remarqueeditetravel"></div>
</form>
<br>
<br>
<?php
}
/*
*/
?>