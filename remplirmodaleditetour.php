<?php
$tourid=$_POST['tourid'];
include_once 'trait.php';
$curs=Tvg::getTourById($tourid);
while($row=$curs->fetch()){
?>
<form action="adminCrud.php" method="POST" enctype="multipart/form-data">
      <div class="input-container ic1">
      <input class="input" id="categoriee" type="text" value="<?=$row[1];?>" name="categoriee" list="categories" placeholder="Choose Category..." >
                       <datalist id="categories">
                        
                       </datalist>
      </div>
      <div class="input-container ic2">
        <input id="tte" class="input" type="text" name="tte" value="<?=$row[2];?>" placeholder="Tirte tour" required  />
      </div>
      <div class="input-container ic2">
        <input id="cie" class="input" type="text" name="cte" value="<?=$row[3];?>" placeholder="City" required  />
      </div>
      <div class="input-container ic2">
        <input id="Ddte" class="input" type="text" name="ddte" value="<?=$row[4];?>" placeholder="Date depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="dte" class="input" type="text" name="dte" value="<?=$row[5];?>" placeholder="Description Tour" required  />
      </div>
      <div class="input-container ic2">
        <input id="cae" class="input" type="number" name="cae" value="<?=$row[6];?>" placeholder="Capacite" required  />
      </div>
      <div class="input-container ic2">
        <input id="ie" class="input" type="text" name="imagee" value="<?=$row[7];?>" placeholder="Image" required  />
      </div>
      <div class="input-container ic2">
        <input id="pre" class="input" type="number" name="pre" value="<?=$row[8];?>" placeholder="Prix"  required />
      </div>
      <div class="input-container ic2">
        <input id="ree" class="input" type="text" name="ree" value="<?=$row[9];?>" placeholder="Region"  required />
      </div>
      <input type="number" value="<?=$row[0];?>" name="id" hidden="hidden">
      <input type="text" value="<?=$row[7];?>" name="old" hidden="hidden">
  <div id="remarquemodifiertour"></div>
  

    </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="fermer" data-dismiss="modal">Fermer</button>
          <input type="submit" name="modifiertour" class="btn btn-primary modifiertour" id="modifiertour" data-toggle="tooltip" data-placement="bottom" value="Modifier">
          </form>
          
          <script>
              $('#Ddte').focus(function(){
    $(this).attr('type', 'datetime-local');
  })
  $('#ie').focus(function(){
    $(this).attr('type', 'file');
  })
          </script>
<?php
}
$curs->closeCursor();
?>