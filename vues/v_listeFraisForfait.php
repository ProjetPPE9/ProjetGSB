<div class="col-md-6">
<div class="content-box-large">
		<div class="panel-heading">
			<div class="panel-title"><h2></h2></div>
			</br></br>
		  <legend>Eléments forfaitisés</legend>			
		</div>
            
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST"  action="index.php?uc=gererFraisForfait&action=validerMajFraisForfait">
			  <div class="form-group">
                              
                <label for="cbFrais"> Nom du frais :</label>
                </br>
           
                              
                              <select class="form-control" id="cbFrais">
   
  <?php
        
        
                foreach ($lesFraisForfait as $unFrais)
			{
				$idFrais = $unFrais['idfrais'];
				$libelle = $unFrais['libelle'];
				$montant = $unFrais['montant'];
        
    ?>
                                <option value="<?php echo $libelle ?>" onchange="document.getElementById('txtMontant').setAttribute('value', 'test');"> <?php echo $libelle ?> </option>
            
    <?php
    
                        }                      
    ?>
                              </select>       </div>
            <div class="form-group">
                <label for="txtMontant"> Montant :</label>
                </br>
                <input class="form-control" type="text" id="txtMontant" value="">
            </div>
            <div class="form-group">
		<label for="txtDateHF"> Date : </label>
		</br>
                <input class="form-control" type="date" id="txtDateHF" name="dateFrais" <?php if ($lesInfosFicheFrais['idEtat']!='CR') { 		echo 'disabled';};   ?>/>
		
	    </div>
            <div class="form-group">
                <label for="textQuantite"> Quantite :</label>
                </br>
                <input class="form-control" type="number" id="textQuantite" >
            </div>
</select>

                              
                              
				<?php
						foreach ($lesFraisForfait as $unFrais)
						{
							$idFrais = $unFrais['idfrais'];
							$libelle = $unFrais[	'libelle'];
							$quantite = $unFrais['quantite'];
                                                        
					?>
<!--							<div class="form-group">
								<label for="idFrais"><?php //echo $libelle ?></label>
								<input class="form-control" placeholder="<?php //echo $quantite?>" type="text" id="idFrais" name="lesFrais[<?php //echo $idFrais?>]"
                                                                       "<?php //echo $quantite?>"<?php //if ($lesInfosFicheFrais['idEtat']!='CR') { echo 'disabled';} ?> >
							</div>-->

					<?php
						}
					?>
                        </form> 
				</div>
				<input class="btn btn-primary" id="ok" type="submit" value="Valider" size="20" <?php if ($lesInfosFicheFrais['idEtat']!='CR') { echo 'disabled';} ?>/>
			  </div>
			
		</div>
	








<div class="col-md-6">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>Eléments forfaitisés</legend>
		</div>
		<div class="panel-body">
			<table class="table">
			  <thead>
				<tr>
					<th class="date">Date</th>
					<th class="libelle">Libellé</th>  
					<th class="montant">Montant</th>
                                        <th class="quantite">Quantité</th>
					<th class="action">&nbsp;</th>              
				 </tr>
				 <?php    

					foreach( $lesFraisForfait as $unFraisForfait) 
					{
                                            $libelle = $unFraisForfait['libelle'];
                                            $date = $unFraisForfait['date'];
                                            $montant=$unFraisForfait['montant'];
                                            $quantite=$unFraisForfait['quantite'];
                                            $idVisiteur = $unFraisForfait['idVisiteur'];

                                ?>		
                                            <tr>
                                                    <td><?php echo $date; ?></td>
                                                    <td><?php echo $libelle; ?></td>
                                                    <td><?php echo $montant; ?></td>
                                                    <td><?php echo $quantite; ?></td>
                                                    <td> <?php if ($lesInfosFicheFrais['idEtat']!='CR') { echo '<a></a>';}
                                                            else {
                                                                    echo '<a href="index.php?uc=gererFraisForfait&action=supprimerFrais&idFrais='.$idVisiteur.'"
                                                            onclick="return confirm(\'Voulez-vous vraiment supprimer ce frais?\');">Supprimer ce frais</a></td>';
                                                            }
                                            ?></tr>
                                    <?php
                                        } ?>	  
			 </table>
		</div> 
	</div>
</div>






  